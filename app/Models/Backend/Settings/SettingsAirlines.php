<?php

namespace App\Models\Backend\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Lib\Extensions;

class SettingsAirlines extends Model
{
    use HasFactory, Extensions;

    protected $table = 'settings_airlines';
    protected $primaryKey = 'id';
    protected static $modelNameCanonical = 'Airline Settings';
    protected static $modelNameSlug = 'settings_airlines';
    public $incrementing = false;

    // Setup fillable params.
    protected $fillable = [
        'id',
        'name',
        'territory',
        'prefix',
        'account_code',
    ];

    /**
     * @return array
     */
    public static function getFieldData()
    {
        return array(
            'name' => [
                'label' => __('Country Name'),
                'placeholder' => __('Country Name'),
                'validation' => 'required|string|max:80',
                'onUpdate' => 'required|string|max:80',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'territory' => [
                'label' => __('Airliner Territory'),
                'placeholder' => __('Airliner Territory'),
                'validation' => 'required|string|max:80',
                'onUpdate' => 'required|string|max:80',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'id' => [
                'label' => __('Airliner Code'),
                'placeholder' => __('Airliner Code (2 letters)'),
                'validation' => 'required|string|max:4',
                'onUpdate' => 'required|string|max:4',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'account_code' => [
                'label' => __('Account Code'),
                'placeholder' => __('Airlines Account Code (Max 4 letters)'),
                'validation' => 'required|string|max:4',
                'onUpdate' => 'required|string|max:4',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'prefix_code' => [
                'label' => __('Prefix Code'),
                'placeholder' => __('Airlines Prefix Code (Max 4 letters)'),
                'validation' => 'required|string|max:4',
                'onUpdate' => 'required|string|max:4',
                'type' => 'text',
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
            $query->orWhere('name', 'like', '%' . $term . '%')
                  ->orWhere('prefix', 'like', '%' . $term . '%')
                  ->orWhere('city_id', 'like', '%' . $term . '%')
                  ->orWhere('id', 'like', '%' . $term . '%');
        });
    }
}
