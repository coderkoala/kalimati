<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid as PackageUuid;

class Articles extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'articles';
    protected $primaryKey = 'id';

    // Setup fillable params.
    protected $fillable = [
        'article_uuid',
        'slug',
        'article_image',
        'title_en',
        'title_np',
        'content_en',
        'content_excerpt_en',
        'content_np',
        'content_excerpt_np',
        'user_id',
        'status',
        'comment_status',
        'published_at',
    ];

    /**
     * @return array
     */
    public static function getFieldData()
    {
        return array(
            'article_uuid' => [
                'label' => __('Page UUID'),
                'placeholder' => __('Page UUID'),
                'validation' => 'sometimes',
                'onUpdate' => 'sometimes',
                'type' => 'text',
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => true,
            ],
            'slug' => [
                'label' => __('Web Slug'),
                'placeholder' => __('Web Slug'),
                'validation' => 'sometimes|max:255',
                'onUpdate' => 'sometimes|max:255',
                'type' => 'text',
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => true,
            ],
            'title_en' => [
                'label' => __('Page Title (English)'),
                'placeholder' => __('Page Title (English)'),
                'validation' => 'required|max:255',
                'onUpdate' => 'required|max:255',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'content_en' => [
                'label' => __('Content (English)'),
                'placeholder' => __('Enter Content for the Article (English)'),
                'validation' => 'sometimes',
                'onUpdate' => 'sometimes',
                'type' => 'textarea',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'content_excerpt_en' => [
                'label' => __('Content Excerpt (English)'),
                'placeholder' => __('Enter Content Excerpt for the Article (English) - 160 characters or less.'),
                'validation' => 'sometimes|max:160',
                'onUpdate' => 'sometimes|max:160',
                'type' => 'textarea',
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => true,
            ],
            'title_np' => [
                'label' => __('Article Title (Nepali)'),
                'placeholder' => __('Article Title (Nepali)'),
                'validation' => 'required|max:255',
                'onUpdate' => 'required|max:255',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'content_np' => [
                'label' => __('Content (Nepali)'),
                'placeholder' => __('Enter Content for the Article (Nepali)'),
                'validation' => 'sometimes',
                'onUpdate' => 'sometimes',
                'type' => 'textarea',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'content_excerpt_np' => [
                'label' => __('Content Excerpt (Nepali)'),
                'placeholder' => __('Enter Content Excerpt for the Article (Nepali) - 160 characters or less.'),
                'validation' => 'sometimes|max:160',
                'onUpdate' => 'sometimes|max:160',
                'type' => 'textarea',
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => true,
            ],
            'article_image' => [
                'label' => __('Article Image'),
                'placeholder' => __('Article Image'),
                'validation' => 'nullable|url',
                'onUpdate' => 'nullable|url',
                'type' => 'text',
                'value' => asset('img/slide1.jpg'),
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => true,
            ],
            // 'comment_status'=>[
            //     'label' => __('Comment Status'),
            //     'placeholder' => __('Comment Status'),
            //     'validation' => 'sometimes',
            //     'onUpdate' => 'sometimes',
            //     'required' => true,
            //     'render' => true,
            //     'type' => 'select',
            //     'model' => [
            //         'open' => __('Open'),
            //         'closed' => __('Closed'),
            //     ],
            //     'render' => true,
            //     'hidden' => false,
            //     'disabled' => false,
            // ],
            'user_id' => [
                'label' => __('Article Written By'),
                'placeholder' => __('Article Written By'),
                'validation' => 'sometimes|integer',
                'onUpdate' => 'sometimes|integer',
                'required' => false,
                'render' => true,
                'type' => 'select',
                'model' => \App\Domains\Auth\Models\User::class,
                'render' => true,
                'hidden' => false,
                'disabled' => true,
            ],
            'status'=>[
                'label' => __('Article Status'),
                'placeholder' => __('Article Status'),
                'validation' => 'sometimes',
                'onUpdate' => 'sometimes',
                'required' => false,
                'render' => true,
                'type' => 'select',
                'model' => [
                    'draft' => __('Draft'),
                    'published' => __('Published'),
                    'archived' => __('Archived'),
                ],
                'render' => true,
                'hidden' => false,
                'disabled' => true,
            ],
            'created_at' => [
                'label' => __('Created At'),
                'placeholder' => __('Select appropriate Date'),
                'validation' => 'sometimes|date',
                'onUpdate' => 'sometimes|date',
                'required' => false,
                'type' => 'datetime',
                'render' => true,
                'hidden' => false,
                'disabled' => true,
            ],
            'published_at' => [
                'label' => __('Published At'),
                'placeholder' => __('Select appropriate Date'),
                'validation' => 'sometimes|date',
                'onUpdate' => 'sometimes|date',
                'required' => false,
                'type' => 'datetime',
                'render' => true,
                'hidden' => false,
                'disabled' => true,
            ],
            'updated_at' => [
                'label' => __('Updated At'),
                'placeholder' => __('Select appropriate Date'),
                'validation' => 'sometimes|date',
                'onUpdate' => 'sometimes|date',
                'required' => false,
                'type' => 'datetime',
                'render' => true,
                'hidden' => false,
                'disabled' => true,
            ],
            'deleted_at' => [
                'label' => __('Deleted At'),
                'placeholder' => __('Select appropriate Date'),
                'validation' => 'nullable|date',
                'onUpdate' => 'nullable|date',
                'required' => false,
                'type' => 'datetime',
                'render' => true,
                'hidden' => false,
                'disabled' => true,
            ]
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
                ->orWhere('content_excerpt_en', 'like', '%' . $term . '%')
                ->orWhere('content_np', 'like', '%' . $term . '%')
                ->orWhere('content_excerpt_np', 'like', '%' . $term . '%')
                ->orWhere('status', 'like', '%' . $term . '%')
                ->orWhere('content_np', 'like', '%' . $term . '%');
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
