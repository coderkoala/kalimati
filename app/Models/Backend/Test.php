<?php

namespace App\Models\Backend;

use App\Models\Backend\Lib\Extensions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    use HasFactory, SoftDeletes, Extensions;

    protected $table = 'test';
    protected $primaryKey = 'id';
    protected static $modelNameCanonical = 'Test';
    protected static $modelNameSlug = 'test';

    // Setup fillable params.
    protected $fillable = [
        'name',
    ];

    // Extended form layout in case of overrides.
    protected static $formLayout = [
        'Licensee Basic Information' => [
            'name',
            'surname',
            'country',
            'isMale',
            'type',
            'date',
        ],
        'Licensee Additional Data' => [
            'agenda',
            'file',
        ],
    ];

    /**
     * @return array
     */
    public static function getFieldData()
    {
        return [
            'name' => [
                'label' => __('Name'),
                'placeholder' => __('Name'),
                'validation' => 'required|max:160',
                'onUpdate' => 'required|max:160',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'surname' => [
                'label' => __('Surname'),
                'placeholder' => __('Surname'),
                'validation' => 'required|max:160',
                'onUpdate' => 'required|max:160',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'country' => [
                'label' => __('Country'),
                'placeholder' => __('Select user to mint license to.'),
                'validation' => 'required|array',
                'onUpdate' => 'required|array',
                'required' => true,
                'render' => true,
                'type' => 'select',
                'model' => [
                    '0' => 'Select country',
                    '1' => 'Nepal',
                    '2' => 'India',
                    '3' => 'China',
                    '4' => 'Bhutan',
                ],
                'multiple'=>[
                    'affirm' => true,
                    'limit' => 0,
                ],
                'hidden' => false,
                'disabled' => false,
            ],
            'isMale' => [
                'label' => __('Is subject male?'),
                'validation' => 'required|boolean',
                'onUpdate' => 'required|boolean',
                'required' => true,
                'render' => true,
                'type' => 'bool',
                'hidden' => false,
                'disabled' => false,
            ],
            'agenda' => [
                'label' => __('Agenda'),
                'placeholder' => __('Agenda'),
                'validation' => 'nullable|max:160',
                'onUpdate' => 'nullable|max:160',
                'type' => 'textarea',
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'type' => [
                'label' => __('Client Group Type'),
                'placeholder' => __('Type of Client Group'),
                'validation' => 'required|array',
                'model' => \App\Domains\Auth\Models\User::class,
                'onUpdate' => 'required|array',
                'type' => 'checkbox',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'file' => [
                'label' => __('Upload your files here'),
                'placeholder' => __('Upload your files here'),
                'validation' => 'nullable|array',
                'onUpdate' => 'nullable|array',
                'type' => 'file',
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'date' => [
                'label' => __('Date of Birth'),
                'placeholder' => __('Date of Birth'),
                'validation' => 'required|date',
                'onUpdate' => 'required|date',
                'type' => 'date',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
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
