<?php

use Illuminate\Database\Seeder;

class PaymentNotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\PaymentNotification::create([
          'subject'=>'Payment_notification',
          'mail_content'=>'Payment_notification',
          
        ]);
    }
}
