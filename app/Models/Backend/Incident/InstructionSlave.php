<?php

namespace App\Models\Backend\Incident;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Backend\Lib\Extensions;

class InstructionSlave extends Model
{
    use HasFactory, SoftDeletes, Extensions;

    protected $table = 'instruction';
    protected $primaryKey = 'id';
    protected static $modelNameCanonical = 'Instruction';
    protected static $modelNameSlug = 'instruction';

    // Setup fillable params.
    protected $fillable = [
        'name',
        'remarks',
        'status',

    ];

    /**
     * @return array
     */
    public static function getFieldData()
    {
        return array(
            'name' => [
                'label' => __('Instructions'),
                'placeholder' => __('Instructions'),
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
            'status' => [
                'label' => __('Instruction Status'),
                'placeholder' => __('Select the appropriate CBM rate.'),
                'validation' => 'nullable|in:next,never,recurring',
                'onUpdate' => 'nullable|in:next,never,recurring',
                'required' => false,
                'render' => true,
                'type' => 'select',
                'model' => [
                    'recurring' => 'Always show on all shipments',
                    'next' => 'Show one-time on active shipments',
                    'never' => 'Inactive Instruction',
                ],
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
