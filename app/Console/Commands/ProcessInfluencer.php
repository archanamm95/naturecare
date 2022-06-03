<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\PendingTransactions;
use App\User;
use App\Activity;

class ProcessInfluencer extends Command
{
    protected $signature = 'process:influencer {--payment_id=}';

    protected $description = 'register a influencer';

    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $id = $this->option('payment_id');
        $payment=PendingTransactions::find($id);
        $data=json_decode($payment->request_data, true);
           
        // coming from ocInfluencerRegister function
        if ($payment->payment_type == 'register' ){
           $sponsor_id = User::where('username',$data['sponsor'])->value('id');
           $userresult = User::influenceradd($data,$sponsor_id);
           $sponsorname = $payment->sponsor;
           $username = User::find($userresult->id)->username;
           Activity::add("Added user $username as Influencer", "Added $username sponsor as $sponsorname ", $sponsor_id);

           Activity::add("Joined $username as Influencer ", "Joined in system as $username sponsor as $sponsorname  ", $userresult->id);

           PendingTransactions::where('id', $payment->id)->update(['payment_status' => 'finish']);
       
        }

        // coming from ocInfluencerCheckout function    
        if ($payment->payment_type == 'checkout' ){

            $pending_id = $payment->id;
            $user_id = User::where('email','=', $data['email'])->select('id','username','user_type','sponsor_id')->first();
            if(isset($user_id)){
            $userresult = User::influencercheckout($data,$user_id);
            }
        }
       
    }
}
