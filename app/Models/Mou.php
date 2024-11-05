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
