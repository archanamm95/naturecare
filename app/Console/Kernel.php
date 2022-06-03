<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Artisan;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    
    protected $commands = [
        'App\Console\Commands\ProcessPayment',
         'App\Console\Commands\ProcessCheckout',
        'App\Console\Commands\AccountStatus',
        'App\Console\Commands\MonthlyBonusUpdation',
        'App\Console\Commands\New_monthly_Cashback',
        'App\Console\Commands\ProcessInfluencer', 
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected function schedule(Schedule $schedule)
    {

        $schedule->command('process:bonus_approve')->everyMinute();
        $schedule->command('new:cashback')->monthlyOn(date('t'), '23:50');
       

        


    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
