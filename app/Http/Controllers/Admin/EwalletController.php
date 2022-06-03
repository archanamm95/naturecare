<?php

namespace App\Http\Controllers\admin;

use App\Balance;
use App\Commission;
use App\Http\Controllers\Admin\AdminController;
use App\Payout;
use App\RsHistory;
use App\User;
use App\Currency;
use App\BinaryCommissionSettings;
use App\ProfileInfo;

use Auth;
use DataTables;
use Illuminate\Http\Request;
use Session;
use Validator;
use Crypt;

class EwalletController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(231);
// dd($_GET["currency"]);
      // if(isset($_GET["currency"]))
      // $cur=$_GET["currency"];
      // else
      //   $cur='USD';
    

 
   
        $title     = trans('ewallet.ewallet');
        $sub_title = trans('ewallet.ewallet');
        $base      = trans('ewallet.ewallet');
        $method    = trans('ewallet.ewallet');

        $users     = User::pluck('users.username', 'users.id');
        // dd($users);
        if (!session('user')) {
            Session::put('user', 'none');
        }

        if (!session('wallet_type')) {
            Session::put('wallet_type', 'All');
        }

        $userss = User::getUserDetails(Auth::id());
        $user   = $userss[0];
       

        return view('app.admin.ewallet.wallet', compact('title', 'users', 'user', 'sub_title', 'base', 'method'));
    }

    public function data(Request $request)
    {
        $amount = 0;
        $users1 = array();
        $users2 = array();
        //echo $user_id;die();
        $users1 = Commission::select('commission.id', 'user.username', 'fromuser.username as fromuser', 'commission.payment_type', 'commission.payable_amount', 'commission.created_at')
            ->join('users as fromuser', 'fromuser.id', '=', 'commission.from_id')
            ->join('users as user', 'user.id', '=', 'commission.user_id')
            ->join('profile_infos as profile', 'profile.user_id', '=', 'commission.from_id')
            
            // ->where('commission.payable_amount', '>', 0)
            ->orderBy('commission.id', 'desc');
        $users2 = Payout::select('payout_request.id', 'users.username', 'users.username as fromuser', 'payout_request.status as payment_type', 'payout_request.amount as payable_amount', 'payout_request.created_at')
            ->join('users', 'users.id', '=', 'payout_request.user_id')
            ->where('payout_request.status', 'released')
            ->orderBy('payout_request.id', 'desc');
            // ->get();
            // dd($users2);
       

        $ewallet_count = $users1->union($users2)->orderBy('created_at', 'DESC')->get()->count();
        $users = $users1->union($users2)->orderBy('created_at', 'DESC')

            // ->offset($request->start)
            // ->limit($request->length)
            ->get();

        $binary = BinaryCommissionSettings::find(1)->pair_value;
        // $adminpackage = ProfileInfo::where('user_id',1)->join('packages as pack', 'pack.id','profile_infos.package')->select('pack.package')->first()->package;

        return DataTables::of($users)
            ->editColumn('fromuser', '@if ($payment_type =="released") Adminuser @else {{$fromuser}} @endif')
            ->editColumn('payment_type', ' @if ($payment_type =="released") Payout released @else <?php  echo ucfirst(str_replace("_", " ", "$payment_type")) ;  ?> @endif')
            ->editColumn('bv', function($users) use($binary) {
                if($users->payment_type == "binary_bonus")
                    return round($users->payable_amount,2)*$binary;
                else
                    return $users->bv;
            })       
            // ->editColumn('package', function($users) use($adminpackage) {
            //     if($users->package == "")
            //         return $adminpackage;
            //     else
            //         return $users->package;
            // })            
            ->editColumn('payable_amount', '@if($payable_amount>=0)  <span> {{currency(round($payable_amount,2))}} </span> @else  <span>{{currency(round($payable_amount,2))}}</span> @endif')         
            ->removeColumn('id')
            ->setTotalRecords($ewallet_count)
            ->escapeColumns([])
            ->make();
    }
    public function userwallet(Request $request)
    {
        $amount     = 0;
        $users1     = array();
        $users2     = array();
        $users      = array();
        $user_id    = Auth::id();
        $bonus_type = trans('ewallet.bonus_type');
        if (session('user') != 'none') {
            $user_id = $request->user;
        }
        if (session('wallet_type') != 'All') {
            $bonus_type = $request->bonus_type;
        }
        $title = trans('ewallet.ewallet');
        $users = User::lists('users.username', 'users.id');
        Session::put('user', $request->user);
        Session::put('bonus_type', $request->bonus_type);
        return redirect('admin/wallet');
    }

    public function search(Request $request)
    {
        $keywords    = $request->get('username');
        $suggestions = User::where('username', 'LIKE', '%' . $keywords . '%')->get();
        return $suggestions;
    }

    public function fund()
    {

        $title     = trans('ewallet.credit_fund');
        $sub_title = trans('ewallet.credit_fund');
        $base      = trans('ewallet.credit_fund');
        $method    = trans('ewallet.credit_fund');
        $data      = Commission::where('payment_type', 'LIKE', 'fund_%')
                                ->join('users', 'users.id', 'commission.user_id')
                                ->where('commission.from_id', 1)
                                
                                ->select('commission.*', 'users.username')
                                ->orderBy('created_at', 'DESC')
                                ->paginate(10);
        return view('app.admin.ewallet.fund', compact('title', 'countries', 'user', 'sub_title', 'base', 'method', 'data'));
    }

    public function creditfund(Request $request)
    {
        // dd($request->all());
        $input = $request->all();
        $input['username'] = $request->username;

        $request->merge($input);
   

        $validator = Validator::make($request->all(), [
            'username' => 'required|exists:users',
            'amount'   => 'required|numeric',
            'note'   => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $user_id = User::where('username', $request->username)->value('id');
            if (isset($request->debit_amount)) {
                $use_bal=Balance::where('user_id', $user_id)->value('balance');
                if ($use_bal >= $request->amount) {
                   

                    Commission::create([
                    'user_id'        => $user_id,
                    'from_id'        => Auth::user()->id,
                    'total_amount'   => -$request->amount,
                    'payable_amount' => -$request->amount,
                    'payment_type'   => 'fund_debit',
                    'note'           => $request->note,
                    ]);

                    // Balance::where('user_id', 1)->increment('balance', $request->amount);
                    Balance::where('user_id', $user_id)->decrement('balance', $request->amount);
                    Session::flash('flash_notification', array('message' => trans('users.amount_debited_from_user_ewallet'), 'level' => 'success'));
                    return redirect()->back();
                } else {
                    Session::flash('flash_notification', array('message' => trans("users.sorry_there_is_no_enough_balance_in_user_account!!"), 'level' => 'danger'));
                    return redirect()->back();
                }
            } else {
                Commission::create([
                'user_id'        => $user_id,
                'from_id'        => Auth::user()->id,
                'total_amount'   => $request->amount,
                'payable_amount' => $request->amount,
                'payment_type'   => 'fund_credit',
                'note'           => $request->note,
                ]);

                Balance::where('user_id', $user_id)->increment('balance', $request->amount);
                Session::flash('flash_notification', array('message' => trans('users.amount_credited_to_user_ewallet'), 'level' => 'success'));
                   return redirect()->back();
                return redirect()->back();
            }
        }
    }

    public function rs_wallet()
    {

        $title     = trans('ewallet.rs_wallet');
        $sub_title = trans('ewallet.rs_wallet');
        $base      = trans('ewallet.rs_wallet');
        $method    = trans('ewallet.rs_wallet');

        return view('app.admin.ewallet.rs_wallet', compact('title', 'sub_title', 'base', 'method'));
    }

    public function rs_data(Request $request)
    {

        $rs_count = RsHistory::count();
        $rstable = RsHistory::select('rs_history.id', 'user.username', 'fromuser.username as fromuser', 'rs_history.rs_debit', 'rs_history.rs_credit', 'rs_history.created_at')
            ->join('users as fromuser', 'fromuser.id', '=', 'rs_history.from_id')
            ->join('users as user', 'user.id', '=', 'rs_history.user_id')
            ->orderBy('rs_history.id', 'desc')
            ->get();

        return Datatables::of($rstable)
            ->editColumn('rs_debit','{{currency(round($rs_debit,2))}}')
            ->editColumn('rs_credit','{{currency(round($rs_credit,2))}}')
            ->removeColumn('id')
            ->setTotalRecords($rs_count)
            ->make();
    }
}
