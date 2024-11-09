<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MouRenewal extends Model
{
    protected $fillable = [
        'perpanjangan_mou_id',
        'year',
        'status',
        'due_date',
        'document_payment',
    ];

    /**
     * Relasi dengan model PerpanjanganMou
     */
    public function perpanjanganMou()
    {
        return $this->belongsTo(PerpanjanganMou::class, 'perpanjangan_mou_id');
    }

    /**
     * Tandai sebagai sudah dibayar dan simpan dokumen pembayaran
     *
     * @param string $paymentDocument Path atau nama file dari dokumen pembayaran
     */
    public function markAsPaid($paymentDocument)
    {
        $this->update([
            'status' => 'green',
            'document_payment' => $paymentDocument,
        ]);
    }

    protected static function booted()
    {
        static::saving(function ($mouRenewal) {
            // Cek apakah code, document manifest, weight limbah diunggah dan status pickup belum_dijemput
            if ($mouRenewal->document_payment && $mouRenewal->status === 'belum_dibayar') {
                $mouRenewal->status = 'sudah_dibayar';
            }
        });
    }

    /**
     * Cek jika renewal mendekati jatuh tempo dan belum dibayar, lalu kirim notifikasi
     */
    public function checkAndSendDueNotification()
    {
        if ($this->status == 'orange' && $this->due_date <= now()->addDays(7)) {
            // Logika pengiriman email notifikasi ke admin jika jatuh tempo (misalnya menggunakan Laravel Mail)
            // Mail::to('admin@example.com')->send(new MouRenewalDueNotification($this));

            $this->perpanjanganMou->update(['notified' => true]); // Tandai sebagai notifikasi telah dikirim
        }
    }
}
