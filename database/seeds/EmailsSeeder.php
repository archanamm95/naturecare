<?php

use Illuminate\Database\Seeder;

class EmailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Emails::create([
            'from_email' => 'athira@bpract.com',
            'from_name' => 'Nature Care',
            'subject' => 'Welcome to Nature care',
            'type' => 'register',
            'content' => "<p> Nature care is a distribution system.Our products are totally trustable and prepared with natural ingredients.</p> ",

     
            ]);
    }
}
