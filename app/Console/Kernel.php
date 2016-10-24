<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
        Commands\InstagramGetFollowersCommand::class,
        Commands\InstFirstAuthCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command('inspire')
                  ->hourly();

        $schedule->command('inst:auth')
            ->everyMinute()
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs/auth_new_accounts.log'));
    }
}
