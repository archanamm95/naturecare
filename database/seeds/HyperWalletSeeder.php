<?php

use Illuminate\Database\Seeder;

class HyperWalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         App\HyperWallets::create([

        'username'=>'restapiuser@18157461619',
        'program_token'=>'prg-c2853bc6-1596-4bfc-a2cc-d2b9709c3f62',
        'password' => '645fc30d-83ed-476c-a4',
        

         ]);
    }
}
