<?php

use Illuminate\Database\Seeder;

class settingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \App\Settings::create([
            'monthly_count'        => 4,
            'point_value'        => '100',
            'pair_value'        => '10',
            'pair_amount'   => 100,
            'tds'   => '0',
            'service_charge'   =>500,
            'sponsor_Commisions'   => 100,
            'joinfee' => '70',
            'voucher_daily_limit' => '1000',
            'memberSale_validity' => 90,
            'ProductCountDealer' => 2400,
            'content' => 'Welcome to Terms and Conditions',
            'cookie' => 'Welcome to cookie Policy',
            'bonus_1'   => 35,
            'bonus_2'   => 65,
            'member_condition'   => 2400,
            'dealer_condition'   => 2400,
            'share_partner_condition'   => 10000,
            'influencer_manager'   => 30,
            'influencer_level'   => 10,
            'min_p_sales'   => 800,
            'p_sales_per'   => 22,
         ]);
    }
}
