<?php

use Illuminate\Database\Seeder;
use App\SharePartner;

class SharePartner_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\SharePartner::create([
          'Products'=>'Product_A',
          'Quantity'=>'10',
        
        ]);
          App\SharePartner::create([
          'Products'=>'Product_B',
          'Quantity'=>'10',
        
        ]);
            App\SharePartner::create([
          'Products'=>'Product_C',
          'Quantity'=>'10',
        
        ]);
              App\SharePartner::create([
          'Products'=>'Product_D',
          'Quantity'=>'10',
        
        ]);
    }
}
