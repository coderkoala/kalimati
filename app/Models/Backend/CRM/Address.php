<?php

namespace App\Models\Backend\CRM;

use App\Models\Backend\Lib\Extensions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes, Extensions;

    protected $table = 'account_address';
    protected $primaryKey = 'id';
    protected static $modelNameCanonical = 'Account Address';
    protected static $modelNameSlug = 'account_address';

    // Setup fillable params.
    protected $fillable = [
        'name',
    ];

    /**
     * @return array
     */
    public static function getFieldData()
    {
        return [
            'address' => [
                'label' => __('Address'),
                'placeholder' => __('Address'),
                'validation' => 'required|max:191',
                'onUpdate' => 'required|max:191',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'city' => [
                'label' => __('City'),
                'placeholder' => __('City'),
                'validation' => 'required|max:32',
                'onUpdate' => 'required|max:32',
                'type' => 'select',
                'model' => \App\Models\Backend\Settings\SettingsCity::class,
                'route' => route('admin.api.settings', 'city'),
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'state' => [
                'label' => __('State'),
                'placeholder' => __('State'),
                'validation' => 'nullable|max:32',
                'onUpdate' => 'nullable|max:32',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'zipcode' => [
                'label' => __('Zip Code'),
                'placeholder' => __('Zip Code'),
                'validation' => 'nullable|max:12',
                'onUpdate' => 'nullable|max:12',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'country' => [
                'label' => __('Country'),
                'placeholder' => __('Country'),
                'validation' => 'required',
                'onUpdate' => 'required',
                'model' => \App\Models\Backend\Settings\SettingsCountry::class,
                'type' => 'select',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
                'showPK' => true,
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
            $query->orWhere('name', 'like', '%'.$term.'%');
        });
    }
}
