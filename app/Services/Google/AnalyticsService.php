<?php

namespace App\Services\Google;

use App\Contracts\Services\Google\AnalyticsServiceInterface as GoogleAnalyticsServiceInterface;
use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\RunReportRequest;
use Google\Analytics\Data\V1beta\OrderBy;
use Google\Analytics\Data\V1beta\OrderBy\DimensionOrderBy;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Google\Protobuf\Internal\RepeatedField;
class AnalyticsService implements GoogleAnalyticsServiceInterface
{
    /**
     * @var BetaAnalyticsDataClient
     */
    protected BetaAnalyticsDataClient $client;

    /**
     * @var string
     */
    protected string $startDate;

    /**
     * @var string
     */
    protected string $endDate;
     
    /**
     * @var string
     */
    protected string $propertyId;

    /**
     * @var array
     */
    protected array $dimensionsData;

    /**
     * @var array
     */
    protected array $metricsData;

    /**
     * @var array
     */
    protected array $propertyList;

    /**
     * GoogleAnalyticsService constructor.
     */
    public function __construct()
    {
        $path = config("googleanalytics.json_path");
        $jsonPath = storage_path($path);
        $this->client = new BetaAnalyticsDataClient(['credentials' => $jsonPath]);

        $this->startDate = now()->subDays(10)->format('Y-m-d');
        $this->endDate = 'today';
        $this->dimensionsData = [];
        $this->metricsData = [];

        $this->propertyList = [
            'kjk_portfolio' => config("googleanalytics.kjk_portfolio_property_id"),
            'log_and_list' => config("googleanalytics.log_and_list_property_id"),
        ];

        $this->dimensionsData = Cache::get('ga_dimensions_data', []);
        $this->metricsData = Cache::get('ga_metrics_data', []);

        // 캐시 없으면 API 호출
        if (empty($this->dimensionsData) || empty($this->metricsData)) {
            log::info('캐시 없음, API 호출');
            $this->getAnalyticsData($this->propertyList);
        } else {
            log::info('캐시 있음, API 호출 안함');
        }
    }

    //kjk-portfolio(Dimensions)
    public function getKjkPortfolioDimensionsData(): array
    {
        Log::info('getKjkPortfolioDimensionsData');
        return $this->dimensionsData['kjk_portfolio'] ?? [];
    }

    // Log&List(Dimensions)
    public function getLogAndListDimensionsData(): array
    {
        Log::info('getLogAndListDimensionsData');
        return $this->dimensionsData['log_and_list'] ?? [];
    }

    //kjk-portfolio(Metric)
    public function getKjkPortfolioMetricData(): array
    {
        Log::info('getKjkPortfolioMetricData');
        return $this->metricsData['kjk_portfolio'] ?? [];
    }

    // Log&List(Metric)
    public function getLogAndListMetricsData(): array
    {
        Log::info('getLogAndListMetricsData');
        return $this->metricsData['log_and_list'] ?? [];
    }
    
    /**
     * Google Analytics API
     * 
     * @return void
     * @throws \Exception
     */
    private function getAnalyticsData(array $propertyList): void
    {
        Log::info('getAnalyticsData');

        $this->dimensionsData = [];
        $this->metricsData = [];

        foreach ($propertyList as $key => $propertyId) {
            Log::info("propertyId: {$propertyId}");

            try {
                $response = $this->client->runReport(new RunReportRequest([
                    'property' => "properties/{$propertyId}",
                    'date_ranges' => [
                        new DateRange([
                            'start_date' => $this->startDate,
                            'end_date' => $this->endDate,
                        ]),
                    ],
                    'dimensions' => [
                        new Dimension(['name' => 'date']),
                        new Dimension(['name' => 'fullPageUrl']),
                    ],
                    'metrics' => [
                        new Metric(['name' => 'active1DayUsers']),
                        new Metric(['name' => 'active7DayUsers']),
                        new Metric(['name' => 'active28DayUsers']),
                        new Metric(['name' => 'activeUsers']),
                        new Metric(['name' => 'newUsers']),
                        new Metric(['name' => 'screenPageViews']),
                        new Metric(['name' => 'scrolledUsers']),
                    ],
                    'order_bys' => [
                        new OrderBy([
                            'dimension' => new DimensionOrderBy([
                                'dimension_name' => 'date',
                            ]),
                            'desc' => false,
                        ]),
                    ],
                ]));

                $this->storeAnalyticsData($key, $response->getRows());

            } catch (\Exception $e) {
                Log::error("API ERROR: " . $e->getMessage());
                throw new \Exception( "Error Processing Request: " . $e->getMessage(), $e->getCode(), $e);
            }
        }

        Cache::put('ga_dimensions_data', $this->dimensionsData, now()->addHours(24));
        Cache::put('ga_metrics_data', $this->metricsData, now()->addHours(24));
        Log::info('getAnalyticsData: 캐시 저장 완료');
    }
    
    /**
     * Store analytics data
     * 
     * @param RepeatedField $rows 
     * @return void
     */
    private function storeAnalyticsData(string $key, RepeatedField $rows): void
    {
        foreach ($rows as $row) {
            $date = $row->getDimensionValues()[0]->getValue();  // YYYYMMDD
            $formattedDate = substr($date, 4, 2) . '-' . substr($date, 6, 2);  // MM-DD
            
            $fullPageUrl = $row->getDimensionValues()[1]->getValue();
            
            // localhost 제외
            if (str_contains($fullPageUrl, 'localhost')) {
                continue;
            }

            // 조회수 0인 데이터 제외
            if ((int) $row->getMetricValues()[5]->getValue() === 0) {
                continue; 
            }
        
            $screenPageViews = (int) $row->getMetricValues()[5]->getValue();
        
            $data = [
                'fullPageUrl' => $fullPageUrl,
                'active1DayUsers' => $row->getMetricValues()[0]->getValue(),
                'active7DayUsers' => $row->getMetricValues()[1]->getValue(),
                'active28DayUsers' => $row->getMetricValues()[2]->getValue(),
                'activeUsers' => $row->getMetricValues()[3]->getValue(),
                'newUsers' => $row->getMetricValues()[4]->getValue(),
                'screenPageViews' => $screenPageViews,
                'scrolledUsers' => $row->getMetricValues()[6]->getValue(),
            ];
        
            // dimensions 집계
            $this->dimensionsData[$key][$formattedDate] = 
                ($this->dimensionsData[$key][$formattedDate] ?? 0) + $screenPageViews;
        
            // metrics 집계
            $this->metricsData[$key][$formattedDate] = [
                'active1DayUsers' =>  $data['active1DayUsers'],
                'active7DayUsers' =>  $data['active7DayUsers'],
                'active28DayUsers' =>  $data['active28DayUsers'],
                'activeUsers' =>  $data['activeUsers'],
                'newUsers' =>  $data['newUsers'],
                'screenPageViews' => $data['screenPageViews'],
                'scrolledUsers' =>  $data['scrolledUsers'],
            ];
        }
    }
}

  