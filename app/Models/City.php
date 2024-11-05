<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $fillable = ['province_id', 'name'];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function customer()
    {
        return $this->hasMany(Customer::class);
    }

    public function limbah()
    {
        return $this->hasMany(Limbah::class);
    }

    public function mou()
    {
        return $this->hasMany(Mou::class);
    }
}
