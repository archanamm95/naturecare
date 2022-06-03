<?php

use Illuminate\Database\Seeder;

class Levelsettingseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         App\LevelSettingsTable::create([
            'package'=>1,
            'commission_level1'=>12,
            'commission_level2'=>12,
            'commission_level3'=>14,
            'matching_level1'=>12,
            'matching_level2' =>12,
            'matching_level3'=>12,
            'sponsor_comm' => 8,
         
            ]);
          App\LevelSettingsTable::create([
            'package'=>2,
            'commission_level1'=>5,
            'commission_level2'=>8,
            'commission_level3'=>9,
            'matching_level1'=>5,
            'matching_level2' =>8,
            'matching_level3'=>9,
            'sponsor_comm' => 5,
            ]);
           App\LevelSettingsTable::create([
            'package'=>3,
            'commission_level1'=>15,
            'commission_level2'=>8,
            'commission_level3'=>19,
            'matching_level1'=>15,
            'matching_level2' =>8,
            'matching_level3'=>19,
            'sponsor_comm' => 3,
            ]);
    }
}
