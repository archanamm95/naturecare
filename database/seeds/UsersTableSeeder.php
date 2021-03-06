<?php

use Illuminate\Database\Seeder;
use \App\ProfileInfo;

class UsersTableSeeder extends Seeder
{

    public function run()
    {

        $user = \App\User::create([
            'name'       => 'John',
            'lastname'   => 'Doe',
            'username'   => 'NatureCare',
            'email'      => 'admin@bpract.com',
            'rank_id'    => '1',
            'password'   => bcrypt('#1MLMsoftwareX'),
            'confirmed'  => 1,
            'admin'      => 1,
            'confirmation_code' => md5(microtime() . env('APP_KEY')),
            'transaction_pass' => '123456',
            'user_type' => 'Admin',
        ]);
    }
}
