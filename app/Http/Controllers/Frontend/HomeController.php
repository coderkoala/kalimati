<?php

namespace App\Http\Controllers\Frontend;

use App\NepaliDate\conversion;
use App\Http\Controllers\Controller;
use App\Models\commodityMaster as translator;
use App\Models\commodityPriceDaily as maxDate;

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
}
