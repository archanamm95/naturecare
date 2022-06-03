<?php

namespace App\Console\Commands;
use App\PointTable;
use App\CashbackSettings;
use App\Sponsortree;
use App\PendingCommission;
use App\PurchaseHistory;
use DB;
use Illuminate\Console\Command;
use App\ErrorLog;

class New_monthly_Cashback extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new:cashback';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {

        $users  = PointTable::where('user_id','>',1)
                    // ->where('seller_id','>',1)
                    // ->whereMonth('created_at',date('m'))
                    // ->whereYear('created_at',date('Y'))
                    ->groupBy('user_id')
                    ->select(DB::raw('sum(pv) as amount'),'user_id')
                    ->get();
        $cashback_settings = CashbackSettings::select('id','sale_amount','cash_back')->get();
        $min_cash_limit = $cashback_settings->min('sale_amount');

        // calculate each user's personal cashback 
        foreach ($users as $key => $value){ 
            if($value->amount >= $min_cash_limit){
                $value = $cashback_settings->where('sale_amount','<=',$value->amount)->max('id');
                $per_cashback[$value->user_id]=($value->amount*$times->cash_back)/100; 
            }  
         }  
        // calculate each user's total cashback (personal cashback - sum  of referrals's personal cashback )
        foreach ($users as $key => $value){ 

        DB::beginTransaction();
        try {

            if($value->amount >= $min_cash_limit){
                $referrals=Sponsortree::where('sponsor',$value->user_id)->where('type','yes')
                            ->pluck('user_id');
                $ref_cashback=0;
                // calculate sum of referrals's personal cashback  
                foreach ($referrals as $key => $ref){  
                    if (array_key_exists($ref,$per_cashback)){
                    $ref_cashback=$ref_cashback+$per_cashback[$ref];}
                }
                $total_cashback=$per_cashback[$value->user_id]-$ref_cashback;
      
                if($total_cashback > 0)
                {
                    PendingCommission::create([
                       'user_id'        => $value->user_id,
                       'from_id'        => 1,
                       'total_amount'   => $total_cashback,
                       'tds'            => $per_cashback[$value->user_id],
                       'service_charge' => $ref_cashback,
                       'payable_amount' => $total_cashback,
                       'payment_type'   => 'cashback_bonus',
                        //payment_status will be "no" by default
                    ]);
                }
            }
        DB::commit();

        } 
        catch (Exception $e) {
            DB::rollback();
            $error1 = $e->getMessage();
            $line_number = $e->getLine();
            $error = ErrorLog::create([
                'from' =>"monthly_cashback",
                'error'       => $error1,
                'line_number' => $line_number
            ]);
        }
        }
    }
}
