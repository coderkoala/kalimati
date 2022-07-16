<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\PriceLog;
use Illuminate\Http\Request;

/**
 * Class PriceDiff.
 */
class PriceDiff extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.comparative');
    }

    // Date validation
    private function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);

        return $d && $d->format($format) === $date;
    }

    public function post(Request $request)
    {
        if (! $this->validateDate($request->input('from')) || ! $this->validateDate($request->input('to'))) {
            return redirect()->back()->withFlashDanger(__('The both dates must be valid'));
        }
        $from = $request->input('from') ?? \App\Models\commodityPriceDaily::getDateMax();
        $to = $request->input('to') ?? date('Y-m-d', strtotime($from.' -180 days'));

        $from = PriceLog::join('commodities', 'commodities.commodity_id', '=', 'daily_price_log.commodity_id')
        ->select(
            'commodities.commodity_id as item',
            'commodities.'.'unit_'.app()->getLocale().' as unit',
            'commodities.'.'commodity_'.app()->getLocale().' as commodity',
            'daily_price_log.avg_price as price',
            )
        ->where('daily_price_log.entry_date', $from)
        ->where('commodities.deleted_at', null)->get();

        $to = PriceLog::join('commodities', 'commodities.commodity_id', '=', 'daily_price_log.commodity_id')
        ->select(
            'commodities.commodity_id as item',
            'commodities.'.'unit_'.app()->getLocale().' as unit',
            'commodities.'.'commodity_'.app()->getLocale().' as commodity',
            'daily_price_log.avg_price as price',
            )
        ->where('daily_price_log.entry_date', $to)
        ->where('commodities.deleted_at', null)->get();

        $from = array_combine(array_column($from->toArray(), 'item'), $from->toArray());
        $from = array_map(function ($item) {
            unset($item['item']);

            return $item;
        }, $from);

        $to = array_combine(array_column($to->toArray(), 'item'), $to->toArray());
        $to = array_map(function ($item) {
            unset($item['item']);

            return $item;
        }, $to);

        $result = [];
        foreach ($from as $item => $data) {
            if (array_key_exists($item, $to)) {
                try {
                    $difference = (($to[$item]['price'] - $data['price']) / $data['price']) * 100;
                    $difference = number_format((float) $difference, 2, '.');
                } catch (\Exception $e) {
                    $difference = '-';
                }
                $result[$item] = [
                    'id' => $data['commodity'],
                    'unit' => $data['unit'],
                    'from' => __idf($data['price']),
                    'to' => __idf($to[$item]['price']),
                    'diff' => __idf($difference).'%',
                ];
            } else {
                continue;
            }
        }

        return view(
            'frontend.comparative',
            [
                'data'=>$result,
                'from'=>$request->input('from'),
                'to'=>$request->input('to'),
            ]
        );
    }
}
