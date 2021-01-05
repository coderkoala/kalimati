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

	// @usage App\Models\commodityPriceDaily::getDateMax()
	public static function getDateMax() {
		$date = DB::select( DB::raw( 'SELECT max( `entrydate` ) as `today` FROM `tbl_dlypriceentry`;' ) );
		if ( ! empty(  $date[0] ) && isset(  $date[0]->today ) ) {
			return $date[0]->today;
		} else {
			return $date;
		}
	}

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
		$date = self::getDateMax();
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


	// @usage App\Models\getPriceOptimized::getPriceOptimized();
	public static function getPriceOptimized() {
		$queryLang = __( app()->getLocale() );
		$commodityColumn = 'en' === $queryLang && 'ne' !== $queryLang ? '`commodityengname`' : '`commoditynepname`';
		$queryLang = 'en' === $queryLang && 'ne' !== $queryLang ? '`commodityuniten`' : '`commodityunitnp`';
		$query= <<<EOD
		SELECT
		`commodity`.{$commodityColumn} AS `commodityname`,
		`commodity`.{$queryLang} AS `commodityunit`,
		`pricelist`.`minprice`,
		`pricelist`.`maxprice`,
		`pricelist`.`avgprice` FROM
		( SELECT *
		  FROM
		  `tbl_dlypriceentry` AS `pivot`
		  WHERE
		  (`entrydate`) IN
		  ( SELECT
		  	max( `entrydate` ) as `today`
			FROM
			`tbl_dlypriceentry`
		  )
		) AS `pricelist`
		INNER JOIN
		`tbl_commoditylist` AS `commodity`
		ON
		`commodity`.`commodityid` = `pricelist`.`commodityid`;
		EOD;
		return collect( DB::select( DB::raw( $query ) ) );
	}
}
