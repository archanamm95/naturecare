<?php

use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // App\Packages::create([
        //   'package'=>'Free',
        //   'amount'=>'0',
        //   'pv'=>'0',
        //   'product_count'=>'0',
        //   'rs'=>'0',
        //   'code'=>'0',
        //   'daily_limit'=>'0',
        //   'special'=>'no',
        //   'top_count'=>'0',
        //   'ref_top_count'=>'0',
        //   'image'=>'logo-3b57d.png',
        // ]);        
        App\Packages::create([
          'package'=>'Basic',
          'amount'=>'300',
          'pv'=>'200',
          'product_count'=>'2',
          'rs'=>'600',
          'code'=>'5',
          'daily_limit'=>'5000',
          'special'=>'no',
          'top_count'=>'0.5',
          'ref_top_count'=>'0.25',
          'image'=>'logo-3b57d.png',
        ]);
        App\Packages::create([
          'package'=>'Advance',
          'amount'=>'600',
          'pv'=>'3000',
          'product_count'=>'3',
          'rs'=>'1200',
          'code'=>'10',
          'daily_limit'=>'10000',
          'special'=>'no',
          'top_count'=>'1',
          'ref_top_count'=>'0.5',
          'image'=>'logo-3b57d.png',
        ]);
        App\Packages::create([
            'package'=>'Premium',
          'amount'=>'1200',
          'pv'=>'6000',
          'product_count'=>'2',
          'rs'=>'2400',
          'code'=>'20',
          'daily_limit'=>'15000',
          'special'=>'no',
          'top_count'=>'2',
            'ref_top_count'=>'1',
          'image'=>'logo-3b57d.png',
        ]);
    }
}
