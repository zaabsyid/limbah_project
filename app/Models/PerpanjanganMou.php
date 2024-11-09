<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerpanjanganMou extends Model
{
    protected $fillable = [
        'mou_id',
        'notified',
    ];

    public function mou()
    {
        return $this->belongsTo(Mou::class, 'mou_id');
    }

    /**
     * Akses `contract_period` dari relasi `mou`
     */
    public function getContractPeriodAttribute()
    {
        return $this->mou->contract_period;
    }

    /**
     * Akses `customer` melalui `mou`
     */
    public function customer()
    {
        return $this->mou->customer;
    }

    // protected static function booted()
    // {
    //     static::created(function ($mou) {
    //         if ($mou->package == '5') {
    //             // Membuat perpanjangan tahunan untuk paket 5 tahun
    //             for ($i = 1; $i <= 5; $i++) {
    //                 $mou->renewals()->create([
    //                     'year' => $i,
    //                     'due_date' => $mou->created_at->addYears($i), // Set jatuh tempo per tahun
    //                     'status' => 'orange', // Status default sebagai belum bayar
    //                 ]);
    //             }
    //         }
    //     });
    // }

    /**
     * Relasi dengan model MouRenewal
     */
    public function renewals()
    {
        return $this->hasMany(MouRenewal::class, 'perpanjangan_mou_id');
    }

    /**
     * Mengirim notifikasi saat MoU mendekati jatuh tempo (untuk paket 2 tahun)
     */
    public function sendDueNotification()
    {
        if ($this->package == '2' && !$this->notified && $this->due_date <= now()) {
            // Logika untuk mengirim email ke admin (misalnya menggunakan Laravel Mail)
            // Mail::to('admin@example.com')->send(new MouDueNotification($this));

            $this->update(['notified' => true, 'status' => 'red']); // Tandai sebagai jatuh tempo
        }
    }
}
