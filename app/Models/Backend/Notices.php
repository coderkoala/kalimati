<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid as PackageUuid;

class Notices extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'notices';
    protected $primaryKey = 'id';

    // Setup fillable params.
    protected $fillable = [
        'type',
        'title_en',
        'title_np',
        'content_en',
        'content_np',
        'published_at',
        'modal_view',
        'url',
        'created_by',
    ];

    /**
     * @return array
     */
    public static function getFieldData()
    {
        return array(
            'type'=>[
                'label' => __('Type of the Notice'),
                'placeholder' => __('Notice Type'),
                'validation' => 'required',
                'onUpdate' => 'sometimes',
                'required' => true,
                'render' => true,
                'type' => 'select',
                'model' => [
                    'notice' => __('General Notice'),
                    'tender' => __('Tender Invitations'),
                    'pest' => __('Pesticides Report'),
                    'traders' => __('Notice for Traders'),
                    'bill_publication' => __('Publicized Bills'),
                    'publication' => __('Literature Publication'),
                    'annual' => __('General Report')
                ],
                'render' => true,
                'hidden' => false,
                'disabled' => true,
            ],
            'title_en' => [
                'label' => __('Title of the Publication (In English)'),
                'placeholder' => __('Title of the Publication (In English)'),
                'validation' => 'required|max:255',
                'onUpdate' => 'required|max:255',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'content_en' => [
                'label' => __('Publication Content (In English)'),
                'placeholder' => __('Publication Content (In English)'),
                'validation' => 'required|max:1000',
                'onUpdate' => 'required|max:1000',
                'type' => 'textarea',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'title_np' => [
                'label' => __('Title of the Publication (In Nepali)'),
                'placeholder' => __('Title of the Publication (In Nepali)'),
                'validation' => 'required|max:255',
                'onUpdate' => 'required|max:255',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'content_np' => [
                'label' => __('Publication Content (In Nepali)'),
                'placeholder' => __('Publication Content (In Nepali)'),
                'validation' => 'required|max:1000',
                'onUpdate' => 'required|max:1000',
                'type' => 'textarea',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'published_at' => [
                'label' => __('Noticed Published At'),
                'placeholder' => __('Noticed Published At'),
                'validation' => 'required|date',
                'onUpdate' => 'required|date',
                'type' => 'date',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
                'value'=> date('Y-m-d')
            ],
            'url' => [
                'label' => __('Notice File'),
                'placeholder' => __('Notice File'),
                'validation' => 'required|url',
                'onUpdate' => 'required|url',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'modal_view'=>[
                'label' => __('Modal View Notice'),
                'placeholder' => __('Modal View Notice'),
                'validation' => 'sometimes',
                'onUpdate' => 'sometimes',
                'required' => false,
                'render' => true,
                'type' => 'select',
                'model' => [
                    'true' => __('Enabled'),
                    'false' => __('Disabled'),
                ],
                'render' => true,
                'hidden' => false,
                'disabled' => true,
            ],
            'created_by' => [
                'label' => __('Notice Created By'),
                'placeholder' => __('Notice Created By'),
                'validation' => 'required|integer',
                'onUpdate' => 'required|integer',
                'required' => true,
                'render' => true,
                'type' => 'select',
                'model' => \App\Domains\Auth\Models\User::class,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
        );
    }

    // Set up a one to many inverse relationship with the users table.
    public function user_details()
    {
        return $this->belongsTo('App\Domains\Auth\Models\User', 'user_id', 'id');
    }

    /**
     * @param $query
     * @param $term
     * @return mixed
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($query) use ($term) {
            $query->where('title_en', 'like', '%' . $term . '%')
                ->orWhere('title_np', 'like', '%' . $term . '%')
                ->orWhere('content_en', 'like', '%' . $term . '%')
                ->orWhere('content_np', 'like', '%' . $term . '%')
                ->orWhere('published_at', 'like', '%' . $term . '%');
        });
    }

    /**
     * @param $query
     * @param $uuid
     * @return mixed
     */
    public function scopeUuid($query, $uuid)
    {
        return $query->where($this->getUuidName(), $uuid);
    }

    /**
     * @return string
     */
    public function getUuidName()
    {
        return property_exists($this, 'uuidName') ? $this->uuidName : 'uuid';
    }

    /**
     * Use Laravel bootable traits.
     */
    protected static function bootUuid()
    {
        static::creating(function ($model) {
            $model->{$model->getUuidName()} = PackageUuid::uuid4()->toString();
        });
    }
}
