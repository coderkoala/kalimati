<?php

namespace App\Http\Controllers\Frontend;

use App\NepaliDate\conversion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\commodityMaster as translator;
use App\Models\tradersMaster as due;
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
		$date = 'ne' === __( app()->getLocale() ) ? null : date('F j, Y', strtotime( maxDate::getDateMax() ) ) . ' A.D.';
		if ( is_null( $date ) ) {
			$nepaliDate = new conversion();
			$date = explode('-', date( 'Y-m-d', strtotime( maxDate::getDateMax() ) ) );
			$nepali = $nepaliDate->get_nepali_date( $date[0], $date[1], $date[2]);
			$date = 'वि.सं. ' . $nepali['M'] . ' ' . translator::digits( $nepali['d'] ) . ', ' .  translator::digits( $nepali['y'] ) ;
		}
        return view('frontend.index', array(
			'date' => $date
		));
	}

	/**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function checkPrices() {
		$date = 'ne' === __( app()->getLocale() ) ? null : date('F j, Y' ) . ' A.D.';
		if ( is_null( $date ) ) {
			$nepaliDate = new conversion();
			$date = explode('-', date( 'Y-m-d') );
			$nepali = $nepaliDate->get_nepali_date( $date[0], $date[1], $date[2]);
			$date = 'वि.सं. ' . $nepali['M'] . ' ' . translator::digits( $nepali['d'] ) . ', ' .  translator::digits( $nepali['y'] ) ;
		}
        return view('frontend.dues', array(
			'date' => $date
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
								->select('tradername', 'shopno', 'duedate', 'mrent', 'lfee', 'otheramt', 'adjustment', 'totalamt'  )
								->where( 'traderid', $traderid )
								->first();

			if ( ! $traderTuple ) {
				return response()->json( [ 'header'=> __('Error') ,'status'=> 200 , 'icon' => 'error', 'error' => __('No trader with that identification number found.') ], 200 );
			} else {
				$traderTuple->duedate = empty( $traderTuple->duedate ) ? 'Not found.' : translator::digits( $traderTuple->duedate );
				return response()->json( [ 'header'=> __('Success') ,'status'=> 200 , 'icon' => 'success', 'message' => $traderTuple->toArray() ], 200 );
			}
		} catch (\Exception $ex ) {
			return response()->json( [ 'header'=> __('Error') ,'status'=> 500 , 'icon' => 'error', 'error' => __('An error occured. Please try again later.') ], 500 );
		}
	}
}
