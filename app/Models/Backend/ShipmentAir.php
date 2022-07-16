<?php

namespace App\Models\Backend;

use App\Models\Backend\Lib\Extensions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShipmentAir extends Model
{
    use HasFactory, SoftDeletes, Extensions;

    protected $table = 'shipment_booking';
    protected $primaryKey = 'id';
    protected static $modelNameCanonical = 'Shipment Booking';
    protected static $modelNameSlug = 'shipment_booking';

    // Setup fillable params.
    protected $fillable = [
    ];

    // Extended form layout in case of overrides.
    // protected static $formLayout = [
    //     'Shipment Booking' => [
    //         '',
    //     ],
    //     'Shipment Booking' => [
    //         '',
    //     ],
    // ];

    /**
     * @return array
     */
    public static function getFieldData()
    {
        return [
            'shipment_mode' => [
                'label' => __('Shipment Mode'),
                'placeholder' => __('Select the mode to assign to the Shipment.'),
                'validation' => 'required|array',
                'onUpdate' => 'required|array',
                'required' => true,
                'render' => true,
                'type' => 'select',
                'model' => [
                    'al' => 'By Air',
                    'd2d' => 'Door To Door',
                    'slf' => 'By Sea/Land',
                ],
                'render' => true,
                'hidden' => false,
                'disabled' => false,
                'loadOptions' => true,
            ],
            'shipper' => [
                'label' => __('Shipper'),
                'placeholder' => __('Select the Shipper'),
                'validation' => 'required|array',
                'onUpdate' => 'required|array',
                'required' => true,
                'render' => true,
                'type' => 'select',
                'model' => \App\Models\Backend\CRM\Account::class,
                'hidden' => false,
                'disabled' => false,
                'loadOptions'=>false,
            ],
            'consignee' => [
                'label' => __('Consignee'),
                'placeholder' => __('Select the Consignee'),
                'validation' => 'required|array',
                'onUpdate' => 'required|array',
                'required' => true,
                'render' => true,
                'type' => 'select',
                'model' => \App\Models\Backend\CRM\Account::class,
                'hidden' => false,
                'disabled' => false,
                'loadOptions'=>false,
            ],
            // Conditional Logic : Show only when shipment_mode:al
            'destination' => [
                'label' => __('Destination'),
                'placeholder' => __('Destination'),
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
            'booking_date' => [
                'label' => __('Booking Date'),
                'placeholder' => __('Booking Date'),
                'validation' => 'required|date',
                'onUpdate' => 'required|date',
                'type' => 'date',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'shipment_date' => [
                'label' => __('Shipment Date'),
                'placeholder' => __('Shipment Date'),
                'validation' => 'required|date',
                'onUpdate' => 'required|date',
                'type' => 'date',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'number_of_pieces' => [
                'label' => __('Number of Pieces'),
                'placeholder' => __('Number of Pieces'),
                'validation' => 'required|numeric',
                'onUpdate' => 'required|numeric',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'package_type' => [
                'label' => __('Package Type'),
                'placeholder' => __('Select type of package for the specific Shipment.'),
                'validation' => 'required|array',
                'onUpdate' => 'required|array',
                'required' => true,
                'render' => true,
                'type' => 'select',
                'model' => [
                    'cbb' => 'Cardboard box',
                    'cld' => 'Cold',
                    'sks' => 'Sacks',
                    'rol' => 'Roll',
                    'pbo' => 'Plyboard box',
                    'plg' => 'Plastic Gallon',
                    'mga' => 'Metal Gallon',
                    'meb' => 'Metal Box',
                    'per' => 'Perishable',
                    'fra' => 'Fragile',
                    'fro' => 'Frozen',
                ],
                'multiple' => [
                    'affirm' => true,
                    'limit' => 3,
                ],
                'render' => true,
                'hidden' => false,
                'disabled' => false,
                'loadOptions' => true,
            ],
            'gross_weight' => [
                'label' => __('Gross Weight(KG)'),
                'placeholder' => __('Gross Weight(KG)'),
                'validation' => 'required|numeric|max:10999.99',
                'onUpdate' => 'required|numeric|max:10999.99',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            /*
            *
            */
            'dimensions' => [
                'label' => __('Dimensions'),
                'placeholder' => __('Dimensions'),
                'validation' => 'nullable|max:160',
                'onUpdate' => 'nullable|max:160',
                'type' => 'textarea',
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'cbm_rate' => [
                'label' => __('CBM Rate'),
                'placeholder' => __('Select the appropriate CBM rate.'),
                'validation' => 'nullable|array',
                'onUpdate' => 'nullable|array',
                'required' => false,
                'render' => true,
                'type' => 'select',
                'model' => [
                    '4000' => '4000',
                    '5000' => '5000',
                    '6000' => '6000',
                ],
                'render' => true,
                'hidden' => false,
                'disabled' => false,
                'loadOptions' => true,
            ],
            'pickup_contact_existing' => [
                'label' => __('Pickup Contact for a Shipment'),
                'placeholder' => __('Pickup Contact for a Shipment'),
                'validation' => 'required|array',
                'onUpdate' => 'required|array',
                'required' => true,
                'render' => true,
                'type' => 'select',
                'model' => \App\Models\Backend\CRM\Contact::class,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
                'loadOptions'=>false,
                'multiple' => [
                    'affirm' => true,
                    'limit' => 50,
                ],
            ],
            'pickup_contact' => [
                'label' => __('Pickup Contact for a Shipment'),
                'placeholder' => __('Pickup Contact'),
                'validation' => 'required|array',
                'onUpdate' => 'required|array',
                'type' => 'form',
                'model' => \App\Models\Backend\CRM\Contact::class,
                'table' => [
                    'columns' => [
                        'designation' => 'Designation',
                        'name' => 'Contact Person',
                        'telephone' => 'Telephone',
                    ],
                ],
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'pickup_datetime' => [
                'label' => __('Pickup Date/Time'),
                'placeholder' => __('Pickup Date/Time'),
                'validation' => 'required|date',
                'onUpdate' => 'required|date',
                'type' => 'datetime-local',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'shipment_attachment' => [
                'label' => __('Upload related shipment document(s)'),
                'placeholder' => __('Upload related shipment document(s)'),
                'validation' => 'nullable|array',
                'onUpdate' => 'nullable|array',
                'type' => 'file',
                'required' => false,
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
