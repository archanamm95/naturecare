<?php

use Illuminate\Database\Seeder;

class Payoutmanagemt extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        App\Payoutmanagemt::create([
            'payment_mode'=>'Manual/Bank',
            'status'=>'1',
            ]);
        App\Payoutmanagemt::create([
            'payment_mode'=>'Hyperwallet',
            'status'=>'0',
            ]);
        App\Payoutmanagemt::create([
            'payment_mode'=>'Paypal',
            'status'=>'0',
            ]);
        App\Payoutmanagemt::create([
            'payment_mode'=>'Bitaps',
            'status'=>'0',
            ]);
    }
}
