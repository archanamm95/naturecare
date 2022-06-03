<?php

use Illuminate\Database\Seeder;

class EmailSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('email_setting')->insert([
             
              'username' => 'df7a36be62e323',
              'password' => 'fd582df97201c2',
              'host' => 'smtp.mailtrap.io',
              'port' => '587',
              'from_name' => 'cloudmlmsoftware',
              'from_email' => 'athira@bpract.com',

               ]);
    }
}
