<?php

use App\Models\PickUp;
use Illuminate\Support\Str;
use App\Services\PickUpService;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateNextPickup implements ShouldQueue
{
    public function __construct(public PickUp $currentPickup) {}

    public function handle(PickUpService $scheduler)
    {
        PickUp::create([
            'customer_id' => $this->currentPickup->customer_id,
            'pickup_date' => $scheduler->generateNextPickupDate($this->currentPickup->pickup_date),
            'pickup_code' => 'PU-' . Str::random(8),
            'pickup_status' => 'scheduled'
        ]);
    }
}
