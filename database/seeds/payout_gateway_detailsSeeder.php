<?php

use Illuminate\Database\Seeder;

class payout_gateway_detailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\payout_gateway_details::create([
            'paypal_clientId' =>'BTcuzchngHtJKidoMRjilksgujnkDDfyhllllFRBHJIgklnkkm',
            'paypal_secret'   =>'2df85gfhn81n97vg414vgg46g4j564gh5k4xdh4df4hgf64j',
            'wallet_id'       =>'BTcuzchngHtJKidoMRjilksgujnkDDfyhllllFRBHJIgklnkkm',
            'wallet_hashId'   =>'2df85gfhn81n97vg414vgg46g4j564gh5k4xdh4df4hgf64j',
            'username'        =>'restapiuser@18157461619',
            'program_token'   =>'prg-c2853bc6-1596-4bfc-a2cc-d2b9709c3f62',
            'password'        => '645fc30d-83ed-476c-a4',
        
            ]);
    }
}
