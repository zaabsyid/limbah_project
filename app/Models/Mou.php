<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mou extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mou_number',
        'customer_id',
        'customer_materai_1',
        'customer_materai_2',
        'status',
        'mou_status_file',
        'province_id',
        'city_id',
        'contract_period',
        'contract_end_date',
        'created_at',
        'deleted_at'
    ];

    protected static function booted()
    {
        static::creating(function ($mou) {
            // Tentukan contract_end_date berdasarkan contract_period
            $yearsToAdd = $mou->contract_period == '5' ? 5 : 2;
            $mou->contract_end_date = now()->addYears($yearsToAdd);
        });

        static::created(function ($mou) {
            // Buat instance PerpanjanganMou secara otomatis
            PerpanjanganMou::create([
                'mou_id' => $mou->id,
                'notified' => false,
            ]);

            // Jika paket adalah 5 tahun, buat perpanjangan tahunan secara otomatis
            if ($mou->contract_period == '5') {
                $perpanjanganMou = PerpanjanganMou::where('mou_id', $mou->id)->first();

                for ($i = 1; $i <= 5; $i++) {
                    $perpanjanganMou->renewals()->create([
                        'year' => $i,
                        'due_date' => $mou->created_at->addYears($i), // Set jatuh tempo per tahun
                        'status' => 'orange', // Status default sebagai belum bayar
                    ]);
                }
            }
        });
    }

    /**
     * Relasi ke model PerpanjanganMou
     */
    public function perpanjangan()
    {
        return $this->hasOne(PerpanjanganMou::class);
    }

    /**
     * Define the relationship with the Customer model.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
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
}
