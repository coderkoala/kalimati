<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commodityPriceDaily extends Model
{
	use HasFactory;

	public 	  $timestamps = false;
	protected $table = "tbl_dlypriceentry";
	protected static $instance = null;
	protected $keyType = "string";
	protected $fillable = array(
		'commodityid',
		'entrydate',
		'pricetype',
		'minprice',
		'maxprice',
		'avgprice',
		'createdby',
	);


	// @usage App\Models\commodityPriceDaily::get_instance()
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			return self::$instance = new self;
		} else {
			return self::$instance;
		}
	}

	// @usage App\Models\commodityPriceDaily::getAllData()
	public static function getAllData() {
		$dataPtr = self::get_instance();
		return collect( $dataPtr->limit($limit)->toArray() );
	}

	// @usage App\Models\commodityPriceDaily::getPrice( date('Y-m-d', time() ));
	public static function getPrice( $date = null ) {
		if ( is_null( $date ) ) {
			$date = date('Y-m-d', time() );
		}
		$queryLang = __( app()->getLocale() );
		$commodityColumn = 'en' === $queryLang && 'ne' !== $queryLang ? '`commodityengname`' : '`commoditynepname`';
		$queryLang = 'en' === $queryLang && 'ne' !== $queryLang ? '`commodityuniten`' : '`commodityunitnp`';
		$query= <<<EOD
		SELECT
		(
			SELECT $commodityColumn
			FROM
			`tbl_commoditylist`
			WHERE
			`commodityid` = `tbl_dlypriceentry`.`commodityid`
		) as `commodityname`,
		(
			select {$queryLang}
			from
			`tbl_commoditylist`
			where
			`commodityid` = `tbl_dlypriceentry`.`commodityid`
		) as `commodityunit`,
		`minprice`,
		`maxprice`,
		`avgprice`
		FROM
		`tbl_dlypriceentry`
		WHERE
		`entrydate` = '{$date}'
		AND
		`pricetype` = 'R'
		order by
		`commodityid`
		EOD;

		return collect( DB::select( DB::raw( $query ) ) );
	}
}
