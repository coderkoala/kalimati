<?php

namespace App\Models\Backend\Incident;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Backend\Lib\Extensions;

class Investigation extends Model
{
    use HasFactory, SoftDeletes, Extensions;

    protected $table = 'incident_investigation';
    protected $primaryKey = 'id';
    protected static $modelNameCanonical = 'Incident Investigation';
    protected static $modelNameSlug = 'incident_investigation';

    // Setup fillable params.
    protected $fillable = [
        'name',
    ];

    /**
     * @return array
     */
    public static function getFieldData()
    {
        return array(
            'name' => [
                'label' => __('Case Title'),
                'placeholder' => __('Case Title'),
                'validation' => 'required|max:160',
                'onUpdate' => 'required|max:160',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'reference_incident' => [
                'label' => __('Reference Incident'),
                'placeholder' => __('Reference Incident'),
                'validation' => 'required|integer',
                'onUpdate' => 'required|integer',
                'required' => true,
                'render' => true,
                'type' => 'select',
                'model' => \App\Models\Backend\CRM\Account::class,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'findings' => [
                'label' => __('Investigation findings'),
                'placeholder' => __('Investigation findings'),
                'validation' => 'required|max:512',
                'onUpdate' => 'required|max:512',
                'type' => 'textarea',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'investigation_done_by' => [
                'label' => __('Investigation done by'),
                'placeholder' => __('Investigation done By'),
                'validation' => 'required|array',
                'onUpdate' => 'required|array',
                'required' => true,
                'render' => false,
                'type' => 'select',
                'model' => \App\Domains\Auth\Models\User::class,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'resolution' => [
                'label' => __('Instructions for Resolution'),
                'type' => 'form',
                'model' => \App\Models\Backend\Incident\Instruction::class,
                'render' => true,
                'required' => false,
                'disabled' => false,
                'hidden' => false,
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
