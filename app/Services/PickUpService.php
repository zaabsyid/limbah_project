<?php

namespace App\Services;

use App\Enums\PeriodEnum;
use Carbon\Carbon;

class PickUpService
{
    public function generateNextPickupDate(Carbon $currentDate): Carbon
    {
        // Determine current and next period
        $currentPeriod = ceil($currentDate->month / 3);
        $nextPeriod = $currentPeriod == 4 ? 1 : $currentPeriod + 1;

        // Get the enum instance for next period
        $periodEnum = match ($nextPeriod) {
            1 => PeriodEnum::PERIOD_1,
            2 => PeriodEnum::PERIOD_2,
            3 => PeriodEnum::PERIOD_3,
            4 => PeriodEnum::PERIOD_4,
        };

        // Get months for next period
        $nextPeriodMonths = PeriodEnum::getMonthRange($periodEnum);

        // Pick random month from next period
        $randomMonth = $nextPeriodMonths[array_rand($nextPeriodMonths)];

        // Create date for next pickup
        $nextPickupDate = Carbon::create(
            $currentPeriod == 4 ? $currentDate->year + 1 : $currentDate->year,
            $randomMonth
        )->startOfMonth();

        // Add random days, but ensure it's within the month
        $maxDays = $nextPickupDate->daysInMonth - 1;
        $randomDays = rand(1, $maxDays);

        return $nextPickupDate->addDays($randomDays);
    }
}
