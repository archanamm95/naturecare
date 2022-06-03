<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Session;
use App\TempDetails;
use App\PendingTransactions;
use App\payout_gateway_details;



class CloudMLMController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         // $this->middleware('guest:admin');
         $this->redirectTo = '/homes';
    }


    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function performLogoutToLock(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();
        if (isset($request->loggedOut)) {
            if ((null !==$request->loggedOut) && (null !==$request->redirect)) {
                return redirect('login/?loggedOut='.$request->loggedOut.'&redirect='.$request->redirect);
            } elseif (isset($request->loggedOut)) {
                return redirect('login/?loggedOut='.$request->loggedOut);
            }
        } else {
            return redirect('login');
        }
    }
    public function processReturnUrl(Request $request)
    {   
        $temp = TempDetails::create([
                    'regdetails'       =>  json_encode($request->all()),
                    'token'            =>  $request->order_id,
                ]);
        $secretkey=payout_gateway_details::where('id',1)->value('secret_key');

        if(isset($request->status_id) && isset($request->order_id) && isset($request->msg) && isset($request->transaction_id) && isset($request->hash))
        {
            $hashed_string = hash_hmac('sha256', $secretkey.$request->status_id.$request->order_id.$request->transaction_id.$request->msg, $secretkey);
            if($hashed_string == $request->hash)
            {
                if($request->status_id == '1'){
                    $register = PendingTransactions::where('order_id', $request->order_id)->first();
                    if($register->payment_status != 'finish'){
                        $register->payment_status = 'complete';
                        $register->save();
                        $title=trans('register.payment_complete');
                        $sub_title=trans('register.payment_complete');
                        $base=trans('register.payment_complete');
                        $method=trans('register.payment_complete');
                        $purchase_id=$register->id;
                        TempDetails::where('id',$temp->id)->update(['paystatus' => 1]);
                        if(Auth::check()){
                            if(Auth::user()->admin == 1){
                                return view('app.admin.register.regcomplete', compact('title', 'sub_title', 'base', 'method', 'purchase_id'));
                            }
                            else{
                                if($register->payment_type == 'register')
                                    return view('app.user.register.regcomplete', compact('title', 'sub_title', 'base', 'method', 'purchase_id'));
                                elseif($register->payment_type == 'plan_upgrade' || $register->payment_type == 'shop_purchase')
                                    return view('app.user.product.purchasecomplete', compact('title', 'sub_title', 'base', 'method', 'purchase_id'));
                            }

                        }
                        else{
                            $reg_type=option('app.user_registration');
                            return view('auth.regcomplete', compact('reg_type','purchase_id'));
                        }
                    }
                    else{
                        Session::flash('flash_notification', array('message'=>trans('controlpanel.success'),'level'=>'warning'));
                        return redirect('login');
                    }
                }
                elseif($request->status_id  == 0)
                {
                    PendingTransactions::where('order_id', $request->order_id)->update(['payment_status' => 'failed']) ;
                    Session::flash('flash_notification', array('message'=>trans('register.payment_failure'),'level'=>'warning'));
                    return redirect()->back();
                }
            }
        }
    }

}
