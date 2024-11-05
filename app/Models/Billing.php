<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $fillable = ['customer_id', 'due_date', 'status'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
