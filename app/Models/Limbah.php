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
        'code_manifest',
        'document_manifest',
        'weight_limbah',
        'pickup_1',
        'pickup_2',
        'pickup_3',
        'pickup_4',
        'driver_id',
        'province_id',
        'city_id',
        'created_at',
        'deleted_at'
    ];

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
