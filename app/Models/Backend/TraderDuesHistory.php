<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraderDuesHistory extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'traders_due_history';

    // Setup fillable params.
    protected $fillable = [
        'id',
        'trader_id',
        'tradername',
        'shop_id',
        'due_date',
        'monthly_rent',
        'late_fee',
        'other_amount',
        'adjustment',
        'total_amount',
    ];

    /**
     * Get all of the payments for the TraderDuesHistory.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(\App\Models\Backend\TraderDuesPayment::class, 'vendor_id');
    }
}
