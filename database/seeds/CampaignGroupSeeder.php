<?php

use Illuminate\Database\Seeder;

class CampaignGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\CampaignGroup::create([
            'name'=>'default',
            'description'=>'default',
         
            ]);
    }
}
