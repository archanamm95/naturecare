<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\PendingTransactions;
use App\Packages;
use App\User;
use App\Activity;
use App\Package;
use App\PurchaseHistory;
use App\RsHistory;
use App\Balance;
use App\Tree_Table;
use App\Commission;
use App\PointTable;
use App\LeadershipBonus;
use App\ProfileModel;
use App\Sponsortree;
use App\Jobs\SendEmail;
use App\Emails;
use App\AppSettings;
use App\Welcome;
use App\LevelCommissionSettings;
use App\SponsorCommission;
use App\Product;
use Mail;

class ProcessPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:payment {--payment_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'pending requests';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed$
     */
    public function handle()
    {
        $id = $this->option('payment_id');

        $pending_payments=PendingTransactions::where('payment_type', '!=', 'store_purchase')
        ->where('payment_status', 'complete')
        ->where('id',$id)->get();

        foreach ($pending_payments as $key => $payment) {

            $data=json_decode($payment->request_data, true);
            $pending_id = $payment->id;

            if ($payment->payment_type == 'register' ) {

                $reg_type = $data['reg_type'];
                $sponsor_name = User::checkUserAvailable($data['sponsor']);
                $sponsor_id = User::where('username',$sponsor_name)->value('id');
                $user_id=User::where('username', $payment->username)->value('id');
                $user_email=User::where('email', $payment->email)->value('id');

                if ($sponsor_id != null  && $user_id == null && $user_email == null) {

                    $userresult = User::add($data,$sponsor_id,$pending_id,$reg_type);
                    $sponsorname = $payment->sponsor;
                    $username = User::find($userresult->id)->username;

                    Activity::add("Added user $username", "Added $username sponsor as $sponsorname ", $sponsor_id);
                    Activity::add("Joined as $username", "Joined in system as $username sponsor as $sponsorname  ", $userresult->id);
                    PendingTransactions::where('id', $payment->id)->update(['payment_status' => 'finish']);
                }
            }

            
            if ($payment->payment_type == 'dummy_reg') {
                $sponsor_id = User::checkUserAvailable($data['sponsor']);
                $placement_id = User::checkUserAvailable($data['placement_user']);
                $user_id=User::where('username', $payment->username)->value('id');
                $user_email=User::where('email', $payment->email)->value('id');
                $user_password = User::where('password', $payment->password)->value('id');

                if ($sponsor_id <> null && $placement_id <> null && $user_id == null && $user_email == null) {
                    $userresult = User::dummy_add($data,$sponsor_id,$placement_id);
                    if ($userresult) {
                        $userPackage = Packages::find($data['package']);
                        $sponsorname = $payment->sponsor;
                        $placement_username = $data['placement_user'];
                        $legname = $data['leg'] == "L" ? "Left" : "Right";
                        $username = User::find($userresult->id)->username;
                        Activity::add("Added user $username", "Added $username sponsor as $sponsorname and placement user as $placement_username ", $sponsor_id);
                        Activity::add("Joined as $username", "Joined in system as $username sponsor as $sponsorname and placement user as $placement_username ", $userresult->id);
    
                        PendingTransactions::where('id', $payment->id)->update(['payment_status' => 'finish']);
                    }
                }
            }

            if ($payment->payment_type == 'plan_upgrade') {
                $currentPack = Packages::find(ProfileModel::where('user_id',$payment->user_id)->value('package'));
                $planresult = User::planpurchase($data,$payment->user_id);
                if($planresult){
                    $userPackage = Packages::find($data['package']);
                    PendingTransactions::where('id', $payment->id)->update(['payment_status' => 'finish']);
                }
            } 
            if ($payment->payment_type == 'shop_purchase') {
                $sponsor_id = User::checkUserAvailable($payment->sponsor);
                $shopresult = User::shoppurchase($data,$payment->user_id,$sponsor_id);
                $count      = $data['quantity'];
                if($shopresult){
                    foreach ($data['quantity'] as $key => $value) {
                    $product=Product::where('id',$key)->value('name');
                    $count=$value;
                    Activity::add("Product purchased", "Purchased $count $product", $payment->user_id);
                       
                    }
                    PendingTransactions::where('id', $payment->id)->update(['payment_status' => 'finish']);
                }
            }
        }
    }
}
