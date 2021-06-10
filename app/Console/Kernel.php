<?php

namespace App\Console;

use App\Console\Commands\SendNotification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        SendNotification::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) {

//        $schedule->command('command:reset-daily-tasks')->daily();
//        $schedule->command('command:delete-old-events')->daily();
//        $schedule->command('command:delete-old-tasks')->daily();
//        $schedule->command('command:check-tasks')->daily()->at('14:00');
        $schedule->command('send:notification')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands() {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
