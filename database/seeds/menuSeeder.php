<?php

use Illuminate\Database\Seeder;

class menuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         

         App\Menus::create([
            'group_id'=>1,
            'name'=>'Menu item',
            'description'=>null,
            'icon_class'=>null,
            'icon_image_url'=>null,
            'parent_id'=>null,
            'route'=>'/admin',
            'order'=>'0',
         ]);
    }
}
