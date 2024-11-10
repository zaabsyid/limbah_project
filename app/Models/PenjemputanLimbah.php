<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenjemputanLimbah extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'penjemputan_limbahs';

    protected $fillable = [
        'limbah_id',
        'code_manifest',
        'document_manifest',
        'weight_limbah',
        'pickup',
        'date_pickup',
        'created_at',
        'deleted_at'
    ];

    public function limbah()
    {
        return $this->belongsTo(Limbah::class);
    }

    protected static function booted()
    {
        static::saving(function ($penjemputanLimbah) {
            // Cek apakah code_manifest, document_manifest, weight_limbah ada dan pickup status 'belum_dijemput'
            if (
                !empty($penjemputanLimbah->code_manifest) &&
                !empty($penjemputanLimbah->document_manifest) &&
                !empty($penjemputanLimbah->weight_limbah) &&
                $penjemputanLimbah->pickup === 'belum_dijemput'
            ) {
                $penjemputanLimbah->pickup = 'siap_dijemput';
            }
        });
    }
}
