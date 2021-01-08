<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commodityMaster extends Model
{
	use HasFactory;

	public 	  $timestamps = false;
	protected $table = "tbl_commoditylist";
	protected static $instance = null;
	protected $keyType = "string";
	protected $primaryKey = "commodityid";
	protected $fillable = array(
		'commodityid',
		'commoditynepname',
		'commodityengname',
		'commodityuniten',
		'commodityunitnp',
		'postdate',
	);


	// Usage : App\Models\commodityMaster::get_instance()
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			return self::$instance = new self;
		} else {
			return self::$instance;
		}
	}

	// Usage : App\Models\commodityMaster::getAllData()
	public static function getAllData() {
		$dataPtr = self::get_instance();
		return collect( $dataPtr->all()->toArray() );
	}


	protected static $arrayMapperDigits = array(
		0   => '०',
		1   => '१',
		2   => '२',
		3   => '३',
		4   => '४',
		5   => '५',
		6   => '६',
		7   => '७',
		8   => '८',
		9   => '९',
		'.' => '.'
	);

	// Usage : App\Models\commodityMaster::digits()
	public static function digits( $string, $is_formatted = false ) {
		$string = $is_formatted ? ( number_format( ( float ) $string, 2, '.', '' ) ) : ( int ) $string;
		if (  'ne' === __( app()->getLocale() ) ) {
			return str_replace( array_keys( self::$arrayMapperDigits ), array_values( self::$arrayMapperDigits ), $string  );
		} else {
			return $string;
		}
	}
}
