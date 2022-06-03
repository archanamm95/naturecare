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
use App\ErrorLog;
use Mail;
use DB;
class AccountStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:account_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking user type status ';

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
        //for member case when this function is going to call should be checked

        $users = User::where('id','>',1)->where('status','active')->get();
        $interval = date('Y-m-01 00:00:00', strtotime("-3 month"));
          
        foreach ($users as $user) 
        { 

        DB::beginTransaction();
        try {

            $user_id=$user->id;
            if ($user->user_type == 'Member') 
            {
            // IF NO PURCHASE FOR LAST 1 YEAR 
              if(date('Y-m-d') == date('Y-01-01'))
              {
            
                $purchase_count = PurchaseHistory::where('seller_id','=',$user_id)
                        ->where('type','Packages')
                        ->whereYear('created_at', '=', date('Y',strtotime("-0 year")))
                        // ->sum('count');
                        ->sum('total_amount');
                        // dd($purchase_count);

                if ($purchase_count == 0) {

                    $new_sponsor = Sponsortree::where('user_id',$user_id)->value('sponsor');
                    Commission::changeSponsor($user_id,$new_sponsor);

                    User::where('id',$user_id)->update(['status' => 'inactive']);
                    // Sponsortree::where('user_id',$user_id)->delete();
                    }
                }   
  
            }
            if ($user->user_type == 'Dealer') //should run quarterly
            {
            // if there is no sales for 3 month , dealer become member and referals should be move under  sponsor.
            // in active dealer position can be same position . do not use 90 days , need to check month. 

                $sold_count = PurchaseHistory::where('seller_id','=',$user_id)
                        ->where('type','Packages')
                        ->where('created_at','>=',$interval)
                        // ->sum('count');
                        ->sum('total_amount');

                if ($sold_count == 0) 
                {

                    $new_sponsor = Sponsortree::where('user_id',$user_id)->value('sponsor');
                    Commission::changeSponsor($user_id,$new_sponsor);

                    User::where('id',$user_id)->update(['user_type' => 'Member']);
                    Sponsortree::where('user_id',$user_id)->delete();
                }
            }
            elseif ($user->user_type == 'SharePartner') 
            {

                $referals = Sponsortree::whereIn('sponsor',$old_sponsor)->pluck('user_id');

                $purchase_count = PurchaseHistory::where('seller_id','=',$user_id)
                        ->where('created_at','>=',$interval)
                        ->count();
                $referrals_purchase_count = PurchaseHistory::whereIn('seller_id','=',$referals)
                        ->where('created_at','>=',$interval)
                        ->count();

                if ($sold_count <= 40 || $referrals_purchase_count <= 150)
                 {

                    $new_sponsor = Sponsortree::where('user_id',$user_id)->value('sponsor');
                    Commission::changeSponsor($user_id,$new_sponsor);

                    User::where('id',$user_id)->update(['user_type' => 'Dealer']);
                    Sponsortree::where('user_id',$user_id)->delete();


                 }
               
            }   
                                  
            DB::commit();
        } 
        catch (Exception $e) {
            DB::rollback();
            $error1 = $e->getMessage();
            $line_number = $e->getLine();
            $error = ErrorLog::create([
                'from' =>"account_status",
                'error'       => $error1,
                'line_number' => $line_number
            ]);
        }
        
        }

    }
}
