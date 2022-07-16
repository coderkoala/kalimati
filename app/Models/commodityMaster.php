<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commodityMaster extends Model
{
	use HasFactory;

	public 	  $timestamps = false;
	protected $table = "commodities";
	protected static $instance = null;
	protected $keyType = "string";
	protected $primaryKey = "id";
	protected $fillable = array(
		'id',
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
}
