<?php

namespace App\Http\Controllers\Frontend;

use App\NepaliDate\conversion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\commodityMaster as translator;
use App\Models\tradersMaster as due;
use App\Models\commodityPriceDaily as maxdate;
use Validator;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
		$date = 'np' === __( app()->getLocale() ) ? null : date('F j, Y', strtotime( maxDate::getDateMax() ) ) . ' A.D.';
		if ( is_null( $date ) ) {
			$nepaliDate = new conversion();
			$date = explode('-', date( 'Y-m-d', strtotime( maxDate::getDateMax() ) ) );
			$nepali = $nepaliDate->get_nepali_date( $date[0], $date[1], $date[2]);
			$date = 'वि.सं. ' . $nepali['M'] . ' ' . __idf( $nepali['d'], false ) . ', ' .  __idf( $nepali['y'], false ) ;
		}
        return view('frontend.index', array(
			'date' => $date
		));
	}

	/**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function checkPrices(Request $request) {
		$date = 'np' === __( app()->getLocale() ) ? null : date('F j, Y' ) . ' A.D.';
		if ( is_null( $date ) ) {
			$nepaliDate = new conversion();
			$date = explode('-', date( 'Y-m-d') );
			$nepali = $nepaliDate->get_nepali_date( $date[0], $date[1], $date[2]);
			$date = 'वि.सं. ' . $nepali['M'] . ' ' . __idf( $nepali['d'], false ) . ', ' .  __idf( $nepali['y'], false ) ;
		}

        $printSwalBox = 'false';
        if(isset($request->q) && $request->q == 'success') {
            $printSwalBox = 'true';
        }

        return view('frontend.dues', array(
			'date' => $date,
            'printSwalBox' => $printSwalBox
		));
	}

	/**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function checkArrivals() {
		$date = 'np' === __( app()->getLocale() ) ? null : date('F j, Y' ) . ' A.D.';
		if ( is_null( $date ) ) {
			$nepaliDate = new conversion();
			$date = explode('-', date( 'Y-m-d') );
			$nepali = $nepaliDate->get_nepali_date( $date[0], $date[1], $date[2]);
			$date = 'वि.सं. ' . $nepali['M'] . ' ' . __idf( $nepali['d'], false ) . ', ' .  __idf( $nepali['y'], false ) ;
		}
        return view('frontend.singleDayArrivals', array( 'date' => $date ) );
	}

    	/**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function checkArrivalsPOST( Request $request ) {
		$validator = Validator::make(
			$request->all(),
			array(
				'datePricing' => 'required|date_format:Y-m-d',
			)
		);

		$dateRequested = $request->datePricing;
		if ( $validator->fails() ) {
            $dateRequested = date('Y-m-d');
		}
		$date = 'np' === __( app()->getLocale() ) ? null : date('F j, Y', strtotime( $dateRequested ) ) . ' A.D.';
		if ( is_null( $date ) ) {
			$nepaliDate = new conversion();
			$date = explode('-', $dateRequested );
			$nepali = $nepaliDate->get_nepali_date( $date[0], $date[1], $date[2]);
			$date = 'वि.सं. ' . $nepali['M'] . ' ' . __idf( $nepali['d'], false ) . ', ' .  __idf( $nepali['y'], false ) ;
        }
        return view('frontend.singleDayArrivals', array(
			'date'      => $date,
			'paramDate' => $dateRequested
		));
	}

	/**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function checkDailyPrices() {
		$date = 'np' === __( app()->getLocale() ) ? null : date('F j, Y' ) . ' A.D.';
		if ( is_null( $date ) ) {
			$nepaliDate = new conversion();
			$date = explode('-', date( 'Y-m-d') );
			$nepali = $nepaliDate->get_nepali_date( $date[0], $date[1], $date[2]);
			$date = 'वि.सं. ' . $nepali['M'] . ' ' . __idf( $nepali['d'], false ) . ', ' .  __idf( $nepali['y'], false ) ;
		}
        return view('frontend.singleDayPricings', array( 'date' => $date ) );
	}

	/**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function checkPriceHistory() {
        return view('frontend.priceHistory');
	}

	/**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function checkArrivalHistory() {
        return view('frontend.arrivalHistory');
	}

	/**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function checkArrivalPOST( Request $request ) {
    }

	/**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function checkDailyPricesPOST( Request $request ) {
		$validator = Validator::make(
			$request->all(),
			array(
				'datePricing' => 'required|date_format:Y-m-d',
			)
		);

		$dateRequested = $request->datePricing;
		if ( $validator->fails() ) {
            $dateRequested = date('Y-m-d');
		}
		$date = 'np' === __( app()->getLocale() ) ? null : date('F j, Y', strtotime( $dateRequested ) ) . ' A.D.';
		if ( is_null( $date ) ) {
			$nepaliDate = new conversion();
			$date = explode('-', $dateRequested );
			$nepali = $nepaliDate->get_nepali_date( $date[0], $date[1], $date[2]);
			$date = 'वि.सं. ' . $nepali['M'] . ' ' . __idf( $nepali['d'], false ) . ', ' .  __idf( $nepali['y'], false ) ;
        }
        return view('frontend.singleDayPricings', array(
			'date'      => $date,
			'paramDate' => $dateRequested
		));
	}

	/**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function checkIndividualPrice( Request $request ) {
		$traderid = strtoupper( $request->input('id') );
		$validator = Validator::make(
			$request->all(),
			array(
				'id'          => 'required', //Validation of the traderid.
			),
			array(
                'id.required' => __('Shop Identification Number') . ' ' . __( 'is required.' ),
            )
		);

		try {
			if ( $validator->fails() ) {
				return response()->json( [ 'header'=> __('Error') ,'status'=> 400 , 'icon' => 'error', 'error' => $validator->messages() ], 400 );
			}

			$traderTuple =  due::get_instance()
								->select('tradername', 'shop_id as shopno', 'due_date as duedate', 'monthly_rent as mrent', 'late_fee as lfee', 'other_amount as otheramt', 'adjustment', 'total_amount as totalamt'  )
								->where( 'trader_id', $traderid )
								->first();

			if ( ! $traderTuple ) {
				return response()->json( [ 'header'=> __('Error') ,'status'=> 200 , 'icon' => 'error', 'error' => __('No trader with that identification number found.') ], 200 );
			} else {
                $currency = 'np' === __( app()->getLocale() ) ? 'रू' : 'Rs.';
				$traderTuple->duedate = empty( $traderTuple->duedate ) ? 'Not found.' : __date( $traderTuple->duedate );
                $traderTuple->mrent = $currency . ' ' .__idf( $traderTuple->mrent );
                $traderTuple->lfee = $currency . ' ' .__idf( $traderTuple->lfee );
                $traderTuple->otheramt = $currency . ' ' .__idf( $traderTuple->otheramt );
                $traderTuple->otheramt = $currency . ' ' .__idf( $traderTuple->otheramt );
                $traderTuple->adjustment = $currency . ' ' .__idf( $traderTuple->adjustment );
                $traderTuple->totalamt_localed = $currency . ' ' .__idf( $traderTuple->totalamt );
				return response()->json( [ 'header'=> __('Success') ,'status'=> 200 , 'icon' => 'success', 'message' => $traderTuple->toArray() ], 200 );
			}
		} catch (\Exception $ex ) {
			return response()->json( [ 'header'=> __('Error') ,'status'=> 500 , 'icon' => 'error', 'error' => __('An error occured. Please try again later.') ], 500 );
		}
	}
}
