<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commodityPriceDaily extends Model
{
    use HasFactory;

    protected $table = "daily_price_log";
    protected static $instance = null;
    protected $keyType = "string";
    protected $fillable = array(
        'commodity_id',
        'entry_date',
        'price_type',
        'min_price',
        'max_price',
        'avg_price',
        'created_by',
    );

    // @usage App\Models\commodityPriceDaily::getDateMax()
    public static function getDateMax()
    {
        $date = DB::select(DB::raw('SELECT max( `entry_date` ) as `today` FROM `daily_price_log`;'));
        if (!empty($date[0]) && isset($date[0]->today)) {
            return $date[0]->today;
        } else {
            return null;
        }
    }

    // @usage App\Models\commodityPriceDaily::getDateMax()
    public static function getMaxDateArrivalCommodity()
    {
        $date = DB::select(DB::raw('SELECT max( `entry_date` ) as `today` FROM `daily_arrival_log`;'));
        if (!empty($date[0]) && isset($date[0]->today)) {
            return $date[0]->today;
        } else {
            return null;
        }
    }

    // @usage App\Models\commodityPriceDaily::get_instance()
    public static function get_instance()
    {
        if (is_null(self::$instance)) {
            return self::$instance = new self;
        } else {
            return self::$instance;
        }
    }

    // @usage App\Models\commodityPriceDaily::getAllData()
    public static function getAllData()
    {
        $dataPtr = self::get_instance();
        return collect($dataPtr->limit($limit)->toArray());
    }

    // @usage App\Models\commodityPriceDaily::getPrice( date('Y-m-d', time() ));
    public static function getPrice($date = null)
    {
        $date = $date ? $date : date('Y-m-d');
        $queryLang = __(app()->getLocale());
        $query = "
        SELECT
        `commodities`.`commodity_{$queryLang}` as `commodityname`,
        `commodities`.`unit_{$queryLang}` as `commodityunit`,
        `pivot`.`min_price` as `minprice`,
        `pivot`.`max_price` as `maxprice`,
        `pivot`.`avg_price` as `avgprice`
        FROM
        (SELECT * FROM
            `daily_price_log`
            where `entry_date`
            IN ( '$date' ) AND `price_type` = 'wholesale'
        ) AS `pivot`
        INNER JOIN
        `commodities`
        ON
        `commodities`.`commodity_id` = `pivot`.`commodity_id`;";
        return collect(DB::select(DB::raw($query)));
    }


    // @usage App\Models\getPriceOptimized::getPriceOptimized();
    public static function getPriceOptimized()
    {
        $queryLang = __(app()->getLocale());
        $query = "
        SELECT
        `commodities`.`commodity_{$queryLang}` as `commodityname`,
        `commodities`.`unit_{$queryLang}` as `commodityunit`,
        `pivot`.`min_price` as `minprice`,
        `pivot`.`max_price` as `maxprice`,
        `pivot`.`avg_price` as `avgprice`
        FROM
        (SELECT * FROM
            `daily_price_log`
            where `entry_date`
            IN ( SELECT MAX(`entry_date`) FROM `daily_price_log` )
            AND `price_type` = 'wholesale'
        ) AS `pivot`
        INNER JOIN
        `commodities`
        ON
        `commodities`.`commodity_id` = `pivot`.`commodity_id`;";
        return collect(
            DB::select(
                DB::raw($query)
            )
        );
    }
}
