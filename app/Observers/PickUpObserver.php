<?php

namespace App\Observers;

use App\Models\PickUp;
use GenerateNextPickup;
use Illuminate\Support\Facades\Log;

class PickUpObserver
{
    /**
     * Handle the PickUp "created" event.
     */
    public function created(PickUp $pickup): void
    {
        try {
            // Menggunakan dispatch helper function
            dispatch(new GenerateNextPickup($pickup))->delay($pickup->pickup_date);

            // Atau bisa juga menggunakan cara alternatif:
            // GenerateNextPickup::dispatch($pickup)->delay($pickup->pickup_date);

            Log::info('Next pickup schedule generation queued', [
                'pickup_id' => $pickup->id,
                'customer_id' => $pickup->customer_id,
                'current_pickup_date' => $pickup->pickup_date
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to generate next pickup schedule', [
                'pickup_id' => $pickup->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Handle the PickUp "updated" event.
     */
    public function updated(PickUp $pickup): void
    {
        // Log perubahan status
        if ($pickup->wasChanged('pickup_status')) {
            Log::info('Pickup status changed', [
                'pickup_id' => $pickup->id,
                'old_status' => $pickup->getOriginal('pickup_status'),
                'new_status' => $pickup->pickup_status
            ]);
        }
    }

    /**
     * Handle the PickUp "deleted" event.
     */
    public function deleted(PickUp $pickup): void
    {
        Log::info('Pickup deleted', [
            'pickup_id' => $pickup->id,
            'customer_id' => $pickup->customer_id
        ]);
    }

    /**
     * Handle the PickUp "restored" event.
     */
    public function restored(PickUp $pickup): void
    {
        Log::info('Pickup restored', [
            'pickup_id' => $pickup->id,
            'customer_id' => $pickup->customer_id
        ]);
    }

    /**
     * Handle the PickUp "force deleted" event.
     */
    public function forceDeleted(PickUp $pickup): void
    {
        Log::info('Pickup force deleted', [
            'pickup_id' => $pickup->id,
            'customer_id' => $pickup->customer_id
        ]);
    }
}
