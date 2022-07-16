<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as PackageUuid;

class ArrivalLog extends Model
{
    use HasFactory;

	public 	  $timestamps = true;
	protected $table = "daily_arrival_log";

    // Setup fillable params.
    protected $fillable = [
		'id',
		'commodity_id',
		'entry_date',
		'quantity',
    ];

    /**
     * @return array
     */
    public static function getFieldData()
    {
        return array(
            'commodity_id' => [
                'label' => __('Commodity Identifier'),
                'placeholder' => __('Commodity Identifier'),
                'validation' => 'required|exists:commodities_arrival,commodity_id',
                'onUpdate' => 'required|exists:commodities_arrival,commodity_id',
                'required' => true,
                'render' => true,
                'type' => 'commodity',
                'model' => \App\Models\Backend\CommoditiesArrival::class,
                'render' => false,
                'hidden' => true,
                'disabled' => true,
            ],
            'entry_date' => [
                'label' => __('Entry Date'),
                'placeholder' => __('Entry Date'),
                'validation' => 'required|date',
                'onUpdate' => 'required|date',
                'type' => 'date',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'quantity' => [
                'label' => __('Quantity'),
                'placeholder' => __('Quantity'),
                'validation' => 'required|numeric|between:0.00,999999999999999999.99',
                'onUpdate' => 'required|numeric|between:0.00,999999999999999999.99',
                'type' => 'number',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
        );
    }

    /**
     * @param $query
     * @param $term
     * @return mixed
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($query) use ($term) {
            $query->where('entry_date', 'like', '%' . $term . '%')
                ->orWhere('commodity_id', 'like', '%' . $term . '%');
            });
    }

    public static function getArrivals($date = null)
    {
        $date = $date ? $date : date('Y-m-d');
        $queryLang = __(app()->getLocale());
        $query = "
        SELECT
        `commodities_arrival`.`commodity_{$queryLang}` as `commodityname`,
        `commodities_arrival`.`unit_{$queryLang}` as `commodityunit`,
        `pivot`.`quantity` as `quantity`
        FROM
        (SELECT * FROM
            `daily_arrival_log`
            where `entry_date`
            IN ( '$date' )
        ) AS `pivot`
        INNER JOIN
        `commodities_arrival`
        ON
        `commodities_arrival`.`commodity_id` = `pivot`.`commodity_id`;";
        return collect(\DB::select(\DB::raw($query)));
    }

    /**
     * @param $query
     * @param $uuid
     * @return mixed
     */
    public function scopeUuid($query, $uuid)
    {
        return $query->where($this->getUuidName(), $uuid);
    }

    /**
     * @return string
     */
    public function getUuidName()
    {
        return property_exists($this, 'uuidName') ? $this->uuidName : 'uuid';
    }

    /**
     * Use Laravel bootable traits.
     */
    protected static function bootUuid()
    {
        static::creating(function ($model) {
            $model->{$model->getUuidName()} = PackageUuid::uuid4()->toString();
        });
    }
}
