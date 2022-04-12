<?php

namespace App\Console;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function () {
            // \App\Models\MoU::where('waktuSelesai', '<', \Carbon\Carbon::now()->format('Y-m-d'))->delete();
            DB::table('data_mou')->where('tgl_selesai', '<', \Carbon\Carbon::now()->format('Y-m-d'))->update(['status' => 'Expired']);
            // DB::table('mo_u_s')->where('waktuSelesai', '<', Carbon::now())->delete();
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
