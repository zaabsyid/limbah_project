<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'occupation',
        'nik',
        'str_sip',
        'npwp',
        'image',
        'customer_image_2',
        'customer_npwp_file',
        'customer_ktp_file',
        'customer_str_sip_file',
        'province_id',
        'city_id',
    ];

    /**
     * Define the relationship with the Province model.
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * Define the relationship with the City model.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // Relasi dengan Billing
    public function billings()
    {
        return $this->hasMany(Billing::class);
    }
}
