<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriLimbah extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori_limbahs';

    protected $fillable = [
        'code',
        'name',
    ];

    public function limbahs()
    {
        return $this->hasMany(Limbah::class, 'id_category');
    }
}
