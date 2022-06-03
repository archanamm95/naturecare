<?php

use Illuminate\Database\Seeder;

class TreeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Tree_Table::create([
           'sponsor'        => '0',
           'user_id'        => '1',
           'placement_id'   => 0,
           'leg'   => "L",
           'type'   => 'yes',
           'position'   => 1,
           'level'   => 0
        ]);
       \App\Tree_Table::create([
            'sponsor'        => 1,            
            'user_id'        => '0',
            'placement_id'   => 1,
            'leg'   => 'L',
            'type'   => 'vaccant',
            'position'   => 2,
            'level'   => 1
        ]); 
         \App\Tree_Table::create([
            'sponsor'        => 1,
            'user_id'        => '0',
            'placement_id'   => 1,
            'leg'   => 'R',
            'type'   => 'vaccant',
            'position'   => 3,
            'level'   => 1
        ]); 
        //   \App\Tree_Table::create([
        //     'sponsor'        => 1,
        //     'user_id'        => '0',
        //     'placement_id'   => 1,
        //     'leg'   => '3',
        //     'type'   => 'vaccant'
        // ]); 
    }
}
