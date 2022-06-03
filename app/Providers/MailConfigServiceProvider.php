<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Config;
use Schema;
use App\Emailsetting;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // if (!Schema::hasTable('email_setting')) {
        //     $mail = Emailsetting::find(1);
        //     if ($mail) {
        //         $config = array(
        //             'driver'     => 'smtp',
        //             'host'       => $mail->host,
        //             'port'       => $mail->port,
        //             'from'       => array('address' => 'demo@cloudmlmsoftware.com', 'name' => 'Cloud MLM Software Demo'),
        //             'encryption' => 'tls',
        //             'username'   => $mail->username,
        //             'password'   => $mail->password,
        //             'sendmail'   => '/usr/sbin/sendmail -bs',
        //             'pretend'    => false,
        //         );
        //         Config::set('mail', $config);
        //     }
        // }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       
       
    }
}
