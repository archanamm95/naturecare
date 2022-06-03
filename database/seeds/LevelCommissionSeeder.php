<?php

use Illuminate\Database\Seeder;

class LevelCommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


         App\LevelCommissionSettings::create([
            'type'=>'fixed',
            'criteria'=>'no',
            'level_1' =>'13',
            'level_2' =>'4',
            'level_3' =>'3',
            'criteria_l1' =>'1600',
            'criteria_l2' =>'3300',
            'criteria_l3' =>'3300',
            'criteria2_l3' =>'10000', 
            
           
            ]);
    }
}
