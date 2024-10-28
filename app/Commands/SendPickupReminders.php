<?php

use App\Models\PickUp;
use Illuminate\Console\Command;
use App\Notifications\PickupReminder;

class SendPickupReminders extends Command
{
    protected $signature = 'pickups:send-reminders';

    public function handle()
    {
        $oneWeekFromNow = now()->addWeek();

        PickUp::query()
            ->where('pickup_date', $oneWeekFromNow->format('Y-m-d'))
            ->with(['customer', 'customer.city'])
            ->get()
            ->each(function ($pickup) {
                $pickup->customer->notify(new PickupReminder($pickup));
            });
    }
}
