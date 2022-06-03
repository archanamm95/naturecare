<?php

use Illuminate\Database\Seeder;

class PaymenttypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\PaymentType::create([
          'payment_name'=>'Cheque',
          'code'=>'cheque',
          'status' =>'no',
        ]);
        App\PaymentType::create([
          'payment_name'=>'Paypal',
          'code'=>'paypal',
        ]);
        App\PaymentType::create([
          'payment_name'=>'Bitaps',
          'code'=>'bitaps',
        ]);
        App\PaymentType::create([
          'payment_name'=>'Stripe',
          'code'=>'stripe',
        ]);
        App\PaymentType::create([
          'payment_name'=>'Bankwire',
          'code'=>'bankwire',
          'status' =>'yes',
        ]);App\PaymentType::create([
          'payment_name'=>'Register Point',
          'code'=>'register_point',
          'status' =>'yes',
        ]);

        App\PaymentType::create([
          'payment_name'=>'Ewallet',
          'code'=>'ewallet',
          'status' =>'yes',
        ]);
        App\PaymentType::create([
          'payment_name'=>'Ipaygh',
          'code'=>'ipaygh',
        ]);

      // App\PaymentType::create([
      //     'payment_name'=>'Authorize',
      //     'code'=>'authorize',
      // ]);
        App\PaymentType::create([
          'payment_name'=>'senangPay',
          'code'=>'senangpay',
          'status' =>'yes',
       ]);
        App\PaymentType::create([
          'payment_name'=>'Skrill',
          'code'=>'skrill',
        ]);

        App\PaymentType::create([
          'payment_name'=>'Rave',
          'code'=>'rave',
        ]);
        App\PaymentType::create([
          'payment_name'=>'Voucher',
          'code'=>'voucher',
        ]);
    }
}
