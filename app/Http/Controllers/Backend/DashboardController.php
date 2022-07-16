<?php

namespace App\Http\Controllers\Backend;

use Analytics;
use App\Http\Controllers\Controller;
use Spatie\Analytics\Period;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $mostVisitedPages = Analytics::fetchMostVisitedPages(Period::days(30));
        $TopBrowsers = Analytics::fetchTopBrowsers(Period::days(30));
        $analytics = Analytics::fetchTotalVisitorsAndPageViews(Period::days(30));
        $topReferrers = Analytics::fetchTopReferrers(Period::days(30));
        $dataVisitorType = Analytics::fetchUserTypes(Period::days(30));
        $AnalyticsDate = [];
        $time = time();
        for ($i = 29; $i >= 0; $i--,$time = $time - 86400) {
            $AnalyticsDate[] = date('M-d', $time);
        }
        $AnalyticsDate = array_reverse($AnalyticsDate);
        $data['visitors'] = ($analytics->pluck('visitors')->toArray());
        $data['pageViews'] = ($analytics->pluck('pageViews')->toArray());
        $data['topReferrers'] = $topReferrers->slice(0, 4);
        $data['visitorType'] = $dataVisitorType;
        $data['date'] = $AnalyticsDate;
        $data['TopBrowsers'] = $TopBrowsers->toArray();
        $data['mostVisitedPages'] = $mostVisitedPages->slice(0, 4)->toArray();

        return view('backend.dashboard', $data);
    }
}
