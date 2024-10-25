<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mou extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'customer_address',
        'npwp',
        'ktp',
        'sip_str',
        'package',
        'owner_photo',
        'status',
        'city',
        'contract_period',
        'contract_end_date'
    ];

    public function isDraft()
    {
        return $this->status === 'draft';
    }

    public function isFinal()
    {
        return $this->status === 'final';
    }
}
