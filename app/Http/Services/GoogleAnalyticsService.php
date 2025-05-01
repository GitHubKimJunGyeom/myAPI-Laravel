<?php

namespace App\Http\Services;

use App\Contracts\Services\GoogleAnalyticsServiceInterface;
use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\RunReportRequest;
use Illuminate\Support\Facades\Log;

class GoogleAnalyticsService implements GoogleAnalyticsServiceInterface
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
     * GoogleAnalyticsService constructor.
     */
    public function __construct()
    {
        $path = config("googleanalytics.json_path");
        $jsonPath = storage_path($path);
        $this->client = new BetaAnalyticsDataClient(['credentials' => $jsonPath]);

        $this->startDate = now()->subDays(3)->format('Y-m-d');
        $this->endDate = 'today';
    }

    //kjk-portfolio
    public function getKjkPortfolioData(): array
    {
        $propertyId = config("googleanalytics.kjk_portfolio_property_id");  
        return $this->getAnalyticsData($propertyId);
    }

    // Log&List
    public function getLogAndListData(): array
    {
        $propertyId = config("googleanalytics.log_and_list_property_id");  
        return $this->getAnalyticsData($propertyId);
    }
    
    /**
     * Google Analytics API
     * 
     * @return array
     * @throws \Exception
     */
    public function getAnalyticsData(string $propertyId): array
    {
        try {
            $response = $this->client->runReport(new RunReportRequest([
                'property' => 'properties/' . $propertyId,
                'date_ranges' => [
                    new DateRange([
                        'start_date' => $this->startDate,
                        'end_date' => $this->endDate,
                    ]),
                ],
                'dimensions' => [
                    new Dimension(['name' => 'date']),
                    new Dimension(['name' => 'fullPageUrl']),
                    new Dimension(['name' => 'deviceCategory']),
                    new Dimension(['name' => 'country']),
                ],
                'metrics' => [
                    new Metric(['name' => 'active1DayUsers']),
                    new Metric(['name' => 'active7DayUsers']),
                    new Metric(['name' => 'active28DayUsers']),
                    new Metric(['name' => 'activeUsers']),
                    new Metric(['name' => 'averageSessionDuration']),
                    new Metric(['name' => 'newUsers']),
                    new Metric(['name' => 'screenPageViews']),
                    new Metric(['name' => 'scrolledUsers']),
                ],
            ]));
        } catch (\Exception $e) {
            Log::error('API ERROR: ' . $e->getMessage());
            return ['error' => 'Analytics API error'];
        }

        $groupedSummaryData = [];

        foreach ($response->getRows() as $row) {
            $date = $row->getDimensionValues()[0]->getValue();  // YYYYMMDD
            $formattedDate = substr($date, 0, 4) . '-' . substr($date, 4, 2) . '-' . substr($date, 6, 2);
            
            $fullPageUrl = $row->getDimensionValues()[1]->getValue();
            
            // localhost 제외
            if (str_contains($fullPageUrl, 'localhost')) {
                continue;
            }

            // 조회수 0인 데이터 제외
            if ((int) $row->getMetricValues()[6]->getValue() === 0) {
                continue; 
            }
        
            $deviceCategory = $row->getDimensionValues()[2]->getValue();
            $country = $row->getDimensionValues()[3]->getValue();
            $screenPageViews = (int) $row->getMetricValues()[6]->getValue();
        
            $data = [
                'fullPageUrl' => $fullPageUrl,
                'deviceCategory' => $deviceCategory,
                'country' => $country,
                'active1DayUsers' => $row->getMetricValues()[0]->getValue(),
                'active7DayUsers' => $row->getMetricValues()[1]->getValue(),
                'active28DayUsers' => $row->getMetricValues()[2]->getValue(),
                'activeUsers' => $row->getMetricValues()[3]->getValue(),
                'averageSessionDuration' => $row->getMetricValues()[4]->getValue(),
                'newUsers' => $row->getMetricValues()[5]->getValue(),
                'screenPageViews' => $screenPageViews,
                'scrolledUsers' => $row->getMetricValues()[7]->getValue(),
            ];
        
            // 그룹 초기화
            if (!isset($groupedSummaryData[$formattedDate])) {
                $groupedSummaryData[$formattedDate] = [
                    'byDevice' => [],
                    'byCountry' => [],
                    'entries' => [],
                ];
            }
        
            // 누적 집계
            $groupedSummaryData[$formattedDate]['byDevice'][$deviceCategory] = 
                ($groupedSummaryData[$formattedDate]['byDevice'][$deviceCategory] ?? 0) + $screenPageViews;
        
            $groupedSummaryData[$formattedDate]['byCountry'][$country] = 
                ($groupedSummaryData[$formattedDate]['byCountry'][$country] ?? 0) + $screenPageViews;
        
            // 원본 데이터도 함께 보관
            $groupedSummaryData[$formattedDate]['entries'][] = $data;
        }

        return $groupedSummaryData;
    }
}
