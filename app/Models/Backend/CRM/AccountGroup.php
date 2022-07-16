<?php

namespace App\Models\Backend\CRM;

use App\Models\Backend\Lib\Extensions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountGroup extends Model
{
    use HasFactory, SoftDeletes, Extensions;

    protected $table = 'account_group';
    protected $primaryKey = 'id';
    protected static $modelNameCanonical = 'Account Group';
    protected static $modelNameSlug = 'account_group';

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
                'label' => __('Account Group'),
                'placeholder' => __('Account Group Name'),
                'validation' => 'required|max:160',
                'onUpdate' => 'required|max:160',
                'type' => 'text',
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
