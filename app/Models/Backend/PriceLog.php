<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as PackageUuid;

class PriceLog extends Model
{
    use HasFactory;

	public 	  $timestamps = true;
	protected $table = "daily_price_log";

    // Setup fillable params.
    protected $fillable = [
		'id',
		'commodity_id',
		'entry_date',
		'price_type',
		'min_price',
		'max_price',
		'avg_price',
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
                'validation' => 'required|exists:commodities,commodity_id',
                'onUpdate' => 'sometimes|exists:commodities,commodity_id',
                'required' => true,
                'render' => true,
                'type' => 'commodity',
                'model' => \App\Models\Backend\Commodities::class,
                'render' => false,
                'hidden' => true,
                'disabled' => true,
            ],
            'entry_date' => [
                'label' => __('Entry Date'),
                'placeholder' => __('Entry Date'),
                'validation' => 'required|date',
                'onUpdate' => 'sometimes|date',
                'type' => 'date',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'price_type'=>[
                'label' => __('Price Type'),
                'placeholder' => __('Price Type'),
                'validation' => 'required',
                'onUpdate' => 'sometimes',
                'required' => true,
                'render' => true,
                'type' => 'select',
                'model' => [
                    'wholesale' => __('Wholesale'),
                    'retail' => __('Retail'),
                ],
                'render' => true,
                'hidden' => false,
                'disabled' => true,
            ],
            'min_price' => [
                'label' => __('Minimum Price'),
                'placeholder' => __('Minimum Price'),
                'validation' => 'required|numeric|between:0.00,999.99',
                'onUpdate' => 'required|numeric|between:0.00,999.99',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'avg_price' => [
                'label' => __('Average Price'),
                'placeholder' => __('Average Price'),
                'validation' => 'required|numeric|between:0.00,999.99',
                'onUpdate' => 'required|numeric|between:0.00,999.99',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'max_price' => [
                'label' => __('Maximum Price'),
                'placeholder' => __('Maximum Price'),
                'validation' => 'required|numeric|between:0.00,999.99',
                'onUpdate' => 'required|numeric|between:0.00,999.99',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'created_at' => [
                'label' => __('Created At'),
                'placeholder' => __('Select appropriate Date'),
                'validation' => 'sometimes|date',
                'onUpdate' => 'sometimes|date',
                'required' => false,
                'type' => 'datetime',
                'render' => true,
                'hidden' => false,
                'disabled' => true,
            ],
            'updated_at' => [
                'label' => __('Updated At'),
                'placeholder' => __('Select appropriate Date'),
                'validation' => 'sometimes|date',
                'onUpdate' => 'sometimes|date',
                'required' => false,
                'type' => 'datetime',
                'render' => true,
                'hidden' => false,
                'disabled' => true,
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
                ->orWhere('price_type', 'like', '%' . $term . '%');
            });
    }

    /**
     * @param $entry_date
     * @param $price_type
     * @return mixed
     */
    public static function getPriceLog($entry_date = null, $price_type="wholesale")
    {

        try {
            if ( false === strtotime($entry_date ?? '')) {
                $entry_date = self::select(\DB::raw("MAX(`entry_date`) as `today`"))->first()->today;
            }
        } catch(\Exception $e) {
            $entry_date = date('Y-m-d');
        }

        return [$entry_date, $price_type, self::join('commodities', 'commodities.commodity_id', '=', 'daily_price_log.commodity_id')
        ->select(
            'daily_price_log.id',
            'commodities.' . "commodity_" . app()->getLocale() . ' as commodity',
            'daily_price_log.price_type',
            'daily_price_log.min_price',
            'daily_price_log.max_price',
            'daily_price_log.avg_price',
            )
        ->where('daily_price_log.entry_date', $entry_date )
        ->where('daily_price_log.price_type', $price_type )
        ->where('commodities.deleted_at', null)->get()];
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
