<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\ArrivalLog;
use Illuminate\Http\Request;

/**
 * Class ArrivalDiff.
 */
class ArrivalDiff extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.arrivalComp');
    }

    // Date validation
    private function validateDate($date, $format = 'Y-m-d') {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    public function post(Request $request) {
        if (!$this->validateDate($request->input('from')) || !$this->validateDate($request->input('to'))) {
            return redirect()->back()->withFlashDanger(__('The both dates must be valid'));
        }
        $from = $request->input('from') ?? \App\Models\commodityPriceDaily::getMaxDateArrivalCommodity();
        $to = $request->input('to') ?? date('Y-m-d', strtotime($from . ' -1 days'));

        $from = ArrivalLog::join('commodities_arrival', 'commodities_arrival.commodity_id', '=', 'daily_arrival_log.commodity_id')
        ->select(
            'commodities_arrival.commodity_id as item',
            'commodities_arrival.' . "unit_" . app()->getLocale() . ' as unit',
            'commodities_arrival.' . "commodity_" . app()->getLocale() . ' as commodity',
            'daily_arrival_log.quantity as quantity',
            )
        ->where('daily_arrival_log.entry_date', $from )
        ->where('commodities_arrival.deleted_at', null)->get();

        $to = ArrivalLog::join('commodities_arrival', 'commodities_arrival.commodity_id', '=', 'daily_arrival_log.commodity_id')
        ->select(
            'commodities_arrival.commodity_id as item',
            'commodities_arrival.' . "unit_" . app()->getLocale() . ' as unit',
            'commodities_arrival.' . "commodity_" . app()->getLocale() . ' as commodity',
            'daily_arrival_log.quantity as quantity',
            )
        ->where('daily_arrival_log.entry_date', $to )
        ->where('commodities_arrival.deleted_at', null)->get();

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
        foreach($from as $item => $data) {
            if(array_key_exists($item, $to)) {
                try {
                    $difference = ( ( $to[$item]['quantity'] - $data['quantity'] ) / $data['quantity'] ) * 100;
                    $difference = number_format( ( float ) $difference, 2, '.' );
                } catch(\Exception $e) {
                    $difference = '-';
                }
                $result[$item] = [
                    'id' => $data['commodity'],
                    'unit' => $data['unit'],
                    'from' => __idf($data['quantity']),
                    'to' => __idf($to[$item]['quantity']),
                    'diff' => __idf($difference) . '%',
                ];
            } else {
                continue;
            }
        }

        return view(
            'frontend.arrivalComp',
            [
                'data'=>$result,
                'from'=>$request->input('from'),
                'to'=>$request->input('to'),
            ]
        );
    }
}
