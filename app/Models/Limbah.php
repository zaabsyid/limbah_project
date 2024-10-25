<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Limbah extends Model
{
    protected $fillable = ['city', 'status', 'pickup_date', 'weight_kg', 'manifest_code', 'team_name'];

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
