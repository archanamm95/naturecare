<?php

use Illuminate\Database\Seeder;

class MatchingbonusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\MatchingBonus::create([
            'type'=>'fixed',
            'criteria'=>'no',
            'matching_level1' =>6,
            'matching_level2' =>5,
            'matching_level3' =>4,
            ]);
    }
}
