<?php

use Illuminate\Database\Seeder;

class PaymentGatewayDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         App\PaymentGatewayDetails::create([
          'bank_details'=>'test',
          'btc_address'=>'1GwyMojNcB6yoChGy8KeAyEXfDLKxVQg1G',
          'auth_merchant_name'=>'',
          'auth_transaction_key'=>'',
          'rave_public_key'=>'FLWPUBK-10e43bf17697669bd521513ddb3ce0cf-X',
          'rave_secret_key'=>'FLWSECK-cc674f43ae1475f7bdc273111e2c69d9-X',
          'paypal_username'=>'sales_api1.cloudmlmsoftware.com',
          'paypal_password'=>'K7HABQ6QFHQH5MRK',
          'paypal_secret_key'=>'AFcWxV21C7fd0v3bYYYRCpSSRl31AM6ZCBnJRQbX6PW0jDTSmkQKt7uX',
          'stripe_secret_key'=>'sk_test_DbEAD9WmC66vDmMDKgcsZWCI',
          'stripe_public_key'=>'pk_test_d92o36FguM2feGQh11HTsq5X',
          'ipaygh_merchant_key'=>'tk_131a23b6-9992-11e9-aef6-f23c9170642f',
          'skrill_mer_email'=>'demoqco@sun-fish.com',

          
         ]);
    }
}
