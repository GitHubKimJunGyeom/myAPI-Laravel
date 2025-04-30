<?php

namespace App\Services;

use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;
use Google\Analytics\Data\V1beta\RunReportRequest;
use Illuminate\Support\Facades\Log;

class GoogleAnalyticsService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAnalyticsData($jsonPath, $propertyId, )
    {
        $cacheKey = 'users';
        $cacheDuration = 60;
        $limit = 25;
        $path = config("googleanalytics.json_path");

        $jsonPath = storage_path($path);
        $propertyId = config("googleanalytics.propoerty_id");
        $client = new BetaAnalyticsDataClient(['credentials' => $jsonPath]);
        
        $urls = [];
        $startDate = today()->subDays(99)->format('Y-m-d');
        $endDate = 'today';

        try {
            $response = $client->runReport(new RunReportRequest([
                'property' => 'properties/' . $propertyId,
                'date_ranges' => [
                    new DateRange([
                        'start_date' => $startDate,
                        'end_date' => $endDate,
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
            Log::error('API ERROR'. $e->getMessage() );
            return ['test','test'];
        }

        foreach ($response->getRows() as $row) {
            $data = [
                // Dimension
                'pagePath' => $row->getDimensionValues()[0]->getValue(),
                'deviceCategory' => $row->getDimensionValues()[1]->getValue(),
                'deviceModel' => $row->getDimensionValues()[1]->getValue(),
                'country' => $row->getDimensionValues()[2]->getValue(),
                'city' => $row->getDimensionValues()[3]->getValue(),
                'dateHourMinute' => $row->getDimensionValues()[4]->getValue(),

                // Metric
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
