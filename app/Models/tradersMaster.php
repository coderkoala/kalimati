<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tradersMaster extends Model
{
	use HasFactory;

	public 	  $timestamps = false;
	protected $table = "tbl_traderdue";
	protected static $instance = null;
	protected $keyType = "string";
	protected $fillable = array(
		'traderid',
		'tradername',
		'shopno',
		'duedate',
		'mrent',
		'lfee',
		'otheramt',
		'adjustment',
		'totalamt',
	);

	// @usage App\Models\tradersMaster::get_instance()
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			return self::$instance = new self;
		} else {
			return self::$instance;
		}
	}

}
