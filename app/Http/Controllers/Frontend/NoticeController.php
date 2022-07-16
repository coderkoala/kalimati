<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Notices;
use App\NepaliDate\conversion;

/**
 * Class NoticeController.
 */
class NoticeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($notice_id = 'notice')
    {
        $date = 'np' === __( app()->getLocale() ) ? null : date('F j, Y') . ' A.D.';
		if ( is_null( $date ) ) {
			$nepaliDate = new conversion();
			$date = explode('-', date( 'Y-m-d') );
			$nepali = $nepaliDate->get_nepali_date( $date[0], $date[1], $date[2]);
			$date = 'वि.सं. ' . $nepali['M'] . ' ' . __idf( $nepali['d'], false ) . ', ' .  __idf( $nepali['y'], false ) ;
		}

        $allowed_notices = [
            'notice' => __('General Notice'),
            'tender' => __('Tender Invitations'),
            'pest' => __('Pesticides Report'),
            'traders' => __('Notice for Traders'),
            'bill_publication' => __('Bills Publication'),
            'publication' => __('Literature Publication'),
            'annual' => __('General Report')
        ];

        if (! in_array($notice_id, array_keys($allowed_notices))) {
            $notice_id = 'notice';
        }

        return view('frontend.pages.notice',
            [
                'notice'=> Notices::where('type', $notice_id)->orderBy('published_at', 'desc')->get(),
                'date' => $date,
                'notice_title' => $allowed_notices[$notice_id]
            ]
        );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $notice_instance = Notices::findOrFail($id);

        $date = 'np' === __( app()->getLocale() ) ? null : date('F j, Y') . ' A.D.';
		if ( is_null( $date ) ) {
			$nepaliDate = new conversion();
			$date = explode('-', date( 'Y-m-d', strtotime($notice_instance->published_at)) );
			$nepali = $nepaliDate->get_nepali_date( $date[0], $date[1], $date[2]);
			$date = 'वि.सं. ' . $nepali['M'] . ' ' . __idf( $nepali['d'], false ) . ', ' .  __idf( $nepali['y'], false ) ;
		}

        $allowed_notices = [
            'notice' => __('General Notice'),
            'tender' => __('Tender Invitations'),
            'pest' => __('Pesticides Report'),
            'traders' => __('Notice for Traders'),
            'bill_publication' => __('Bills Publication'),
            'publication' => __('Literature Publication'),
            'annual' => __('General Report')
        ];

        return view('frontend.pages.notice-single',
            [
                'notice'=> Notices::where('type', $notice_instance->type)->orderBy('published_at', 'desc')->get(),
                'notice_instance'=> $notice_instance,
                'date' => $date,
                'notice_title' => $allowed_notices[$notice_instance->type]
            ]
        );
    }
}
