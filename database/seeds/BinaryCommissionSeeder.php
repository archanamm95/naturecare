<?php

use Illuminate\Database\Seeder;

class BinaryCommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\BinaryCommissionSettings::create([
            'period'=>'instant',
            'type'=>'fixed',
            'pair_value' => 10,
            'pack_3' =>"1500",
            'pack_4' =>"3000",
            'binary_cap'=>'yes',
            'pack_2' =>100,
            'monthly_maintenance' =>100,
         
            ]);
    }
}
