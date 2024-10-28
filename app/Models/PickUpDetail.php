<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PickUpDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'phone',
    ];

    // Relasi dengan PickUp
    public function pickUps()
    {
        return $this->hasMany(PickUp::class);
    }
}
