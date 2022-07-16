<?php

use Carbon\Carbon;
use App\NepaliDate\conversion;

if (! function_exists('setAllLocale')) {

    /**
     * @param $locale
     */
    function setAllLocale($locale)
    {
        setAppLocale($locale);
        setPHPLocale($locale);
        setCarbonLocale($locale);
        setLocaleReadingDirection($locale);
    }
}

if (! function_exists('setAppLocale')) {

    /**
     * @param $locale
     */
    function setAppLocale($locale)
    {
        app()->setLocale($locale);
    }
}

if (! function_exists('setPHPLocale')) {

    /**
     * @param $locale
     */
    function setPHPLocale($locale)
    {
        setlocale(LC_TIME, $locale);
    }
}

if (! function_exists('setCarbonLocale')) {

    /**
     * @param $locale
     */
    function setCarbonLocale($locale)
    {
        Carbon::setLocale($locale);
    }
}

if (! function_exists('setLocaleReadingDirection')) {

    /**
     * @param $locale
     */
    function setLocaleReadingDirection($locale)
    {
        /*
         * Set the session variable for whether or not the app is using RTL support
         * For use in the blade directive in BladeServiceProvider
         */
        if (! app()->runningInConsole()) {
            if (config('boilerplate.locale.languages')[$locale]['rtl']) {
                session(['lang-rtl' => true]);
            } else {
                session()->forget('lang-rtl');
            }
        }
    }
}

if (! function_exists('getLocaleName')) {

    /**
     * @param $locale
     * @return mixed
     */
    function getLocaleName($locale)
    {
        return config('boilerplate.locale.languages')[$locale]['name'];
    }
}

if (! function_exists('__idf')) {
    /**
     * @param $string - string to be converted
     * @param $is_formatted (optional) - If the input is already a string.
     * @return string
     */
	function __idf( $string, $is_formatted = true ) {
		if (  'np' === __( app()->getLocale() ) ) {
            $string = $is_formatted ? number_format( ( float ) $string, 2, '.' ) : $string;
			return str_replace( [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'am', 'pm'], ['०','१','२','३','४','५','६','७','८','९', 'ऐ.एम्', 'पी.एम्'], $string  );
		} else {
			return $string = $is_formatted ? number_format( ( float ) $string, 2, '.' ) : $string;
		}
    }
}

if (! function_exists('__i')) {
    /**
     * @param $string - string to be converted
     * @param $is_formatted (optional) - If the input is already a string.
     * @return string
     */
	function __i( $string ) {
        $string = (int) $string . '';
		if (  'np' === __( app()->getLocale() ) ) {
			return str_replace( [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'am', 'pm'], ['०','१','२','३','४','५','६','७','८','९', 'ऐ.एम्', 'पी.एम्'], $string  );
		} else {
			return $string;
		}
    }
}

if (! function_exists('__date')) {
    /**
     * @param $string - string to be converted
     * @param $is_formatted (optional) - If the input is already a string.
     * @return string
     */
	function __date( $date = null ) {
        try {
            $testDate = @strtotime( $date ?? '' );
            if (! $testDate ) {
                $date = null;
            }
            unset( $testDate );
        } catch( Exception $e ) {
            $date = date('Y-m-d');
        }
        switch(app()->getLocale()){
            case 'np':
                $nepaliDate = new conversion();
                $date = explode('-', date( 'Y-m-d', strtotime( $date ) ) );
                $nepali = $nepaliDate->get_nepali_date( $date[0], $date[1], $date[2]);
                $date = 'वि.सं. ' . $nepali['M'] . ' ' . __idf( $nepali['d'], false ) . ', ' .  __idf( $nepali['y'], false ) ;
                break;

            default:
            $date = $date ?? date('F j, Y' ) . ' A.D.';
        }
        return $date;
    }
}

if (! function_exists('__dt')) {
    /**
     * @param $string - English day to be translated to Nepali
     * @return string
     */
    function __dt( $string ) {
        if (  'np' === __( app()->getLocale() ) ) {
            return str_replace( ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'], ['सोमवार','मंगलवार','बुधवार','बिहीवार','शुक्रवार','शनिवार','आइतवार'], $string );
        } else {
            return $string;
        }
    }
}
