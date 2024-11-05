<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $fillable = ['customer_id', 'document_payment', 'status', 'created_at', 'deleted_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
