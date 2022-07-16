<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as PackageUuid;

class TraderDues extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'traders_due';

    // Setup fillable params.
    protected $fillable = [
        'id',
        'trader_id',
        'tradername',
        'shop_id',
        'due_date',
        'monthly_rent',
        'late_fee',
        'other_amount',
        'adjustment',
        'total_amount',
    ];

    /**
     * @return array
     */
    public static function getFieldData()
    {
        return [
            'trader_id' => [
                'label' => __('Trader ID'),
                'placeholder' => __('Trader ID'),
                'validation' => 'required|max:6',
                'onUpdate' => 'required|max:6',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'tradername' => [
                'label' => __('Trader Name'),
                'placeholder' => __('Trader Name'),
                'validation' => 'required|max:70',
                'onUpdate' => 'required|max:70',
                'type' => 'text',
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'shop_id' => [
                'label' => __('Stall Number'),
                'placeholder' => __('Stall Number'),
                'validation' => 'required|max:6',
                'onUpdate' => 'required|max:6',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'due_date' => [
                'label' => __('Payment Due Date'),
                'placeholder' => __('Payment Due Date'),
                'validation' => 'required|date',
                'onUpdate' => 'required|date',
                'required' => false,
                'type' => 'datetime',
                'render' => true,
                'hidden' => false,
                'disabled' => true,
            ],
            'monthly_rent' => [
                'label' => __('Monthly Rent'),
                'placeholder' => __('Monthly Rent'),
                'validation' => 'required|numeric|between:0.00,9999999.99',
                'onUpdate' => 'required|numeric|between:0.00,9999999.99',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'late_fee' => [
                'label' => __('Late Fee'),
                'placeholder' => __('Late Fee'),
                'validation' => 'required|numeric|between:0.00,9999999.99',
                'onUpdate' => 'required|numeric|between:0.00,9999999.99',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'other_amount' => [
                'label' => __('Other Amount'),
                'placeholder' => __('Other Amount'),
                'validation' => 'required|numeric|between:0.00,9999999.99',
                'onUpdate' => 'required|numeric|between:0.00,9999999.99',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'adjustment' => [
                'label' => __('Amount Adjustment'),
                'placeholder' => __('Amount Adjustment'),
                'validation' => 'required|numeric|between:0.00,9999999.99',
                'onUpdate' => 'required|numeric|between:0.00,9999999.99',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'total_amount' => [
                'label' => __('Total Amount'),
                'placeholder' => __('Total Amount'),
                'validation' => 'required|numeric|between:0.00,9999999.99',
                'onUpdate' => 'required|numeric|between:0.00,9999999.99',
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
        ];
    }

    /**
     * @param $query
     * @param $term
     * @return mixed
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($query) use ($term) {
            $query->where('trader_id', 'like', '%'.$term.'%')
                ->orWhere('tradername', 'like', '%'.$term.'%')
                ->orWhere('shop_id', 'like', '%'.$term.'%');
        });
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
