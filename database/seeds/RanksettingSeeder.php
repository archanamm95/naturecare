<?php

use Illuminate\Database\Seeder;

class RanksettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Ranksetting::create([
            'rank_name'          => "Member",
            'rank_code'          => "MT",
            'top_up'   => 0,
            'quali_rank_id'   => 0,
            'quali_rank_count'   => 0,
            'rank_bonus'   => "NA",
            'pool_share'   => 0,
        ]);
        \App\Ranksetting::create([
            'rank_name'          => "Dealer",
            'rank_code'          => "DT",
            'top_up'   => 0,
            'quali_rank_id'   => 100,
            'quali_rank_count'   => 100,
            'left_puser_count'   => 1,
            'right_puser_count'  => 1,
            'rank_bonus'   => "NA",
            'pool_share'   => 1,
        ]);
        \App\Ranksetting::create([
            'rank_name'          => "Share Partner",
            'rank_code'          => "SPT",
            'top_up'   => 0,
            'quali_rank_id'   => 500,
            'quali_rank_count'   => 500,
            'left_puser_count'   => 1,
            'right_puser_count'  => 1,
            'rank_bonus'   => "NA",
            'pool_share'   => 2,
        ]);
     
        
    }
}
