<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       App\Product::create([
            'name'			=> 'Miracle Essence',
            'sku'           => '108-1069',
            'description'   => 'Miracle Essence',
            'category_id'   =>  248,
            'quantity'      =>  25,
            'price'			=>  208,
            'bv'			=>  120,
            'image'         =>  'product1.png'

           
         ]);


          App\Product::create([
            'name'          =>'24k Golden Sleeping Mask
            ',
            'sku'           =>'108-1069',
            'description'   =>'24k Golden Sleeping Mask
            ',
            'category_id'   => 248,
            'quantity'      => 25,
            'price'         => 208,
            'bv'            => 120,
            'image'         =>'product2.png'


  
         ]);




    }
}
