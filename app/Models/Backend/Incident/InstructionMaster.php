<?php

namespace App\Models\Backend\Incident;

use App\Models\Backend\Lib\Extensions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// @todo : @coderkoala
// Allow this to map to the same table as the parent model.
// BUT, we need to make sure the customer associated is not
// created, but inherited from a select dropdown.
class InstructionMaster extends Model
{
    use HasFactory, SoftDeletes, Extensions;

    protected $table = 'instruction';
    protected $primaryKey = 'id';
    protected static $modelNameCanonical = 'Instruction';
    protected static $modelNameSlug = 'instruction';

    // Setup fillable params.
    protected $fillable = [
        'name',
    ];

    // Setup the table columns to render in table.
    protected static $tableColumns = [
        'referenced_customer' => [
            'label' => 'Customer Referenced',
            'sortable' => true,
        ],
        'remarks' => [
            'label' => 'Instruction Remarks',
            'sortable' => true,
        ],
        'assigned_to' => [
            'label' => 'Assigned To',
            'sortable' => true,
        ],
    ];

    /**
     * @return array
     */
    public static function getFieldData()
    {
        return [
            'referenced_customer' => [
                'label' => __('Referenced Customer'),
                'placeholder' => __('Referenced Customer'),
                'validation' => 'required|array',
                'onUpdate' => 'required|array',
                'required' => true,
                'render' => true,
                'type' => 'select',
                'model' => \App\Models\Backend\CRM\Account::class,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'instruction' => [
                'label' => __('Instruction'),
                'placeholder' => __('Instruction'),
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
                'placeholder' => __('Remarks'),
                'validation' => 'nullable|max:160',
                'onUpdate' => 'nullable|max:160',
                'type' => 'text',
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
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
                'loadOptions' => true,
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
