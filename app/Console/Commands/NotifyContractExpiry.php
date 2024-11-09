<?php

namespace App\Console\Commands;

use App\Models\Mou;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContractRenewalNotification;

class NotifyContractExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:contract-expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification email for contracts nearing expiration';

    /**
     * Execute the console command.
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Mendapatkan tanggal 1 bulan dari sekarang
        $oneMonthFromNow = Carbon::now()->addMonth();

        // Ambil MOU dengan periode kontrak 2 tahun yang mendekati tanggal akhir kontrak
        $expiringMous = Mou::where('contract_period', '2')
            ->whereDate('contract_end_date', '<=', $oneMonthFromNow)
            ->get();

        foreach ($expiringMous as $mou) {
            // Kirim email notifikasi
            Mail::to('abdulrosyid2002@gmail.com')->send(new ContractRenewalNotification($mou));
            // Mail::to($mou->customer->email)->send(new ContractRenewalNotification($mou)); //kirim notifikasi ke customer
            $this->info('Notification sent for MOU: ' . $mou->mou_number);
        }

        return 0;
    }
}
