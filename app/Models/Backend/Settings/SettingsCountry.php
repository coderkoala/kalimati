<?php

namespace App\Models\Backend\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Lib\Extensions;

class SettingsCountry extends Model
{
    use HasFactory, Extensions;

    protected $table = 'settings_country';
    protected $primaryKey = 'id';
    protected static $modelNameCanonical = 'Country Settings';
    protected static $modelNameSlug = 'settings_country';
    public $incrementing = false;

    // Setup fillable params.
    protected $fillable = [
        'id',
        'name',
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
                'placeholder' => __('Country ISO Code (2 letters)'),
                'validation' => 'required|string|max:2',
                'onUpdate' => 'required|string|max:2',
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
            $query->orWhere('name', 'like', '%' . $term . '%')->orWhere('id', 'like', '%' . $term . '%');
        });
    }
}
