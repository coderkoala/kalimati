<?php

namespace App\Models\Backend\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Lib\Extensions;

class SettingsCity extends Model
{
    use HasFactory, Extensions;

    protected $table = 'settings_city';
    protected $primaryKey = 'id';
    protected static $modelNameCanonical = 'City Settings';
    protected static $modelNameSlug = 'settings_city';
    public $incrementing = false;

    // Setup fillable params.
    protected $fillable = [
        'id',
        'name',
        'country_id',
    ];

    /**
     * @return array
     */
    public static function getFieldData()
    {
        return array(
            'name' => [
                'label' => __('City Name'),
                'placeholder' => __('City Name'),
                'validation' => 'required|string|max:160',
                'onUpdate' => 'required|string|max:160',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'id' => [
                'label' => __('Country ISO Code'),
                'placeholder' => __('Country ISO Code (3 letters)'),
                'validation' => 'required|string|length:3',
                'onUpdate' => 'required|string|length:3',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'country_id' => [
                'label' => __('Belonging Country'),
                'placeholder' => __('Select Belonging Country'),
                'validation' => 'required|array',
                'onUpdate' => 'required|array',
                'model' => \App\Models\Backend\Settings\SettingsCountry::class,
                'type' => 'select',
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
            $query->orWhere('name', 'like', '%' . $term . '%')->orWhere('id', 'like', '%' . $term . '%')->orWhere('country_id', 'like', '%' . $term . '%');
        });
    }
}
