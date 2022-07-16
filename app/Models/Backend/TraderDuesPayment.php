<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as PackageUuid;

class TraderDuesPayment extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'traders_due_payment';

    // Setup fillable params.
    protected $fillable = [
        'vendor_id',
        'notify_email',
        'payment_uuid',
        'payment_channel',
        'payment_data',
        'reference_data',
        'paid_on',
        'status',
        'amount_paid',
    ];

    protected $casts = [
        'payment_data' => 'array',
    ];

    /**
     * @return array
     */
    public static function getFieldData()
    {
        return [
            'notify_email' => [
                'label' => __('Notify Email Address'),
                'placeholder' => __('Notify Email Address'),
                'validation' => 'required|max:255|email',
                'onUpdate' => 'required|max:255|email',
                'type' => 'text',
                'required' => false,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'payment_uuid' => [
                'label' => __('Payment ID'),
                'placeholder' => __('Payment identification of the transaction'),
                'validation' => 'max:36',
                'onUpdate' => 'max:36',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'payment_channel'=>[
                'label' => __('Payment Channel Used'),
                'placeholder' => __('The payment gateway used'),
                'validation' => 'in:esewa,cips,web',
                'onUpdate' => 'in:esewa,cips,web',
                'required' => false,
                'render' => true,
                'type' => 'select',
                'model' => [
                    'esewa' => __('Esewa'),
                    'cips' => __('Connect IPS'),
                    'web' => __('Web'),
                ],
                'hidden' => false,
                'disabled' => true,
            ],
            'payment_data'=>[
                'label' => __('Payment Data'),
                'placeholder' => __('Payment Data'),
                'validation' => 'required|json',
                'onUpdate' => 'required|json',
                'type' => 'json',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
            ],
            'paid_on' => [
                'label' => __('Payment completed'),
                'placeholder' => __('Payment completed'),
                'validation' => 'nullable|date',
                'onUpdate' => 'nullable|date',
                'required' => false,
                'type' => 'datetime',
                'render' => true,
                'hidden' => false,
                'disabled' => true,
            ],
            'status'=>[
                'label' => __('Status of Payment'),
                'placeholder' => __('Payment Status'),
                'validation' => 'in:processing,unverified,verified,failed',
                'onUpdate' => 'in:processing,unverified,verified,failed',
                'render' => true,
                'type' => 'select',
                'model' => [
                    'processing' => __('Processing'),
                    'unverified' => __('Unverified'),
                    'verified' => __('Verified'),
                    'failed' => __('Failed'),
                ],
                'required' => false,
                'hidden' => false,
                'disabled' => true,
            ],
            'amount_paid' => [
                'label' => __('Amount Paid'),
                'placeholder' => __('Amount Paid'),
                'validation' => 'required|numeric|between:0.00,9999999.99',
                'onUpdate' => 'required|numeric|between:0.00,9999999.99',
                'type' => 'text',
                'required' => true,
                'render' => true,
                'hidden' => false,
                'disabled' => false,
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
            $query->where('payment_uuid', 'like', '%'.$term.'%')
                ->orWhere('payment_channel', 'like', '%'.$term.'%')
                ->orWhere('notify_email', 'like', '%'.$term.'%')
                ->orWhere('status', 'like', '%'.$term.'%')
                ->orWhereHas('trader_dues', function ($query) use ($term) {
                    $query->where('tradername', 'like', '%'.$term.'%')
                    ->orWhere('trader_id', 'like', '%'.$term.'%')
                    ->orWhere('shop_id', 'like', '%'.$term.'%');
                });
        });
    }

    /**
     * Get the due associated with the TraderDuesPayment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function trader_dues()
    {
        return $this->hasOne(\App\Models\Backend\TraderDuesHistory::class, 'id', 'vendor_id');
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
