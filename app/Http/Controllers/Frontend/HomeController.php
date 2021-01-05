<?php

namespace App\Http\Controllers\Frontend;

use App\NepaliDate\conversion;
use App\Http\Controllers\Controller;
use App\Models\commodityMaster as translator;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
		$date = 'ne' === __( app()->getLocale() ) ? null : date('F j, Y') . ' A.D.';
		if ( is_null( $date ) ) {
			$nepaliDate = new conversion();
			$date = explode('-', date( 'Y-m-d', time() ) );
			$nepali = $nepaliDate->get_nepali_date( $date[0], $date[1], $date[2]);
			$date = 'वि.सं. ' . $nepali['M'] . ' ' . translator::digits( $nepali['d'] ) . ', ' .  translator::digits( $nepali['y'] ) ;
		}
        return view('frontend.index', array(
			'date' => $date
		));
    }
}
