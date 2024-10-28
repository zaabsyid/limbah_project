<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\PickUp;
use App\Models\Customer;
use App\Notifications\PickupReminder;
use PeriodEnum;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Menjalankan pengecekan dan pengiriman notifikasi pickup setiap hari jam 9 pagi
        $schedule->command('pickups:send-reminders')
            ->dailyAt('09:00')
            ->withoutOverlapping()
            ->before(function () {
                Log::info('Starting pickup reminder check');
            })
            ->after(function () {
                Log::info('Finished pickup reminder check');
            })
            ->onFailure(function () {
                Log::error('Failed to send pickup reminders');
            });

        // Backup database setiap hari jam 1 pagi
        $schedule->command('backup:clean')->dailyAt('01:00');
        $schedule->command('backup:run')->dailyAt('01:30');

        // Membersihkan file temporary setiap minggu
        $schedule->command('temp:clean')
            ->weekly()
            ->sundays()
            ->at('00:00');

        // // Generate laporan bulanan pada akhir bulan
        // $schedule->call(function () {
        //     $this->generateMonthlyReport();
        // })->monthlyOn(1, '00:01');

        // // Monitoring status pickup yang telah lewat
        // $schedule->call(function () {
        //     $this->checkOverduePickups();
        // })->hourly();

        // Membersihkan logs yang lebih dari 7 hari
        $schedule->command('logs:clean')
            ->daily()
            ->appendOutputTo(storage_path('logs/scheduler.log'));
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

    /**
     * Function untuk generate laporan bulanan
     */
    // private function generateMonthlyReport(): void
    // {
    //     try {
    //         $currentDate = now();
    //         $previousMonth = $currentDate->copy()->subMonth();

    //         // Menentukan periode berdasarkan bulan
    //         $period = ceil($previousMonth->month / 3);
    //         $periodEnum = PeriodEnum::cases()[$period - 1];

    //         // Generate laporan
    //         $report = app(\App\Services\WasteReportGenerator::class)
    //             ->generatePeriodReport($previousMonth->year, $periodEnum);

    //         // Simpan laporan
    //         $fileName = "waste-report-{$previousMonth->format('Y-m')}.pdf";
    //         $report->save(storage_path("app/reports/$fileName"));

    //         // Kirim notifikasi ke admin
    //         $admins = \App\Models\Admin::all();
    //         foreach ($admins as $admin) {
    //             $admin->notify(new \App\Notifications\MonthlyReportGenerated($fileName));
    //         }

    //         Log::info("Monthly report generated successfully: $fileName");
    //     } catch (\Exception $e) {
    //         Log::error('Failed to generate monthly report: ' . $e->getMessage());
    //     }
    // }

    /**
     * Function untuk check pickup yang sudah lewat
     */
    // private function checkOverduePickups(): void
    // {
    //     try {
    //         $overduePickups = PickUp::query()
    //             ->where('pickup_date', '<', now())
    //             ->where('pickup_status', '!=', 'completed')
    //             ->where('pickup_status', '!=', 'cancelled')
    //             ->get();

    //         foreach ($overduePickups as $pickup) {
    //             // Update status
    //             $pickup->update([
    //                 'pickup_status' => 'overdue',
    //                 'remarks' => 'Automatically marked as overdue by system'
    //             ]);

    //             // Notify relevant parties
    //             $pickup->customer->notify(new \App\Notifications\PickupOverdue($pickup));

    //             // Notify admin
    //             $admins = \App\Models\User::all();
    //             foreach ($admins as $admin) {
    //                 $admin->notify(new \App\Notifications\PickupOverdue($pickup));
    //             }
    //         }

    //         if ($overduePickups->count() > 0) {
    //             Log::info('Overdue pickups processed: ' . $overduePickups->count());
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('Failed to process overdue pickups: ' . $e->getMessage());
    //     }
    // }

    /**
     * Custom error handler untuk scheduled tasks
     */
    protected function handleSchedulingError(\Throwable $e, string $command): void
    {
        Log::error('Scheduling error occurred', [
            'command' => $command,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        // // Notify admin about the error
        // $admins = \App\Models\User::all();
        // foreach ($admins as $admin) {
        //     $admin->notify(new \App\Notifications\SchedulerError($command, $e->getMessage()));
        // }
    }
}
