<?php

use Illuminate\Database\Seeder;

class SponsorCommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          App\SponsorCommission::create([
            'type'=>'fixed',
            'criteria'=>'no',
            'sponsor_commission' =>'100',
           
            ]);
    }
}
