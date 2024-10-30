<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $fillable = ['customer_id', 'pick_up_id', 'customer_name', 'amount', 'due_date', 'status'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function pickUp()
    {
        return $this->belongsToMany(PickUp::class, 'billing_pickup');
    }
}
