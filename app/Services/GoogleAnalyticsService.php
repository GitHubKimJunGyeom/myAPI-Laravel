<?php

namespace App\Services;

use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\RunReportRequest;
use Illuminate\Support\Facades\Log;

class GoogleAnalyticsService
{
    // 프로퍼티
    protected BetaAnalyticsDataClient $client;
    protected string $startDate;
    protected string $endDate;
    protected string $propertyId;

    // 생성자
    public function __construct()
    {
        $path = config("googleanalytics.json_path");
        $jsonPath = storage_path($path);
        $this->propertyId = config("googleanalytics.propoerty_id");
        $this->client = new BetaAnalyticsDataClient(['credentials' => $jsonPath]);

        $this->startDate = now()->subDays(99)->format('Y-m-d');
        $this->endDate = 'today';
    }

    public function getAnalyticsData(): array
    {
        $urls = [];

        try {
            $response = $this->client->runReport(new RunReportRequest([
                'property' => 'properties/' . $this->propertyId,
                'date_ranges' => [
                    new DateRange([
                        'start_date' => $this->startDate,
                        'end_date' => $this->endDate,
                    ]),
                ],
                'dimensions' => [
                    new Dimension(['name' => 'pagePath']),
                    new Dimension(['name' => 'deviceCategory']),
                    new Dimension(['name' => 'deviceModel']),
                    new Dimension(['name' => 'country']),
                    new Dimension(['name' => 'city']),
                    new Dimension(['name' => 'dateHourMinute']),
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

        foreach ($response->getRows() as $row) {
            $data = [
                'pagePath' => $row->getDimensionValues()[0]->getValue(),
                'deviceCategory' => $row->getDimensionValues()[1]->getValue(),
                'deviceModel' => $row->getDimensionValues()[2]->getValue(),
                'country' => $row->getDimensionValues()[3]->getValue(),
                'city' => $row->getDimensionValues()[4]->getValue(),
                'dateHourMinute' => $row->getDimensionValues()[5]->getValue(),
                'active1DayUsers' => $row->getMetricValues()[0]->getValue(),
                'active7DayUsers' => $row->getMetricValues()[1]->getValue(),
                'active28DayUsers' => $row->getMetricValues()[2]->getValue(),
                'activeUsers' => $row->getMetricValues()[3]->getValue(),
                'averageSessionDuration' => $row->getMetricValues()[4]->getValue(),
                'newUsers' => $row->getMetricValues()[5]->getValue(),
                'screenPageViews' => $row->getMetricValues()[6]->getValue(),
                'scrolledUsers' => $row->getMetricValues()[7]->getValue(),
            ];
            $urls[] = $data;
        }

        return $urls;
    }
}
