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
        'customer_name',
        'customer_nik',
        'customer_address',
        'customer_occupation',
        'customer_ktp_image',
        'customer_npwp_image',
        'customer_sip_str_image',
        'customer_image_1',
        'customer_image_2',
        'customer_materai_1',
        'customer_materai_2',
        'mou_status',
        'province_id',
        'city_id',
        'contract_period',
        'contract_end_date',
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
