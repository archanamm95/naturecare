<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\PendingCommission;
use App\Commission;
use App\PurchaseHistory;
use App\Balance;
use App\Payout;
use App\User;

class MonthlyBonusUpdation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:bonus_approve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'approve bonus for qualified usrs from pending';

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

        //this crone should run at firs day of next month after cash back
        $startDate = date('Y-m-01 00:00:00',strtotime('-0 month'));
        $endDated = date('Y-m-t 23:59:59',strtotime('-0 month'));

        $pending_cmsns = PendingCommission::where('payment_status','no')
                        ->where('created_at','>=',$startDate)
                        ->where('created_at','<=',$endDated)
                        ->where('user_id','>',1)
                        ->get();
        $users=[];
        $commission_id=[];
        $rejected_usr=[];
        $min_cash_limit = Settings::first()->min_p_sales;

    try {

        foreach ($pending_cmsns as $key => $value) {

            $crnt_mnth_sale = PurchaseHistory::where('seller_id',$value->user_id)
            ->where('type','Packages')
            ->where('created_at','>=',$startDate)
            ->where('created_at','<=',$endDated)
            // ->sum('count');
            ->sum('total_amount');

            $users[$value->user_id]['amount'] = (isset($users[$value->user_id]['amount']))  ? ($users[$value->user_id]['amount']+$value->total_amount) : $value->total_amount; 
            $users[$value->user_id]['commission'] = (isset($users[$value->user_id]['commission']))  ? ($users[$value->user_id]['commission'].','.$value->payment_type) : $value->payment_type;

            if ($crnt_mnth_sale >= $min_cash_limit ) { 

                $users[$value->user_id]['status']='pending';

                $commission=Commission::create([
                    'user_id'=>$value->user_id,
                    'from_id'=>$value->from_id,
                    'total_amount'=>$value->total_amount,
                    'tds'=>$value->tds,
                    'service_charge'=>0,
                    'payable_amount'=>$value->payable_amount,
                    'payment_type'=>$value->payment_type,
                    ]);

                // $commission_id[]=$commission->id;

                // Balance::where('user_id', $value->user_id)->increment('balance', $value->total_amount);

                PendingCommission::where('id',$value->id)->update(['payment_status'=>'yes']);
            }
            else{
                PendingCommission::where('id',$value->id)->update(['payment_status'=>'rejected']);
                $users[$value->user_id]['status']='rejected';
               
            }

        }
        //automatic payout request from users , admin can reject or release 
        foreach($users as $key => $value){
            Payout::create([
                    'user_id'        => $key,
                    'amount'         => $value['amount'],
                    'payment_mode'   => 1,//'Mnaual/Bank'
                    // 'commission_id'  => implode(',',$commission_id),
                    'commission_id'  => $value['commission'],
                    'status'         => $value['status'],
                ]);

        }

        Log::debug("MonthlyBonusUpdation Cron Completed");

        } catch (Exception $e) {
            Log::error("Line Number:-".$e->getLine()." Message:-".$e->getMessage());
        }

        //after fund transfer all users setting to satus inactive  
        User::where('id','>',1)->update(['status' => 'inactive']);

    }
}
