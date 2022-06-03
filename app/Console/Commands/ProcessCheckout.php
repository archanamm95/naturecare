<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\PendingTransactions;
use App\User;
use App\Packages;
use App\PurchaseHistory;
use App\PointTable;
use App\PointHistory;
use App\Commission;
use App\LevelCommissionSettings;
use App\Sponsortree;
use App\ErrorLog;
use App\Settings;
use DB;
class ProcessCheckout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:checkout {--payment_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'pending requests for checkout';

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
        $id = $this->option('payment_id');
        $pending_payments=PendingTransactions::where('payment_type', '!=', 'store_purchase')
        ->where('payment_status', 'complete')
        ->where('id',$id)->get();

        foreach ($pending_payments as $key => $payment) {

        DB::beginTransaction();
        try {

            $data=json_decode($payment->request_data, true);
            $pending_id = $payment->id;
            $user_id = User::where('email','=', $data['email'])
                            ->select('id','username','user_type','sponsor_id')->first();

            if(isset($user_id)){
                $seller_id=User::where('username',$data['purchase'])->select('id','status')->first();
      
                foreach($data['product'] as $products) {

                    if ($products['type'] == 'Product')
                        $pckg_count = 0;
                    else
                        $pckg_count = $data['package_count'];

                    $data['tracking_id']=isset($data['tracking_id']) ? $data['tracking_id'] : 'not_found';
                    $data['courier_service'] = isset($data['courier_service']) ? $data['courier_service'] : 'not_found';

                    $pur = PurchaseHistory::create([
                        'user_id'             => $user_id->id,
                        'purchase_user_id'    => $user_id->id,
                        'package_id'          => 1,
                        'package_purchase_id' => 1,
                        'order_status'        => $data['order_id'],
                        'product_name'        => $products['name'],
                        'seller_id'           => $seller_id->id,
                        'bv'                  => $pckg_count,
                        'total_bv'            => $data['package_count'],
                        'count'               => $products['quantity'],
                        'total_amount'        => $products['total_price'],
                        'invoice_id'          => $data['order_id'],
                        'pay_by'              => 'COD',
                        'purchase_type'       => 'purchase',
                        'sales_status'        => "yes",
                        'payment_date'        => $data['payment_date'],
                        'shipping_country'    => $data['shipping_country'],
                        'type'                => $products['type'],
                        'tracking_id'         => $data['tracking_id'],
                        'courier_service'     => $data['courier_service'],
                    ]);

                }

                if ($user_id->user_type == "Customer") {

                    $crnt_mnth_sale = PurchaseHistory::where('user_id',$user_id->id)
                    ->sum('total_amount');//seller_id ??

                    if ($crnt_mnth_sale > 400) {  // 2 sales => 800(4 sets =800)/2 
                        
                        $sponsor_id = $user_id->sponsor_id;
                        Sponsortree::where('user_id',$sponsor_id)->increment('member_count',1);
                      
                        $sponsortreeid = Sponsortree::where('sponsor', $sponsor_id)->where('type', 'vaccant')->orderBy('id', 'desc')->take(1)->value('id');
                      
                        $sponsortree          = Sponsortree::find($sponsortreeid);
                        $sponsortree->user_id = $user_id->id;
                        $sponsortree->sponsor = $sponsor_id;
                        $sponsortree->type    = "yes";
                        $sponsortree->save();

                        $sponsorvaccant = Sponsortree::createVaccant($sponsor_id, $sponsortree->position);
                         
                        $uservaccant = Sponsortree::createVaccant($user_id->id, 0);                
                    }
                }

                PointTable::where('user_id',$seller_id->id)->increment('pv',$data['total_price']);       
                PointHistory::addPointHistoryTable($seller_id->id,$seller_id->id, $data['total_price'], 'L','purchase');
                PointTable::updatePoint($data['total_price'],$seller_id->id);

                // User::lastmonthSales($seller_id); //commented by archana


                // if ($data['package_count'] > 0) { //commented by archana starts

                    // Commission::salesBonus($seller_id->id,$user_id->id,$data['package_count']);
                
                    // $lev_settings = LevelCommissionSettings::first();

                    // if ($seller_id->id > 1) {
                        
                    //     $seller_sponsor = Sponsortree::where('user_id',$seller_id->id)->value('sponsor');

                    //     Commission::levelBonus($seller_id->id,$seller_sponsor,$data['package_count'],$lev_settings);
                    // }

                // } 
                //upgrade user type(member/dealer/share partner)
                // Commission::userstatuUpgrade($seller_id->id,$user_id->id,$data['registration_type'],$data['package_count'],$data['user_type']);
                //commented by archana ends 

                //added by archana starts 
                $lev_settings = LevelCommissionSettings::first();
                $settings_data = Settings::find(1);
                $value_array = [
                    'seller' =>$seller_id->id,
                    'user_id'=>$user_id->id,
                    'registration_type'=>$data['registration_type'],
                    'amount'=>$data['total_price'],
                    'user_type'=>$data['user_type'],
                    'settings'=>$settings_data
                ];
                if ($data['total_price'] > 0 && $seller_id->id > 1) {
                    Commission::levelBonusNew($seller_id->id,$user_id->id,$lev_settings);
                    Commission::userstatuUpgradeNew($value_array);
                }
                //added by archana ends            
            }

        DB::commit();
        } 
        catch (Exception $e) {
            DB::rollback();
            $error1 = $e->getMessage();
            $line_number = $e->getLine();
            $error = ErrorLog::create([
                'from' =>"proces_checkout",
                'error'       => $error1,
                'line_number' => $line_number
            ]);
            }
        }
    }
}
