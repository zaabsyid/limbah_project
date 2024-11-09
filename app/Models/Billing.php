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

    protected static function booted()
    {
        static::saving(function ($billing) {
            // Cek apakah document_payment diunggah dan status belum diperpanjang
            if ($billing->document_payment && $billing->status === 'belum_diperpanjang') {
                $billing->status = 'sudah_perpanjang';
            }
        });
    }
}
