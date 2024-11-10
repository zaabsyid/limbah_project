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

        static::created(function ($customer) {
            $limbah = Limbah::create([
                'customer_id' => $customer->id,
                'province_id' => $customer->province_id,
                'city_id' => $customer->city_id,
                'driver_id' => '1',
                // tambahkan field lain sesuai dengan kebutuhan Anda
            ]);

            for ($i = 1; $i <= 4; $i++) {
                PenjemputanLimbah::create([
                    'limbah_id' => $limbah->id,
                    'pickup' => 'belum_dijemput',
                    'date_pickup' => now()->addMonths($i * 3), // Setiap 3 bulan untuk setiap periode
                ]);
            }
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

    public function limbahs()
    {
        return $this->hasMany(Limbah::class);
    }
}
