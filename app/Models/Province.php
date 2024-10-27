<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['name'];

    public function city()
    {
        return $this->hasMany(City::class);
    }

    public function customer()
    {
        return $this->hasMany(Customer::class);
    }

    public function mou()
    {
        return $this->hasMany(Mou::class);
    }
}
