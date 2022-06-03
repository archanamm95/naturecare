<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Auth;
use Redirect;
use Input;
use Validator;
use Session;
use App\Balance;
use App\Mail;
use App\User;
use App\Voucher;
use App\Activity;
use App\VoucherRequest;
use App\Settings;
use App\Http\Requests\user\getVoucherRequest;
use App\Http\Controllers\Controller;
use App\Models\ControlPanel\Options;

use App\Http\Controllers\user\UserAdminController;

class VoucherController extends UserAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = trans('voucher.request_voucher');
        $rules = ['req_amount' => 'required'];
        $userss = User::getUserDetails(Auth::id());
        $user = $userss[0];
        $base = trans('voucher.voucher');
        $method = trans('voucher.request_voucher');
        $sub_title = trans('voucher.voucher_request');
        $user_balance =Balance::where('user_id', '=', Auth::user()->id)->value('balance');
        $all_vouchers = VoucherRequest::where('user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->paginate(5);
        return view('app.user.voucher.request_new_voucher', compact('user', 'title', 'rules', 'user_balance', 'base', 'method', 'sub_title', 'all_vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    
    public function vouchrequest(Request $request)
    {
      // dd($request->all());
        $amount = $request->req_amount;
        $count = $request->req_count;
        $total_amount =$amount * $count;
        $user_balance = Balance::where('user_id', '=', Auth::user()->id)->value('balance');
        if ($total_amount > $user_balance) {
            Session::flash('flash_notification', array('level'=>'warning','message'=>trans('wallet.not_enough_balance')));
            return redirect()->back();
        } else {
          // $voucher_daily_limit=Settings::find(1)->voucher_daily_limit;
          // $daily_voucher=Voucher::where('created_at', '>', date('Y-m-d 00:00:00'))->where('created_at', '<', date('Y-m-d 23:59:59'))->count();
          // $total_today_voucher=$daily_voucher+$request->count;
          // $voucher_user_request = option('app.voucher_user_request');
          // $voucher_admin_approval = option('app.email_verification');

        
            $voucher_admin_approval=Options::find(51)->value;
            $voucher_user_request=Options::find(50)->value;
            if ($voucher_user_request == 'yes' && $voucher_admin_approval == 'yes') {
                $user_registration = option('app.user_registration');
                VoucherRequest::create([
                'user_id'        => Auth::user()->id,
                'amount'        => $amount,
                'count'  =>$count,
                'total_amount'  =>$total_amount,
                'status'   => 'pending'
                ]);

                Activity::add("Voucher requested by  ".Auth::user()->username, Auth::user()->username ." requested  $count voucher  amount of $amount ");
                Balance::where('user_id', Auth::user()->id)->decrement('balance', $total_amount);
                Session::flash('flash_notification', array('level'=>'success','message'=>trans('voucher.request_completed')));
                return redirect()->back();
            }

            if ($voucher_user_request == 'yes' && $voucher_admin_approval == 'no') {
                $voucher_daily_limit=Settings::find(1)->voucher_daily_limit;
                $daily_voucher=Voucher::where('created_at', '>', date('Y-m-d 00:00:00'))->where('created_at', '<', date('Y-m-d 23:59:59'))->count();
                $total_today_voucher=$daily_voucher+$count;
                if ($total_today_voucher > $voucher_daily_limit) {
                      return redirect()->back()->withErrors(trans('voucher.your_daily_limit_is_exceeded_please_try_tomorrow'));
                }

         
                while ($count) {
                    $voucher = self::RandomString();
                    $res     = Voucher::create([
                       'user_id'        =>Auth::user()->id,
                       'voucher_code'   => $voucher,
                       'total_amount'   => $amount,
                       'balance_amount' => $amount,
                      ]);
                    $count--;
                }

                Balance::where('user_id', Auth::user()->id)->decrement('balance', $total_amount);
                Session::flash('flash_notification', array('level'=>'success','message'=>trans('voucher.voucher_created_completely')));
                return redirect()->back();
            }

            Session::flash('flash_notification', array('level'=>'danger','message'=>trans('voucher.voucher_request_not_possible')));
            return redirect()->back();
        }
    }

    public function RandomString()
    {
        $characters       = "23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
        $charactersLength = strlen($characters);
        $randstring       = '';
        for ($i = 0; $i < 11; $i++) {
            $randstring .= $characters[rand(0, $charactersLength - 1)];
        }
        $count = Voucher::where('voucher_code', $randstring)->count();
        if ($count > 0) {
            return self::RandomString();
        }

        return $randstring;
    }

    public function myvouch(Request $request)
    {


          $title = trans('voucher.my_voucher');
        // $rules = ['req_amount' => 'required'];
        // $userss = User::getUserDetails(Auth::id());
        // $user = $userss[0];
        // $base = 'Voucher';
        $method = trans('voucher.request_voucher');
        $sub_title = trans('voucher.my_voucher');
        // $user_balance = Balance::getTotalBalance(Auth::user()->id);
        // $my_vouchers = VoucherRequest::where('user_id',Auth::user()->id)->orderBy('updated_at','DESC')->get();

        $my_vouchr = Voucher::where('user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->paginate(10);
        return view('app.user.voucher.my_voucher', compact('user', 'title', 'rules', 'user_balance', 'base', 'method', 'sub_title', 'my_vouchr'));
    }
    












        // $validator = Validator::make(Input::all(), array('req_amount' => 'required|numeric','req_count'=>'required|integer'));
    

        // if ($validator->fails()) {

        // // get the error messages from the validator
        // $messages = "Request amount is required";

        // // redirect our user back to the form with the errors from the validator
        // return Redirect::to('requestvoucher')
        //     ->withErrors($validator);
        // }
       //  else{
       //          VoucherRequest::create([
       //  'user_id'        => Auth::user()->id,
       //  'amount'        => $amount,
       //  'count'  =>$count,
       //  'total_amount'  =>$total_amount,
       //  'status'   => 'pending'
       //  ]);
       //          Balance::updateBalance(Auth::user()->id, $total_amount);
       //      Session::flash('flash_notification',array('level'=>'success','message'=>'Request Completed'));
       //      return Redirect::action('user\VoucherController@index');
       //  }
       // }
       // else if($amount <= 0){
       //      Session::flash('flash_notification',array('level'=>'danger','message'=>'Invalid amount'));
       //      return Redirect::action('user\VoucherController@index');
       // }
       // else if(!is_numeric($count) || $count < 0){
       //     //echo "You dont have balance";
       //     Session::flash('flash_notification',array('level'=>'danger','message'=>'Requested Count not correct'));
       //      return Redirect::action('user\VoucherController@index');
       // }
       // else if(!is_numeric($amount)){
       //     //echo "You dont have balance";
       //     Session::flash('flash_notification',array('level'=>'danger','message'=>'Requested amount not correct'));
       //      return Redirect::action('user\VoucherController@index');
       // }
       // else {

           //echo "You dont have balance";
       //     Session::flash('flash_notification',array('level'=>'danger','message'=>'You dont have balance'));
       //      return Redirect::action('user\VoucherController@index');
       // }
    // }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function viewvoucher(){
    //     $title = "View My vouchers";
    //     $sub_title = 'My vouchers';
    //     $userss = User::getUserDetails(Auth::id());
    //     $user = $userss[0];
    //     $all_vouchers = VoucherRequest::where('user_id',Auth::user()->id)->get();
    //     $base = 'Voucher';
    //     $method = 'My vouchers';
    //     return view('app.user.voucher.view_my_voucher',compact('title','rules','user_balance','all_vouchers','user','base','method','sub_title'));
    // }
}
