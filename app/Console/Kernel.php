<?php

namespace App\Console;

use App\Models\Waktu_Absen;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $waktu = Waktu_Absen::first();
        $schedule->command('app:insert-absen')->daily();
        $schedule->command('app:cek-tap')->at($waktu->batas_pulang);
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
