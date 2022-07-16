<?php

namespace App\Models\Backend\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Backend\Lib\Extensions;

class Contact extends Model
{
    use HasFactory, SoftDeletes, Extensions;

    protected $table = 'account_contacts';
    protected $primaryKey = 'id';
    protected static $modelNameCanonical = 'Account Contacts';
    protected static $modelNameSlug = 'account_contacts';

    // Setup fillable params.
    protected $fillable = [
        'title',
        'designation',
        'name',
        'telephone',
        'address',
        'city',
        'state',
        'zipcode',
        'country',
        'telephone_secondary',
        'email',
        'email_secondary',
        'mobile',
        'mobile_secondary',
    ];

    // Extended form layout in case of overrides.
    protected static $formLayout = [
        'Primary Contact Information' => [
            'name',
            'email',
            'mobile',
            'address',
            'city',
            'state',
            'zipcode',
            'country'
        ],
        'Additional Contact Information' => [
            'title',
            'designation',
            'telephone',
            'telephone_secondary',
            'mobile_secondary',
            'email_secondary',
        ],
    ];

    /**
     * @return array
     */
    public static function getFieldData()
    {
        return array(
            'title' => [
                'label' => __('Title'),
                'placeholder' => __('Title'),
                'validation' => 'nullable|max:160',
                'onUpdate' => 'nullable|max:160',
                'type' => 'text',
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'designation' => [
                'label' => __('Designation'),
                'placeholder' => __('Designation'),
                'validation' => 'nullable|max:160',
                'onUpdate' => 'nullable|max:160',
                'type' => 'text',
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'name' => [
                'label' => __('Contact Person'),
                'placeholder' => __('Contact Person'),
                'validation' => 'required|max:160',
                'onUpdate' => 'required|max:160',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'telephone' => [
                'label' => __('Office Telephone'),
                'placeholder' => __('Office Telephone'),
                'validation' => ['nullable', 'regex:/^([+]|[00]{2})([0-9]|[ -])*/'],
                'onUpdate' => ['nullable', 'regex:/^([+]|[00]{2})([0-9]|[ -])*/'],
                'type' => 'text',
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'address' => [
                'label' => __('Street Address'),
                'placeholder' => __('Street Address'),
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
                'validation' => 'required|max:3',
                'onUpdate' => 'required|max:3',
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
                'required' => false,
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
                'required' => false,
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
                'route' => route('admin.api.settings', 'country'),
                'loadOptions' => false,
                'type' => 'select',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'telephone_secondary' => [
                'label' => __('Secondary Phone'),
                'placeholder' => __('Secondary Phone'),
                'validation' => ['nullable', 'regex:/^([+]|[00]{2})([0-9]|[ -])*/'],
                'onUpdate' => ['nullable', 'regex:/^([+]|[00]{2})([0-9]|[ -])*/'],
                'type' => 'text',
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'email' => [
                'label' => __('Email'),
                'placeholder' => __('Email'),
                'validation' => 'required|email|max:191',
                'onUpdate' => 'required|email|max:191',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'email_secondary' => [
                'label' => __('Secondary Email'),
                'placeholder' => __('Secondary Email'),
                'validation' => 'nullable|email|max:191',
                'onUpdate' => 'nullable|email|max:191',
                'type' => 'text',
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'mobile' => [
                'label' => __('Mobile'),
                'placeholder' => __('Mobile'),
                'validation' => ['required', 'regex:/^([+]|[00]{2})([0-9]|[ -])*/'],
                'onUpdate' => ['required', 'regex:/^([+]|[00]{2})([0-9]|[ -])*/'],
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'mobile_secondary' => [
                'label' => __('Secondary Mobile'),
                'placeholder' => __('Secondary Mobile'),
                'validation' => ['nullable', 'regex:/^([+]|[00]{2})([0-9]|[ -])*/'],
                'onUpdate' => ['nullable', 'regex:/^([+]|[00]{2})([0-9]|[ -])*/'],
                'type' => 'text',
                'required' => false,
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
            $query->orWhere('name', 'like', '%' . $term . '%');
        });
    }
}
