<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid as PackageUuid;

class License extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'licenses';
    protected $primaryKey = 'id';

    // Setup fillable params.
    protected $fillable = [
        'name',
        'phone',
        'email',
        'license_key',
        'license_data',
        'user_id',
        'license_uuid',
        'created_at',
        'updated_at',
        'deleted_at',
        'valid_until',
    ];

    /**
     * @return array
     */
    public static function getFieldData()
    {
        return [
            'name' => [
                'label' => __('Name'),
                'placeholder' => __('Enter your name'),
                'validation' => 'required|max:160',
                'onUpdate' => 'required|max:160',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'phone' => [
                'label' => __('Phone'),
                'placeholder' => __('Enter your phone number'),
                'validation' => 'nullable|digits:10',
                'onUpdate' => 'nullable|digits:10',
                'type' => 'text',
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'email' => [
                'label' => __('Email'),
                'placeholder' => __('Enter your email address'),
                'validation' => 'nullable|regex:/^.+@.+$/i|max:255',
                'onUpdate' => 'nullable|regex:/^.+@.+$/i|max:255',
                'type' => 'email',
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'license_key' => [
                'label' => __('License Key'),
                'placeholder' => __('Enter your license key'),
                'validation' => 'nullable|alpha_num',
                'onUpdate' => 'nullable|alpha_num',
                'type' => 'textarea',
                'required' => false,
                'render' => false,
                'hidden' => false,
                'disabled' => false,
            ],
            'license_uuid' => [
                'label' => __('License Key(Token)'),
                'placeholder' => __('Enter your license key'),
                'validation' => 'nullable|alpha_dash',
                'onUpdate' => 'nullable|alpha_dash',
                'type' => 'text',
                'required' => false,
                'render' => false,
                'hidden' => false,
                'disabled' => false,
            ],
            'license_data' => [
                'label' => __('License Data'),
                'placeholder' => __('Enter license data'),
                'validation' => 'required|json',
                'onUpdate' => 'sometimes|json',
                'type' => 'textarea',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'user_id' => [
                'label' => __('License Owner'),
                'placeholder' => __('Select user to mint license to.'),
                'validation' => 'required|integer',
                'onUpdate' => 'required|integer',
                'required' => true,
                'render' => true,
                'type' => 'select',
                'model' => \App\Domains\Auth\Models\User::class,
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
                'type' => 'date',
                'render' => false,
                'hidden' => true,
                'disabled' => false,
            ],
            'valid_until' => [
                'label' => __('Valid Until'),
                'placeholder' => __('Select appropriate Date'),
                'validation' => 'required|date|after:today',
                'onUpdate' => 'required|date|after:today',
                'required' => true,
                'type' => 'date',
                'render' => true,
                'disabled' => false,
                'hidden' => false,
            ],
            'updated_at' => [
                'label' => __('Updated At'),
                'placeholder' => __('Select appropriate Date'),
                'validation' => 'sometimes|date',
                'onUpdate' => 'sometimes|date',
                'required' => false,
                'type' => 'date',
                'disabled' => false,
                'render' => false,
                'hidden' => true,
            ],
            'deleted_at' => [
                'label' => __('Deleted At'),
                'placeholder' => __('Select appropriate Date'),
                'validation' => 'nullable|date',
                'onUpdate' => 'nullable|date',
                'required' => false,
                'type' => 'date',
                'disabled' => false,
                'render' => false,
                'hidden' => true,
            ],
        ];
    }

    // This data needs to be json, always.
    protected $casts = [
        'license_data' => 'array',
    ];

    // Set up a one to many inverse relationship with the users table.
    public function user_details()
    {
        return $this->belongsTo('App\Domains\Auth\Models\User', 'user_id', 'id');
    }

    /**
     * @param $query
     * @param $term
     * @return mixed
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($query) use ($term) {
            $query->where('license_key', 'like', '%'.$term.'%')
                ->orWhere('license_uuid', 'like', '%'.$term.'%')
                ->orWhere('name', 'like', '%'.$term.'%')
                ->orWhere('phone', 'like', '%'.$term.'%')
                ->orWhere('email', 'like', '%'.$term.'%');
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
