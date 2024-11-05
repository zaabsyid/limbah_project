<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PickUp extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'mou_id',
        'customer_id',
        'driver_id',
        'pickup_code',
        'pickup_date',
        'total_weight',
        'total_price',
        'remarks',
        'payment_status',
        'pickup_status',
    ];

    // Relasi dengan MoU
    public function mou()
    {
        return $this->belongsTo(Mou::class);
    }

    // Relasi dengan Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relasi dengan Driver
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    // Relasi dengan PickUpDetail
    public function details()
    {
        return $this->hasMany(PickUpDetail::class);
    }
}
