<?php

namespace App\Models\Backend\Incident;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Backend\Lib\Extensions;

class Event extends Model
{
    use HasFactory, SoftDeletes, Extensions;

    protected $table = 'incident';
    protected $primaryKey = 'id';
    protected static $modelNameCanonical = 'Incident';
    protected static $modelNameSlug = 'incident';

    // Setup fillable params.
    protected $fillable = [
        'name',
    ];

    // Extended form layout in case of overrides.
    protected static $formLayout = [
        'Basic Information' => [
            'name',
            'entity',
            'medium',
            'date_incident_filed_on',
            'reference_shipment',
            'incident_details',
            'remarks',
            'feedback_received_by',
            'assigned_to',
        ],
        'Additional Information' => [
            'file'
        ],
    ];

    /**
     * @return array
     */
    public static function getFieldData()
    {
        return array(
            'name' => [
                'label' => __('Incident Title'),
                'placeholder' => __('Incident Title'),
                'validation' => 'required|max:160',
                'onUpdate' => 'required|max:160',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            // @todo @coderkoala -> All
            // Create a search-hunt datatable with mixed entities:
            // AWB/Job
            'entity' => [
                'label' => __('Entity'),
                'placeholder' => __('Incident to lodge against'),
                'validation' => 'required|integer',
                'onUpdate' => 'required|integer',
                'required' => true,
                'render' => true,
                'type' => 'select',
                'model' => \App\Models\Backend\CRM\Account::class,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
                'multiple'=>[
                    'affirm' => true,
                    'limit' => 10,
                ],
            ],
            'medium' => [
                'label' => __('Feedback received through'),
                'placeholder' => __('Feedback received through'),
                'validation' => 'required|integer',
                'onUpdate' => 'required|integer',
                'required' => true,
                'render' => false,
                'type' => 'select',
                'model' => [
                    'email' => __('Email'),
                    'phone' => __('Phone'),
                    'in-person' => __('In-Person'),
                    'other' => __('Other'),
                ],
                'render' => true,
                'hidden' => false,
                'disabled' => false,
                'loadOptions' => true
            ],
            'date_incident_filed_on' => [
                'label' => __('Incident occured on'),
                'placeholder' => __('Incident occured on'),
                'validation' => 'required|date',
                'onUpdate' => 'required|date',
                'type' => 'date',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            // Todo @coderkoala : replace model by Shipment Model, when it has been made.
            'reference_shipment' => [
                'label' => __('Shipment Affected'),
                'placeholder' => __('Shipment Affected'),
                'validation' => 'required|integer',
                'onUpdate' => 'required|integer',
                'required' => true,
                'render' => true,
                'type' => 'select',
                'model' => \App\Models\Backend\CRM\Account::class,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
                'multiple'=>[
                    'affirm' => true,
                    'limit' => 10,
                ],
            ],
            'incident_details' => [
                'label' => __('Incident Details'),
                'placeholder' => __('Incident Details'),
                'validation' => 'required|max:512',
                'onUpdate' => 'required|max:512',
                'type' => 'textarea',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'remarks' => [
                'label' => __('Remarks'),
                'placeholder' => __('Write your remarks here.'),
                'validation' => 'required|max:128',
                'onUpdate' => 'required|max:128',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'feedback_received_by' => [
                'label' => __('Feedback received by'),
                'placeholder' => __('Feedback Received By'),
                'validation' => 'required|array',
                'onUpdate' => 'required|array',
                'required' => true,
                'render' => false,
                'type' => 'select',
                'model' => \App\Domains\Auth\Models\User::class,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
                'loadOptions' => true
            ],
            'assigned_to' => [
                'label' => __('Assigned To'),
                'placeholder' => __('Select user(s) assign the task to.'),
                'validation' => 'required|array',
                'onUpdate' => 'required|array',
                'required' => true,
                'render' => true,
                'type' => 'select',
                'model' => \App\Domains\Auth\Models\User::class,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
                'multiple' => [
                    'affirm' => true,
                    'limit' => 50,
                ],
                'loadOptions' => true
            ],
            'file' => [
                'label' => __('Upload your files here'),
                'placeholder' => __('Upload your files here'),
                'validation' => 'required|array',
                'onUpdate' => 'required|array',
                'type' => 'file',
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
