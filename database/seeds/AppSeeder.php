<?php

use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         App\AppSettings::create([
           'company_name' => 'Nature Care',
           'company_address' => '<p>Nature Care, No 2,Medan Sunway Wellesley, Pusat Perniagaan Sunway Wellesley ,
               14000 Bukit Mertajam,<br>Pulau Pinang.</p>',
           'email_address' => 'naturecaremalaysia@gmail.com',
           'logo' => 'logofinalfull.png',
           'logo_ico' => 'logofinalfull.png',
           'theme' => 'default',
          ]);
    }
}
