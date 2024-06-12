<?php

namespace App\Jobs;

use App\Models\Pemesanan;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckExpiredOrders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Ambil semua pemesanan yang belum kadaluarsa dan waktu_expired telah terlewati
        $orders = Pemesanan::where('status', '!=', 'Kadaluarsa')
            ->where('waktu_expired', '<', Carbon::now())
            ->get();

        foreach ($orders as $order) {
            // Ubah status menjadi 'Kadaluarsa'
            $order->status = 'Kadaluarsa';
            $order->save();
        }
    }
}
