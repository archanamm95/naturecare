<?php

use Illuminate\Database\Seeder;

class CashbacksettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\CashbackSettings::create([
            'sale_count'=>50000,
            'cash_back'=>9,
            ]);
        App\CashbackSettings::create([
            'sale_count'=>35000,
            'cash_back'=>8.5,
            ]);
        App\CashbackSettings::create([
            'sale_count'=>20000,
            'cash_back'=>8,
            ]);
        App\CashbackSettings::create([
            'sale_count'=>10000,
            'cash_back'=>7.5,
            ]);
        App\CashbackSettings::create([
            'sale_count'=>8000,
            'cash_back'=>7,
            ]);
        App\CashbackSettings::create([
            'sale_count'=>6400,
            'cash_back'=>6.5,
            ]);
        App\CashbackSettings::create([
            'sale_count'=>3200,
            'cash_back'=>6,
            ]);
        App\CashbackSettings::create([
            'sale_count'=>1600,
            'cash_back'=>5.5,
            ]);
        App\CashbackSettings::create([
            'sale_count'=>800,
            'cash_back'=>5,
            ]);
        App\CashbackSettings::create([
            'sale_count'=>600,
            'cash_back'=>4.5,
            ]);
        App\CashbackSettings::create([
            'sale_count'=>200,
            'cash_back'=>4,
            ]);
        App\CashbackSettings::create([
            'sale_count'=>100,
            'cash_back'=>3.5,
            ]);

    }
}
