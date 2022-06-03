<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use DB;
use Auth;
use Validator;
use App\EwalletModel;
use App\RegisterPoint;
use App\User;
use App\Mail;
use App\Commission;
use App\Sponsortree;
use App\PurchaseHistory;
use App\Payout;
use App\Balance;
use App\ProfileInfo;
use App\BinaryCommissionSettings;
use App\PointHistory;
use App\InfluencerTree;

use Carbon;
use DataTables;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\user\UserAdminController;

class Ewallet extends UserAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        
         $title     = trans('ewallet.ewallet');
        $sub_title = trans('ewallet.ewallet');
        $base      = trans('ewallet.ewallet');
        $method    = trans('ewallet.ewallet');

        if (!session('wallet_type')) {
            Session::put('wallet_type', 'All');
        }
        $balance = Balance::where('user_id',Auth::user()->id)->value('balance');
        

        $user_type            = Auth::user()->user_type ;

        if($user_type == 'Influencer' || $user_type == 'InfluencerManager')
        {
            
        
        $result = [];
        $commission = ['influencermanager_bonus','influencer_level1_bonus'];
        
         foreach ($commission as $key => $value) {

             $result[$value] = Commission::where('payment_type','LIKE',$value.'%')->where('user_id',Auth::user()->id)
                                ->sum('total_amount');

         }

        $downline_users_id    = InfluencerTree::where('sponsor',Auth::user()->id)->where('type',"yes")->pluck('user_id')->toArray();
        // dd($downline_users_id);
        $authid               = array(Auth::user()->id);
        $mergedArray          = array_merge($authid,$downline_users_id);
        // dd($mergedArray);
        $montly_groupsale     = PurchaseHistory::whereIn('seller_id', $mergedArray)
                                ->where('type','Packages')
                                // ->whereMonth('created_at',date('m'))
                                // ->whereYear('created_at',date('Y'))
                                ->sum('total_amount');        
         return view('app.user.ewallet.wallet', compact('title', 'sub_title', 'base', 'balance','result','montly_groupsale','user_type'));               
        }
        else
        {
        $commission = ['level','leadership_bonus','sales_bonus','referral_bonus'];
 
 
        $payment = [];
        $bonus_count = [];
        $result = [];

        foreach ($commission as $key => $value) {

           
            $payments = Commission::where('payment_type','LIKE',$value.'%')->where('user_id',Auth::user()->id)
                            ->select(DB::raw('SUM(total_amount) as total_amount'),DB::raw('count(total_amount) as count'))
                        ->get();
                        // dd($payments);
             $payment[$value]=  $payments[0]['total_amount']; 
             $bonus_count[$value] = $payments[0]['count'];
            
            }
     
            // dd($referal_bonus_count);        
        $referal_count= Sponsortree::where('sponsor', Auth::user()->id)
                ->join('users', 'users.id','sponsortree.user_id')
                ->where('sponsortree.type', '!=', 'vaccant')
                ->where('users.is_usedto_leader','=',0)
                ->count('sponsortree.id');

        $remain_referrals= $referal_count % 10;
        $countof_dealership_bonus =floor($referal_count/10);
     // dd($referal_count);
   
        $montly_groupsale    = PointHistory::where('user_id',Auth::user()->id)
                               // ->whereMonth('created_at',date('m'))
                               // ->whereYear('created_at',date('Y'))
                               ->sum('pv');
                                    
         
          $cashback =Commission::where('user_id',Auth::user()->id)
                              ->whereMonth('created_at',date('m'))
                              ->whereYear('created_at',date('Y'))
                              ->where('payment_type',"cashback_bonus")
                              ->sum('total_amount');                           
    
        return view('app.user.ewallet.wallet', compact('title', 'sub_title', 'base', 'balance','payment','referal_count','bonus_count','remain_referrals','countof_dealership_bonus','montly_groupsale','user_type','cashback'));
        }
    }

    
    public function data(Request $request)
    {

        $amount = 0;
        $users1 = array();
        $users2 = array();
        //echo $user_id;die();
       $users1 = Commission::select('commission.id', 'user.username', 'fromuser.username as fromuser', 'commission.payment_type', 'commission.payable_amount', 'commission.created_at', 'commission.updated_at') 
            ->join('users as fromuser', 'fromuser.id', '=', 'commission.from_id')
            ->join('users as user', 'user.id', '=', 'commission.user_id')
            ->join('profile_infos as profile', 'profile.user_id', '=', 'commission.from_id')
            // ->join('packages as pack', 'pack.id','profile.package')
            ->where('commission.user_id', '=', Auth::user()->id)
            ->orderBy('commission.id', 'desc');
       
        $users2 = Payout::select('payout_request.id', 'users.username', 'users.username as fromuser', 'payout_request.status as payment_type', 'payout_request.amount as payable_amount', 'payout_request.released_date as created_at', 'payout_request.updated_at')
            ->join('users', 'users.id', '=', 'payout_request.user_id')
            ->where('payout_request.user_id', '=', Auth::user()->id)
            ->where('payout_request.status', 'released')
            ->orderBy('payout_request.id', 'desc');

        $ewallet_count = $users1->union($users2)->orderBy('created_at', 'DESC')->get()->count();
        $users = $users1->union($users2)->orderBy('created_at', 'DESC')

            // ->offset($request->start)
            // ->limit($request->length)
            ->get();
        // dd($users);
        $binary = BinaryCommissionSettings::find(1)->pair_value;
        // $adminpackage = ProfileInfo::where('user_id',1)->join('packages as pack', 'pack.id','profile_infos.package')->select('pack.package')->first()->package;

        return DataTables::of($users)
            ->editColumn('fromuser', '@if ($payment_type =="released") Adminuser @else {{$fromuser}} @endif')
            ->editColumn('payment_type', ' @if ($payment_type =="released") Payout released @else <?php  echo ucfirst(str_replace("_", " ", "$payment_type")) ;  ?> @endif')
            ->editColumn('payable_amount', '@if($payable_amount>=0)  <span> {{currency(round($payable_amount,2))}} </span> @else  <span  style="color: red;" >{{currency(round($payable_amount,2))}}</span> @endif')         
            ->removeColumn('id')
            ->setTotalRecords($ewallet_count)
            ->escapeColumns([])
            ->make();
    }

    public function fund()
    {
        $title = trans('wallet.fund_transfer');
        $sub_title =  trans('wallet.fund_transfer');
        $base =  trans('wallet.fund_transfer');
        $method =  trans('wallet.fund_transfer');

        $user_balance = Balance::where('user_id', Auth::user()->id)->value('balance') ;
        $total_debit  = Commission::where('user_id', '=', Auth::user()->id)->where('payment_type', 'fund_debit')->sum('payable_amount');
        $total_credit = Commission::where('user_id', '=', Auth::user()->id)->where('payment_type', 'fund_credit')->sum('payable_amount');
        return view('app.user.ewallet.fund', compact('title', 'countries', 'user', 'sub_title', 'base', 'method', 'user_balance', 'total_debit', 'total_credit'));
    }

    public function fundtransfer(Request $request)
    {
        // dd($request->all());
     // dd($request->username);
          $validator=Validator::make($request->all(), [
                'username'=>'required|exists:users',
                'amount'=>'required',
                 'note'=>'required'
                ]);
        if ($validator->fails()) {
            return  redirect()->back()->withErrors(trans("ewallet.username_or_amount_is_not_valid"));
        } else {
            if ($request->username==Auth::user()->username) {
                return  redirect()->back()->withErrors(trans("ewallet.self_credit_is_not_possible"));
            }
            if (User::find(Auth::user()->id)->transaction_pass <> $request->trans_pass) {
                return  redirect()->back()->withErrors(trans("ewallet.invalid_transaction_password"));
            }


            if (Balance::where('user_id', Auth::user()->id)->value('balance') >= $request->amount) {
                $user_id = User::where('username', '=', $request->username)->value('id');
                Commission::create([
                    'user_id'=>$user_id,
                    'from_id'=>Auth::user()->id,
                    'total_amount'=>$request->amount,
                    'payable_amount'=>$request->amount,
                    'payment_type'=>'fund_credit',
                    'note' =>$request->note,
                    ]);
                Commission::create([
                    'user_id'=>Auth::user()->id,
                    'from_id'=>$user_id,
                    'total_amount'=>$request->amount*-1,
                    'payable_amount'=>$request->amount*-1,
                    'payment_type'=>'fund_debit',
                    'note' =>$request->note,
                    ]);
                Balance::where('user_id', $user_id)->increment('balance', $request->amount);
                Balance::where('user_id', Auth::user()->id)->decrement('balance', $request->amount);
                Session::flash('flash_notification', array('message'=>trans('wallet.amount_credited'),'level'=>'success'));
                return redirect()->back();
            } else {
                 Session::flash('flash_notification', array('message'=>trans('wallet.not_enough_balance'),'level'=>'error'));
                return redirect()->back();
            }
        }
    }



    public function mytransfer()
    {

        $title =  trans('wallet.my_transfer');
        $sub_title =  trans('wallet.my_transfer');
        $base =  trans('wallet.my_transfer');
        $method =   trans('wallet.my_transfer');
        $data1 = Commission::join('users', 'users.id', '=', 'commission.user_id')
                           ->join('users as authuser', 'authuser.id', '=', 'commission.from_id')
                           ->where('commission.user_id', Auth::user()->id)
                           ->where('commission.payment_type', 'fund_debit')
                           ->select('authuser.username as fromuser', 'commission.total_amount', 'commission.payment_type', 'commission.created_at', 'commission.note');
        $data2 = Commission::join('users', 'users.id', '=', 'commission.user_id')
                           ->join('users as authuser', 'authuser.id', '=', 'commission.from_id')
                           ->where('commission.user_id', Auth::user()->id)
                           ->where('commission.payment_type', 'fund_credit')
                           ->select('authuser.username as fromuser', 'commission.total_amount', 'commission.payment_type', 'commission.created_at', 'commission.note');
        $data = $data1->union($data2)->get();

        return view('app.user.ewallet.mytransfer', compact('title', 'countries', 'user', 'sub_title', 'base', 'method', 'data'));
    }
    public function registerPoint()
    {
        
        $title     = trans('ewallet.ewallet');
        $sub_title = trans('products.register_point');
        $base      = 'Register Point';
        $method    = 'Register Point';

        $data         = RegisterPoint::where('user_id',Auth::user()->id)->get();
        $balance      = Balance::where('user_id',Auth::user()->id)->value('register_point');
        $total_earned = RegisterPoint::where('user_id',Auth::user()->id)->where('type','credit')->sum('bv');
        $used         = RegisterPoint::where('user_id',Auth::user()->id)->where('type','debit')->sum('bv');
        $count        = RegisterPoint::where('user_id',Auth::user()->id)->where('type','credit')->sum('count') - RegisterPoint::where('user_id',Auth::user()->id)->where('type','debit')->sum('count');
        return view('app.user.ewallet.regsier_point', compact('title', 'data', 'sub_title', 'base', 'method','balance','total_earned','used','count'));
    }
    public function getTotalIncomeJson($start,$end)
    { 
        $date1 = strtr($start, ',', '-');
        $start =  date('Y-m-d', strtotime($date1));
        $date2 = strtr($end, ',', '-');
        $end =  date('Y-m-d', strtotime($date2));
        $total_credited = 0;
        if (isset($start)) {
            if($start == $end){
                $total_credited =Commission::whereDate('created_at', '=', $start)->where('user_id', Auth::user()->id)->sum('total_amount');
            } else{
                 $total_credited =Commission::whereBetween('created_at', [$start, $end])->where('user_id', Auth::user()->id)->sum('total_amount');
            }


            // if ($request->period === 'today') {
            //     $start = Carbon::now()->format('Y-m-d 00:00:00');
            //     $total_credited =Commission::whereDate('created_at', '>=', $start)->where('user_id', Auth::user()->id)->sum('total_amount');
            // } elseif ($request->period === 'week') {
            //     $now = Carbon::now();
            //     $start = $now->startOfWeek()->format('Y-m-d H:i:s');
            //     $total_credited =Commission::whereDate('created_at', '>=', $start)->where('user_id', Auth::user()->id)->sum('total_amount');
            // } elseif ($request->period === 'month') {
            //     $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
            //     $total_credited =Commission::whereDate('created_at', '>=', $start)->where('user_id', Auth::user()->id)->sum('total_amount');
            // } elseif ($request->period === 'year') {
            //     $start = Carbon::now()->startOfYear()->format('Y-m-d H:i:s');
            //     $total_credited =Commission::whereDate('created_at', '>=', $start)->where('user_id', Auth::user()->id)->sum('total_amount');
            // }elseif($request->period === 'all'){
            //      $total_credited =Commission::where('user_id', Auth::user()->id)->sum('total_amount');
            // }
            $total_credited = currency(round($total_credited,2));
            return response()->json($total_credited);
        }  
    }

    public function getTotalPurchaseJson($start,$end)
    {
        $date1 = strtr($start, ',', '-');
        $start =  date('Y-m-d', strtotime($date1));
        $date2 = strtr($end, ',', '-');
        $end =  date('Y-m-d', strtotime($date2));
        $total_credited = 0;
        if (isset($start)) {
            if($start == $end){
                $total_purchase = PurchaseHistory::whereDate('created_at', '=', $start)->where('user_id',Auth::user()->id)->where('type','product')->where('pay_by','!=','register_point')->sum('total_amount');
            } else{
                $total_purchase = PurchaseHistory::whereBetween('created_at', [$start, $end])->where('user_id',Auth::user()->id)->where('type','product')->where('pay_by','!=','register_point')->sum('total_amount');
            }
            $total_purchase = currency(round($total_purchase,2));
            return response()->json($total_purchase);
        }
    }
     public function getUsers_level_purJson(Request $request)
    {
      
        if (isset($request->period)) {
            
            if ($request->period === '1') {              
                $type = 'level_1_bonus';
                // dd($type);
            } elseif ($request->period === '2') {
                $type = 'level_2_bonus';
                // dd($type);
            } elseif ($request->period === '3') {
                $type = 'level_3_bonus';
                 // dd($type);
            }
        }
      
        $level      = Commission::where('user_id', Auth::user()->id)
                                ->where('payment_type', $type)
                                ->sum('total_amount');
       
                                              
          // dd($level);
          return response()->json(['level'=>$level]);

       
    }

}
