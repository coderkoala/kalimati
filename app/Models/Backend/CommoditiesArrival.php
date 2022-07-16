<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid as PackageUuid;

class CommoditiesArrival extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;
    protected $table = 'commodities_arrival';

    // Setup fillable params.
    protected $fillable = [
        'id',
        'commodity_id',
        'commodity_en',
        'commodity_np',
        'unit_en',
        'unit_np',
        'created_by',
    ];

    /**
     * @return array
     */
    public static function getFieldData()
    {
        return [
            'commodity_id' => [
                'label' => __('Commodity Identifier'),
                'placeholder' => __('Commodity Identifier'),
                'validation' => 'required',
                'onUpdate' => 'required',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'commodity_en' => [
                'label' => __('Commodity Name (In English)'),
                'placeholder' => __('Commodity Name (In English)'),
                'validation' => 'required|max:64',
                'onUpdate' => 'required|max:64',
                'type' => 'text',
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'commodity_np' => [
                'label' => __('Commodity Name (In Nepalese)'),
                'placeholder' => __('Commodity Name (In Nepalese)'),
                'validation' => 'required|max:64',
                'onUpdate' => 'required|max:64',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'unit_en' => [
                'label' => __('Unit of Measurement (In English)'),
                'placeholder' => __('Unit of Measurement (In English)'),
                'validation' => 'required|max:16',
                'onUpdate' => 'required|max:16',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'unit_np' => [
                'label' => __('Unit of Measurement (In Nepalese)'),
                'placeholder' => __('Unit of Measurement (In Nepalese)'),
                'validation' => 'required|max:16',
                'onUpdate' => 'required|max:16',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'created_by' => [
                'label' => __('Commodity Created By'),
                'placeholder' => __('Commodity Created By'),
                'validation' => 'sometimes|integer',
                'onUpdate' => 'sometimes|integer',
                'required' => true,
                'render' => true,
                'type' => 'select',
                'model' => \App\Domains\Auth\Models\User::class,
                'render' => false,
                'hidden' => true,
                'disabled' => true,
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
            'deleted_at' => [
                'label' => __('Deleted At'),
                'placeholder' => __('Select appropriate Date'),
                'validation' => 'nullable|date',
                'onUpdate' => 'nullable|date',
                'required' => false,
                'type' => 'datetime',
                'render' => true,
                'hidden' => false,
                'disabled' => true,
            ],
        ];
    }

    // Set up a one to many inverse relationship with the users table.
    public function user_details()
    {
        return $this->belongsTo('App\Domains\Auth\Models\User', 'created_by', 'id');
    }

    /**
     * Get all of the arrival_data for the Commodities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function arrival_data()
    {
        return $this->hasMany(\App\Models\Backend\ArrivalLog::class, 'commodity_id', 'commodity_id');
    }

    /**
     * @param $query
     * @param $term
     * @return mixed
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($query) use ($term) {
            $query->where('commodity_id', 'like', '%'.$term.'%')
                ->orWhere('commodity_en', 'like', '%'.$term.'%')
                ->orWhere('commodity_np', 'like', '%'.$term.'%')
                ->orWhere('unit_en', 'like', '%'.$term.'%')
                ->orWhere('unit_np', 'like', '%'.$term.'%')
                ->orWhere('created_by', 'like', '%'.$term.'%');
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
