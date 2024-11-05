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
        'ktp_image',
        'nik',
        'str_sip',
        'str_sip_image',
        'npwp_image',
        'npwp',
        'province_id',
        'city_id',
        'created_at',
        'deleted_at'

    ];

    protected static function booted()
    {
        static::created(function ($customer) {
            // Buat record billing baru saat customer dibuat
            Billing::create([
                'customer_id' => $customer->id,
                'status' => 'belum_diperpanjang', // Set status default jika ada
            ]);
        });
    }

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

    public function billing()
    {
        return $this->hasOne(Billing::class);
    }
}
