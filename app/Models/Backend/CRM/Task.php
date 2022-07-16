<?php

namespace App\Models\Backend\CRM;

use App\Models\Backend\Lib\Extensions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes, Extensions;

    protected $table = 'task';
    protected $primaryKey = 'id';
    protected static $modelNameCanonical = 'Task Management';
    protected static $modelNameSlug = 'task';

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
            'name' => [
                'label' => __('Task Title'),
                'placeholder' => __('Task Title'),
                'validation' => 'required|max:160',
                'onUpdate' => 'required|max:160',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'due_date' => [
                'label' => __('Due Date'),
                'placeholder' => __('Due Date'),
                'validation' => 'required|date',
                'onUpdate' => 'required|date',
                'type' => 'date',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'description' => [
                'label' => __('Task Description'),
                'placeholder' => __('Task Description'),
                'validation' => 'required|max:512',
                'onUpdate' => 'required|max:512',
                'type' => 'textarea',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            // @Todo : Replace with Checklist model.
            // @todo : @coderkoala.
            'task_checklist' => [
                'label' => __('Checklist'),
                'placeholder' => __('Task Description'),
                'validation' => 'required|max:512',
                'onUpdate' => 'required|max:512',
                'type' => 'checklist',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            // Pivot table.  Multi-select;
            // @todo : @coderkoala.
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
                    'limit' => 10,
                ],
                'loadOptions' => true,
            ],
            'recurrence' => [
                'label' => __('Recurrence'),
                'placeholder' => __('Select the interval at which the event will reoccur.'),
                'validation' => 'nullable',
                'onUpdate' => 'nullable',
                'required' => true,
                'render' => true,
                'type' => 'select',
                'model' => [
                    'daily' => 'Daily',
                    'weekly' => 'Weekly',
                    'biweekly' => 'Bi-Weekly',
                    'monthly' => 'Monthly',
                    'quarterly' => 'Quarterly',
                    'yearly' => 'Yearly',
                    'none' => 'None',
                ],
                'render' => true,
                'loadOptions' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'start_from' => [
                'label' => __('Start From'),
                'placeholder' => __('Start From'),
                'validation' => 'nullable|date',
                'onUpdate' => 'nullable|date',
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
