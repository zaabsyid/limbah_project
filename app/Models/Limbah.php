<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Limbah extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'limbahs';

    protected $fillable = [
        'customer_id',
        'code_manifest',
        'document_manifest',
        'weight_limbah',
        'pickup_1',
        'pickup_2',
        'pickup_3',
        'pickup_4',
        'date_pickup_1',
        'date_pickup_2',
        'date_pickup_3',
        'date_pickup_4',
        'driver_id',
        'province_id',
        'city_id',
        'created_at',
        'deleted_at'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    protected static function booted()
    {
        static::saving(function ($limbah) {
            // Cek apakah code, document manifest, weight limbah diunggah dan status pickup belum_dijemput
            if ($limbah->code_manifest && $limbah->document_manifest && $limbah->weight_limbah && $limbah->pickup_1 === 'belum_dijemput' && $limbah->pickup_2 === 'belum_dijemput' && $limbah->pickup_3 === 'belum_dijemput' && $limbah->pickup_4 === 'belum_dijemput') {
                $limbah->pickup_1 = 'siap_dijemput';
                $limbah->pickup_2 = 'siap_dijemput';
                $limbah->pickup_3 = 'siap_dijemput';
                $limbah->pickup_4 = 'siap_dijemput';
            }
        });
    }

    // public function isPending()
    // {
    //     return $this->status === 'pending';
    // }

    // public function isPickedUp()
    // {
    //     return $this->status === 'picked_up';
    // }

    // public function isTerminated()
    // {
    //     return $this->status === 'terminated';
    // }
}
