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
        'id_category',
        'code',
        'name',
        'price',
        'unit',
        'province_id',
        'city_id'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriLimbah::class, 'id_category');
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isPickedUp()
    {
        return $this->status === 'picked_up';
    }

    public function isTerminated()
    {
        return $this->status === 'terminated';
    }
}
