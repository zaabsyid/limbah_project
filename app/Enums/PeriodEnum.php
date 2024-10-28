<?php

namespace App\Enums;

use Carbon\Carbon;

enum PeriodEnum: string
{
    case PERIOD_1 = 'Januari-Maret';
    case PERIOD_2 = 'April-Juni';
    case PERIOD_3 = 'Juli-September';
    case PERIOD_4 = 'Oktober-Desember';

    public static function getMonthRange(self $period): array
    {
        return match ($period) {
            self::PERIOD_1 => [1, 2, 3],
            self::PERIOD_2 => [4, 5, 6],
            self::PERIOD_3 => [7, 8, 9],
            self::PERIOD_4 => [10, 11, 12],
        };
    }

    // Helper method untuk mendapatkan periode dari bulan
    public static function fromMonth(int $month): self
    {
        return match (ceil($month / 3)) {
            1 => self::PERIOD_1,
            2 => self::PERIOD_2,
            3 => self::PERIOD_3,
            4 => self::PERIOD_4,
            default => throw new \InvalidArgumentException('Invalid month')
        };
    }

    // Method untuk mendapatkan nama periode
    public function getName(): string
    {
        return $this->value;
    }

    // Method untuk mendapatkan range bulan dalam format string
    public function getMonthRangeText(): string
    {
        $months = $this->getMonthRange($this);
        $firstMonth = Carbon::create(null, $months[0], 1)->format('F');
        $lastMonth = Carbon::create(null, $months[2], 1)->format('F');
        return "{$firstMonth} - {$lastMonth}";
    }
}
