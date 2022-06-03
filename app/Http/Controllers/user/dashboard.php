<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\user\UserAdminController;
use App\Http\Controllers;
use Auth;
use App\User;
use App\BinaryCommissionSettings;
use App\Mail;
use App\Payout;
use App\AppSettings;
use App\Tree_Table;
use App\Balance;
use App\Commission;
use App\PointTable;
use App\PurchaseHistory;
use App\Packages;
use App\RsHistory;
use App\Currency;
use App\PendingTransactions;
use App\PendingCommission;
use App\Ranksetting;
use App\Shippingaddress;
use App\Settings;
use App\ProfileInfo;
use App\LevelCommissionSettings;
use Session;
use App\PointHistory;
use App\InfluencerTree;
use Crypt;
use DB;
use Carbon;

class dashboard extends UserAdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() 
    {

        // $knownDate = Carbon::create(2022, 1, 31, 12);
        // Carbon::setTestNow($knownDate);     



        // $date = new DateTime;


        // $date->setDate(2022,1,31); 

        // return date("y m d");



        $title      =  'Dashboard'; 
        $sub_title = trans('dashboard.your-dashboard');

        $auth =Auth::user();
        // dd($auth->id);


/*..........................BOXES.....................................*/    
       $purchase_history    = PurchaseHistory::where(function($query) {
                                $query->where('user_id',Auth::user()->id)
                                ->orWhere('seller_id',Auth::user()->id); 
                                    })
                            ->where('created_at', '>=', date('Y-m-1 00:00:00'))
                            ->where('created_at', '<=', date('Y-m-t 23:59:59'))
                            ->get();
        //mnthly sale box
        $total_sale         = $purchase_history->where('seller_id',$auth->id)
                                ->where('type','Packages')
                                // ->where('created_at', '>=', date('Y-m-1 00:00:00'))
                                // ->where('created_at', '<=', date('Y-m-t 23:59:59'))
                                ->sum('total_amount'); 

        $total_sales_count  = $purchase_history->where('seller_id',$auth->id)
                                ->where('type','Packages')
                                // ->where('created_at', '>=', date('Y-m-1 00:00:00'))
                                // ->where('created_at', '<=', date('Y-m-t 23:59:59'))
                                ->sum('total_amount'); 
        //monthly purchase box                                    
        $total_credit       = $purchase_history->where('user_id',$auth->id)
                                ->where('type','Packages')
                                // ->where('created_at', '>=', date('Y-m-1 00:00:00'))
                                // ->where('created_at', '<=', date('Y-m-t 23:59:59'))
                                ->sum('total_amount'); 
         
        $total_purchase_count=$purchase_history->where('user_id', $auth->id)
                                ->where('type','Packages')
                                // ->where('created_at', '>=', date('Y-m-1 00:00:00'))
                                // ->where('created_at', '<=', date('Y-m-t 23:59:59'))
                                ->sum('total_amount'); 

        // //mnthly cashback box
        $Commission             = Commission::where('user_id', $auth->id)
                               ->whereMonth('created_at',date('m'))
                               ->whereYear('created_at',date('Y'))
                               ->get(); 
                               // dd($Commission);                     
        $cashback            =$Commission->where('payment_type',"cashback_bonus")->sum('total_amount');
    
        //mnthly earning box
         $incom              = $Commission->sum('total_amount');

        //mnthly payout box
         $payout_amount      = Payout::where('user_id',$auth->id)
                                ->where('status','released')
                                ->whereMonth('created_at',date('m'))
                                ->whereYear('created_at',date('Y'))
                                ->sum('amount'); 

        //pending commission box
        $pending_cmsn        = PendingCommission::where('user_id',$auth->id)
                                ->where('payment_status','no')
                                ->sum('total_amount');

        //mnthly groupsale box for NON influencers
        $montly_groupsale    = PointHistory::where('user_id',$auth->id)
                               ->whereMonth('created_at',date('m'))
                               ->whereYear('created_at',date('Y'))
                               ->sum('pv');
                                    
        //mnthly groupsale box for  influencers                              
        $user_type            = $auth->user_type ;

        if($user_type == 'Influencer' || $user_type == 'InfluencerManager')
        {
            
        $downline_users_id    = InfluencerTree::where('sponsor',$auth->id)->pluck('user_id')->toArray();
        $authid               = array($auth->id);
        $mergedArray          = array_merge($authid,$downline_users_id);
        $montly_groupsale     = PurchaseHistory::whereIn('seller_id', $mergedArray)
                                ->where('type','Packages')
                                ->whereMonth('created_at',date('m'))
                                ->whereYear('created_at',date('Y'))
                                ->sum('count');        
                        
        }
       
       //for taking previous 3 mnth data
        // $month1             =date('M', strtotime('-1 month'));
        // $month2             =date('M', strtotime('-2 month'));
        // $month3             =date('M', strtotime('-3 month'));
        $month = [];
        for ($i=1; $i <=3 ; $i++) { 
            $month[] = Carbon::now()->subMonths($i)->format('M');
        }
        // dd($month);
        // $month2             = Carbon::now()->subDays(62)->format('M');
        // $month3             = Carbon::now()->subDays(93)->format('M');


        /*..........................BOXES  END. ....................................*/ 

        /*..........................REFERRAL LINK. ....................................*/ 
      
        $secret             = base64_encode($auth->username);
        $influencer         = base64_encode('influencer');

        /*..........................REFERRAL LINK END. ....................................*/ 

        /*..........................PROGESS BAR. ....................................*/ 

         //target to beDealer_& monthly maintainance

        $tobeDealer_saleCount   =  PurchaseHistory::where('seller_id',$auth->id)
                                          ->where('type','Packages')
                                          ->where('created_at', '>=', date('Y-m-t 00:00:00', strtotime('-3 month')))
                                          ->where('created_at', '<=', date('Y-m-t 23:59:59'))
                                          ->sum('count');
        $settings_data          = Settings::select('memberSale_validity','ProductCountDealer','monthly_count')->first();
        $difference             =Carbon::now()->diffInDays($auth->created_at);
        $remaining_days         = $settings_data->memberSale_validity - $difference; 
        $month_end              = date("Y-m-t H:i:s", strtotime(Carbon::now())); 
        // $monthly_remaining_days = Carbon::now()->diff($month_end);
        $monthly_remaining_days = $month_end;

        /*..........................PROGESS BAR END.....................................*/ 

        /*..........................LEVEL CRITERIA BAR. ....................................*/ 
         $ref_grpsale= $montly_groupsale - $total_sales_count;
         $level_settings_criteria=LevelCommissionSettings::first();
        /*..........................LEVEL CRITERIA END .....................................*/ 
         
      
        return view('app.user.dashboard.index', compact('title','incom','total_credit','sub_title','user_type','remaining_days','settings_data','monthly_remaining_days','tobeDealer_saleCount','secret','total_sale','total_sales_count','total_purchase_count','pending_cmsn','payout_amount','montly_groupsale','influencer','month','cashback','ref_grpsale','level_settings_criteria'));

    }



    public function getmonthusers()
    {
        $downline_users = array();
        Tree_Table::getDownlines(1, true, Auth::user()->id, $downline_users);
        $users = Tree_Table::getDown();
        print_r($users);
    }

    public function getUsersJoiningJson(Request $request)
    {

        $today = Carbon\Carbon::today();
        // $table->whereBetween('date', [$today->startOfMonth(), $today->endOfMonth])->count();
         // this week results
        $fromDate = Carbon\Carbon::now()->subDay()->startOfWeek()->toDateString(); // or ->format(..)
        $tillDate = Carbon\Carbon::now()->subDay()->toDateString();


        $duration = strtotime('-365 days');

        if (isset($request->period)) {
            if ($request->period === 'today') {
                $users = DB::table('sponsortree')
                ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d-%H") as date'), DB::raw('count(*) as value'))
                // ->whereBetween( DB::raw('created_at'), [$fromDate, $tillDate] )
                ->whereDate('created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 days')))
                ->where('sponsor',Auth::user()->id)
                ->orderBy('date', 'asc')
                ->where('id', '>', '1')
                ->groupBy('date')
                // ->take(15)
                ->get();
        
                return response()->json($users);
            } elseif ($request->period === 'week') {
               // this week results
              // $fromDate = Carbon\Carbon::now()->subDay()->startOfWeek()->toDateString(); // or ->format(..)
              // $tillDate = Carbon\Carbon::now()->subDay()->toDateString();
                $duration = strtotime('-7 days');
            } elseif ($request->period === 'month') {
              // this week results
              // $fromDate = Carbon\Carbon::now()->subDay()->startOfMonth()->toDateString(); // or ->format(..)
              // $tillDate = Carbon\Carbon::now()->subDay()->toDateString();
                $duration = strtotime('-1 months');
            } elseif ($request->period === 'year') {
              // this week results
              // $fromDate = Carbon\Carbon::now()->subDay()->startOfYear()->toDateString(); // or ->format(..)
              // $tillDate = Carbon\Carbon::now()->subDay()->toDateString();
                $duration = strtotime('-1 years');
            }

        }
      

        $users = DB::table('sponsortree')
          ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as value'))
          // ->whereBetween( DB::raw('DATE(created_at)'), [$fromDate, $tillDate] )
          ->whereDate('created_at', '>=', date('Y-m-d H:i:s', $duration))
          ->orderBy('date', 'asc')
          ->groupBy('date')
           ->where('sponsor',Auth::user()->id)
          // ->take(15)
          ->get();
          return response()->json($users);

       
    }
         public function getUsers_mnthJson(Request $request)
    {
        
        $today = Carbon\Carbon::today();
        // $table->whereBetween('date', [$today->startOfMonth(), $today->endOfMonth])->count();
         // this week results
        $fromDate = Carbon\Carbon::now()->subDay()->startOfWeek()->toDateString(); // or ->format(..)
        $tillDate = Carbon\Carbon::now()->subDay()->toDateString();
        $duration = strtotime('-365 days');

        if (isset($request->period)) {
            
            if ($request->period === '1') {
                // dd(11);
               // this week results
              // $fromDate = Carbon\Carbon::now()->subDay()->startOfWeek()->toDateString(); // or ->format(..)
              // $tillDate = Carbon\Carbon::now()->subDay()->toDateString();
                $duration = date('m',strtotime('-1 months'));
                // dd($duration);
            } elseif ($request->period === '2') {
              // this week results
              // $fromDate = Carbon\Carbon::now()->subDay()->startOfMonth()->toDateString(); // or ->format(..)
              // $tillDate = Carbon\Carbon::now()->subDay()->toDateString();
                $duration = date('m',strtotime('-2 months'));
            } elseif ($request->period === '3') {
              // this week results
              // $fromDate = Carbon\Carbon::now()->subDay()->startOfYear()->toDateString(); // or ->format(..)
              // $tillDate = Carbon\Carbon::now()->subDay()->toDateString();
                $duration = date('m',strtotime('-3 months'));
            }
        }
      
      
        $total_sale_amount = DB::table('purchase_history')->where('seller_id',Auth::user()->id)
                                              ->where('type','Packages')
                                              ->where('created_at', '>', date('Y-'.$duration.'-1 00:00:00'))
                                              ->where('created_at', '<', date('Y-'.$duration.'-t 23:59:59'))
                                              ->sum('total_amount');
         $sale_count = DB::table('purchase_history')->where('seller_id',Auth::user()->id)
                                              ->where('type','Packages')
                                              ->where('created_at', '>', date('Y-'.$duration.'-1 00:00:00'))
                                              ->where('created_at', '<', date('Y-'.$duration.'-t 23:59:59'))
                                              ->sum('count');
          $total_pur_amount = DB::table('purchase_history')->where('user_id',Auth::user()->id)
                                              ->where('type','Packages')
                                              ->where('created_at', '>', date('Y-'.$duration.'-1 00:00:00'))
                                              ->where('created_at', '<', date('Y-'.$duration.'-t 23:59:59'))
                                              ->sum('total_amount');
         $pur_count = DB::table('purchase_history')->where('user_id',Auth::user()->id)
                                              ->where('type','Packages')
                                              ->where('created_at', '>', date('Y-'.$duration.'-1 00:00:00'))
                                              ->where('created_at', '<', date('Y-'.$duration.'-t 23:59:59'))
                                              ->sum('count');
          $incom      = Commission::where('user_id', Auth::user()->id)
                                ->where('created_at', '>', date('Y-'.$duration.'-1 00:00:00'))
                                ->where('created_at', '<', date('Y-'.$duration.'-t 23:59:59'))
                                ->sum('total_amount');
       
                                     
          $payout = Payout::where('user_id',Auth::user()->id)
                               ->where('status','released')
                               ->where('created_at', '>', date('Y-'.$duration.'-1 00:00:00'))
                               ->where('created_at', '<', date('Y-'.$duration.'-t 23:59:59'))
                               ->sum('amount');
          $user_type=Auth::user()->user_type;                      
            if($user_type == 'Influencer' || $user_type == 'InfluencerManager')
        {
            
            $downline_users=InfluencerTree::where('sponsor',Auth::user()->id)->pluck('id');
            $downline_montly_groupsale=PurchaseHistory::whereIn('seller_id', $downline_users)
                    ->where('type','Packages')
                    ->where('pay_by','!=','register_point')
                    ->where('status','released')
                    ->where('created_at', '>', date('Y-'.$duration.'-1 00:00:00'))
                    ->where('created_at', '<', date('Y-'.$duration.'-t 23:59:59'))
                    ->sum('total_amount');
            $sales_count=PurchaseHistory::where('seller_id', Auth::user()->id)
                                         ->where('status','released')
                                         ->where('created_at', '>', date('Y-'.$duration.'-1 00:00:00'))
                                         ->where('created_at', '<', date('Y-'.$duration.'-t 23:59:59'))
                                         ->where('type','Packages')->sum('count');
                    // dd($sales_count);
            $groupsale=$downline_montly_groupsale+$sales_count;          
                    
        }
       else
       {
        
        $groupsale=PointHistory::where('user_id',Auth::user()->id)
                                       ->where('created_at', '>', date('Y-'.$duration.'-1 00:00:00'))
                                       ->where('created_at', '<', date('Y-'.$duration.'-t 23:59:59'))
                                       ->sum('pv');
       }
                            
        $cashback=PendingCommission::where('user_id',Auth::user()->id)
                                    ->where('created_at', '>', date('Y-'.$duration.'-1 00:00:00'))
                                    ->where('created_at', '<', date('Y-'.$duration.'-t 23:59:59'))
                                    ->where('payment_type',"cashback_bonus")
                                    ->sum('total_amount');
                                        
                                        
          
          return response()->json(['sale_count'=>$sale_count,'total_sale_amount'=>$total_sale_amount,'pur_count'=>$pur_count,'total_pur_amount'=>$total_pur_amount,'incom'=>$incom,'payout'=>$payout,'groupsale'=>$groupsale,'cashback'=>$cashback]);                                     
                                              
          
    }    


        public function getUsers_salesJson(Request $request)
    {
        
        $today = Carbon\Carbon::today();
        // $table->whereBetween('date', [$today->startOfMonth(), $today->endOfMonth])->count();
         // this week results
        $fromDate = Carbon\Carbon::now()->subDay()->startOfWeek()->toDateString(); // or ->format(..)
        $tillDate = Carbon\Carbon::now()->subDay()->toDateString();
        $duration = strtotime('-365 days');

        if (isset($request->period)) {
            if ($request->period === 'today') {
                $users = DB::table('purchase_history')
                ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d-%H") as date'), DB::raw('count(*) as value'))
                // ->whereBetween( DB::raw('created_at'), [$fromDate, $tillDate] )
                ->whereDate('created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 days')))
                ->where('seller_id',Auth::user()->id)
                ->orderBy('date', 'asc')
                ->groupBy('date')
                // ->take(15)
                ->get();
        
                return response()->json($users);
            } elseif ($request->period === 'week') {
               // this week results
              // $fromDate = Carbon\Carbon::now()->subDay()->startOfWeek()->toDateString(); // or ->format(..)
              // $tillDate = Carbon\Carbon::now()->subDay()->toDateString();
                $duration = strtotime('-7 days');
            } elseif ($request->period === 'month') {
              // this week results
              // $fromDate = Carbon\Carbon::now()->subDay()->startOfMonth()->toDateString(); // or ->format(..)
              // $tillDate = Carbon\Carbon::now()->subDay()->toDateString();
                $duration = strtotime('-1 months');
            } elseif ($request->period === 'year') {
              // this week results
              // $fromDate = Carbon\Carbon::now()->subDay()->startOfYear()->toDateString(); // or ->format(..)
              // $tillDate = Carbon\Carbon::now()->subDay()->toDateString();
                $duration = strtotime('-1 years');
            }
            
        }
      

        $users = DB::table('purchase_history')
          ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(count) as value'))
          // ->whereBetween( DB::raw('DATE(created_at)'), [$fromDate, $tillDate] )
          ->whereDate('created_at', '>=', date('Y-m-d H:i:s', $duration))
          ->orderBy('date', 'asc')
          ->groupBy('date')
           ->where('seller_id',Auth::user()->id)
          // ->take(15)
          ->get();

          // dd($users);
          return response()->json($users);

       
    }
    //    public function getUsers_mnth_salesJson(Request $request)
    // {
    //     // dd(11);
    //     $today = Carbon\Carbon::today();
    //     // $table->whereBetween('date', [$today->startOfMonth(), $today->endOfMonth])->count();
    //      // this week results
    //     $fromDate = Carbon\Carbon::now()->subDay()->startOfWeek()->toDateString(); // or ->format(..)
    //     $tillDate = Carbon\Carbon::now()->subDay()->toDateString();
    //     $duration = strtotime('-365 days');

    //     if (isset($request->period)) {
            
    //         if ($request->period === '1') {
    //             // dd(11);
    //            // this week results
    //           // $fromDate = Carbon\Carbon::now()->subDay()->startOfWeek()->toDateString(); // or ->format(..)
    //           // $tillDate = Carbon\Carbon::now()->subDay()->toDateString();
    //             $duration = date('m',strtotime('-1 months'));
    //             // dd($duration);
    //         } elseif ($request->period === '2') {
    //           // this week results
    //           // $fromDate = Carbon\Carbon::now()->subDay()->startOfMonth()->toDateString(); // or ->format(..)
    //           // $tillDate = Carbon\Carbon::now()->subDay()->toDateString();
    //             $duration = date('m',strtotime('-2 months'));
    //         } elseif ($request->period === '3') {
    //           // this week results
    //           // $fromDate = Carbon\Carbon::now()->subDay()->startOfYear()->toDateString(); // or ->format(..)
    //           // $tillDate = Carbon\Carbon::now()->subDay()->toDateString();
    //             $duration = date('m',strtotime('-3 months'));
    //         }
    //     }
      

    //     $total_amount = DB::table('purchase_history')->where('seller_id',Auth::user()->id)
    //                                           ->where('type','Packages')
    //                                           ->where('created_at', '>', date('Y-'.$duration.'-1 00:00:00'))
    //                                           ->where('created_at', '<', date('Y-'.$duration.'-t 23:59:59'))
    //                                           ->sum('total_amount');
    //      $count = DB::table('purchase_history')->where('seller_id',Auth::user()->id)
    //                                           ->where('type','Packages')
    //                                           ->where('created_at', '>', date('Y-'.$duration.'-1 00:00:00'))
    //                                           ->where('created_at', '<', date('Y-'.$duration.'-t 23:59:59'))
    //                                           ->sum('count');
                                              
    //       // dd($count,$total_amount);
    //       return response()->json(['count'=>$count,'total'=>$total_amount]);

       
    // }
   
    // public function getUsers_pur_purJson(Request $request)
    // {
    //     // dd(11);
    //     $today = Carbon\Carbon::today();
    //     // $table->whereBetween('date', [$today->startOfMonth(), $today->endOfMonth])->count();
    //      // this week results
    //     $fromDate = Carbon\Carbon::now()->subDay()->startOfWeek()->toDateString(); // or ->format(..)
    //     $tillDate = Carbon\Carbon::now()->subDay()->toDateString();
    //     $duration = strtotime('-365 days');

    //     if (isset($request->period)) {
            
    //         if ($request->period === '1') {
    //             // dd(11);
    //            // this week results
    //           // $fromDate = Carbon\Carbon::now()->subDay()->startOfWeek()->toDateString(); // or ->format(..)
    //           // $tillDate = Carbon\Carbon::now()->subDay()->toDateString();
    //             $duration = date('m',strtotime('-1 months'));
    //             // dd($duration);
    //         } elseif ($request->period === '2') {
    //           // this week results
    //           // $fromDate = Carbon\Carbon::now()->subDay()->startOfMonth()->toDateString(); // or ->format(..)
    //           // $tillDate = Carbon\Carbon::now()->subDay()->toDateString();
    //             $duration = date('m',strtotime('-2 months'));
    //             // dd($duration);
    //         } elseif ($request->period === '3') {
    //           // this week results
    //           // $fromDate = Carbon\Carbon::now()->subDay()->startOfYear()->toDateString(); // or ->format(..)
    //           // $tillDate = Carbon\Carbon::now()->subDay()->toDateString();
    //             $duration = date('m',strtotime('-3 months'));
    //         }
    //     }
      

    //     $total_amount = DB::table('purchase_history')->where('user_id',Auth::user()->id)
    //                                           ->where('type','Packages')
    //                                           ->where('created_at', '>', date('Y-'.$duration.'-1 00:00:00'))
    //                                           ->where('created_at', '<', date('Y-'.$duration.'-t 23:59:59'))
    //                                           ->sum('total_amount');
    //      $count = DB::table('purchase_history')->where('user_id',Auth::user()->id)
    //                                           ->where('type','Packages')
    //                                           ->where('created_at', '>', date('Y-'.$duration.'-1 00:00:00'))
    //                                           ->where('created_at', '<', date('Y-'.$duration.'-t 23:59:59'))
    //                                           ->sum('count');
                                              
    //       // dd($count,$total_amount);
    //       return response()->json(['count'=>$count,'total'=>$total_amount]);

       
    // }
    //  public function getUsers_income_purJson(Request $request)
    // {
    //     if (isset($request->period)) {
            
    //         if ($request->period === '1') {              
    //             $duration = date('m',strtotime('-1 months'));
    //             // dd($duration);
    //         } elseif ($request->period === '2') {
    //             $duration = date('m',strtotime('-2 months'));
    //             // dd($duration);
    //         } elseif ($request->period === '3') {
    //             $duration = date('m',strtotime('-3 months'));
    //         }
    //     }
      
    //     $incom      = Commission::where('user_id', Auth::user()->id)
    //                             ->where('created_at', '>', date('Y-'.$duration.'-1 00:00:00'))
    //                             ->where('created_at', '<', date('Y-'.$duration.'-t 23:59:59'))
    //                             ->sum('total_amount');
       
                                              
    //       // dd($count,$total_amount);
    //       return response()->json(['incom'=>$incom]);

       
    // }
    //  public function getUsers_payout_purJson(Request $request)
    // {
    //     if (isset($request->period)) {
            
    //         if ($request->period === '1') {              
    //             $duration = date('m',strtotime('-1 months'));
    //             // dd($duration);
    //         } elseif ($request->period === '2') {
    //             $duration = date('m',strtotime('-2 months'));
    //             // dd($duration);
    //         } elseif ($request->period === '3') {
    //             $duration = date('m',strtotime('-3 months'));
    //         }
    //     }
        
    //     $payout = Payout::where('user_id',Auth::user()->id)
    //                            ->where('status','released')
    //                            ->where('created_at', '>', date('Y-'.$duration.'-1 00:00:00'))
    //                            ->where('created_at', '<', date('Y-'.$duration.'-t 23:59:59'))
    //                            ->sum('amount');
    //     // dd($payout);
    //     return response()->json(['payout'=>$payout]);
       
    // }
    // public function getUsers_grp_sale_purJson(Request $request)
    // {
    //     $user_type=Auth::user()->user_type;
    //     if (isset($request->period)) {
            
    //         if ($request->period === '1') {              
    //             $duration = date('m',strtotime('-1 months'));
    //             // dd($duration);
    //         } elseif ($request->period === '2') {
    //             $duration = date('m',strtotime('-2 months'));
    //             // dd($duration);
    //         } elseif ($request->period === '3') {
    //             $duration = date('m',strtotime('-3 months'));
    //         }
    //     }
        
    //     if($user_type == 'Influencer' || $user_type == 'InfluencerManager')
    //     {
            
    //         $downline_users=InfluencerTree::where('sponsor',Auth::user()->id)->pluck('id');
    //         $downline_montly_groupsale=PurchaseHistory::whereIn('seller_id', $downline_users)
    //                 ->where('type','Packages')
    //                 ->where('pay_by','!=','register_point')
    //                 ->where('status','released')
    //                 ->where('created_at', '>', date('Y-'.$duration.'-1 00:00:00'))
    //                 ->where('created_at', '<', date('Y-'.$duration.'-t 23:59:59'))
    //                 ->sum('count');
    //         $sales_count=PurchaseHistory::where('seller_id', Auth::user()->id)
    //                                      ->where('status','released')
    //                                      ->where('created_at', '>', date('Y-'.$duration.'-1 00:00:00'))
    //                                      ->where('created_at', '<', date('Y-'.$duration.'-t 23:59:59'))
    //                                      ->where('type','Packages')->sum('count');
    //                 // dd($sales_count);
    //         $groupsale=$downline_montly_groupsale+$sales_count;          
                    
    //     }
    //    else
    //    {
        
    //     $groupsale=PointHistory::where('user_id',Auth::user()->id)
    //                                    ->where('created_at', '>', date('Y-'.$duration.'-1 00:00:00'))
    //                                    ->where('created_at', '<', date('Y-'.$duration.'-t 23:59:59'))
    //                                    ->sum('pv');
    //    }
    //     // dd($payout);
    //     return response()->json(['groupsale'=>$groupsale]);
       
    // }
    
    // public function getUsers_cashback_purJson(Request $request)
    // {
    //     if (isset($request->period)) {
            
    //         if ($request->period === '1') {              
    //             $duration = date('m',strtotime('-1 months'));
    //             // dd($duration);
    //         } elseif ($request->period === '2') {
    //             $duration = date('m',strtotime('-2 months'));
    //             // dd($duration);
    //         } elseif ($request->period === '3') {
    //             $duration = date('m',strtotime('-3 months'));
    //         }
    //     }
        
    //     $cashback=PendingCommission::where('user_id',Auth::user()->id)
    //                                 ->where('created_at', '>', date('Y-'.$duration.'-1 00:00:00'))
    //                                 ->where('created_at', '<', date('Y-'.$duration.'-t 23:59:59'))
    //                                 ->where('payment_type',"cashback_bonus")
    //                                 ->sum('total_amount');
    //                                  // dd($cashback);
        
    //     return response()->json(['cashback'=>$cashback]);
       
    // }
    public function bitaps(Request $request, $paymentid)
    {
        $item = PendingTransactions::where('id', $paymentid)->first();

        
        if (is_null($item)) {
            return response()->json(['valid' => false]);
        } elseif ($item->payment_status == 'finish') {
            $user_id=User::where('username', $item->username)->value('id');
            if ($user_id <> null) {
                return response()->json(['valid' => true,'status'=>$item->payment_status,'id'=>Crypt::encrypt($user_id)]);
            }
        } else {
            return response()->json(['valid' => true,'status'=>$item->payment_status,'id'=>null]);
        }
        
        return response()->json(['valid' => false]);
    }


    public function storebitaps(Request $request, $paymentid)
    {
        $item = PendingTransactions::where('id', $paymentid)->first();

        
        if (is_null($item)) {
            return response()->json(['valid' => false]);
        } elseif ($item->payment_status == 'finish') {
            $id = shippingaddress::where('user_id', $item->user_id)->max('id');
            return response()->json(['valid' => true,'status'=>$item->payment_status,'id'=>Crypt::encrypt($id)]);
        } else {
            return response()->json(['valid' => true,'status'=>$item->payment_status,'id'=>null]);
        }
        
        return response()->json(['valid' => false]);
    }

    public function bitapspreview(Request $request, $transid)
    {

        $title="Bitaps Preview";
        $base="Bitaps Preview";
        $method="Bitaps Preview";
        $sub_title="Bitaps Preview";

        return view('app.user.register.bitapspreview', compact('title', 'base', 'method', 'sub_title'));
    }
}
