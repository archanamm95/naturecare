<?php

namespace App\Http\Controllers\Admin\ControlPanel\PayoutManger;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ControlPanel\Options;

use App\HyperWallets;
use App\btc_Settings;
use App\paypal_payoutSettings;
use App\User;
use App\Payoutmanagemt;
use Session;
use Response;
use App\PaymentType;
use App\PaymentGatewayDetails;
use App\BinaryCommissionSettings;
use Validator ;
use App\payout_gateway_details;

class PayoutConfigurationManager extends Controller
{
    

    public function index()
    {
        $title     = trans('controlpanel.payout_manager');
        $sub_title = trans('controlpanel.payout_manager');
        $base      = trans('controlpanel.payout_manager');
        $method    = trans('controlpanel.payout_manager');

        $payout_gateway_details=payout_gateway_details::all()->first();
        // dd($payout_gateway_details);
        $payment_type=Payoutmanagemt::all();
        $binary_commission = BinaryCommissionSettings::find(1);
     
        return view('app.admin.control_panel.payout_manger.index', compact('title', 'sub_title', 'base', 'method','payment_type', 'payout_gateway_details','binary_commission'));
    }
    public function payout_gateway_input(Request $request)
    {
        $update= payout_gateway_details::where('id', 1)
                ->update([
                    'username'        => $request->username,
                    'program_token'   => $request->programtoken ,
                    'password'        => $request->password,
                    'paypal_clientId' => $request->paypal_client_id,
                    'paypal_secret'   => $request->paypal_secret,
                    'wallet_id'       => $request->wallet_id,
                    'wallet_hashId'   => $request->wallet_id_hash
                ]);
        Session::flash('flash_notification', array('message' =>trans('controlpanel.details_updated'), 'level' => 'success'));
    }
    public function hyperwallet_input(Request $request)
    {
        $username=$request->username;
        $password=$request->password;
        $programtoken=$request->programtoken;
        
            $programtoken;
            $update= payout_gateway_details::where('id', 1)->update(['username'=>$username,'program_token' => $programtoken ,'password'=>$password]);

        Session::flash('flash_notification', array('message' =>trans('controlpanel.wallet_details_updated'), 'level' => 'success'));
        // return redirect()->back();
        return redirect('admin/control-panel/payout-manager'.'#nav-home');

    }
    public function paypal_input(Request $request)
    {
       
        $programtoken;
        $update= payout_gateway_details::where('id', 1)->update(['paypal_clientId'=>$request->paypal_client_id,'paypal_secret' => $request->paypal_secret ]);
        Session::flash('flash_notification', array('message' =>trans('controlpanel.wallet_details_updated'), 'level' => 'success'));
        // return redirect()->back();
        return redirect('admin/control-panel/payout-manager'.'#nav-profile');

    }
    
     public function payout_senangpay_input(Request $request)
    {
        $update= payout_gateway_details::where('id', 1)->update(['merchant_id'=>$request->merchant_id,'secret_key' => $request->secret_key ]);
        Session::flash('flash_notification', array('message' =>trans('controlpanel.wallet_details_updated'), 'level' => 'success'));
        // return redirect()->back();
        return redirect('admin/control-panel/payout-manager'.'#nav-senag');

    }
    public function btc_input(Request $request)
    {
       
        $programtoken;
        $update= payout_gateway_details::where('id', 1)->update(['wallet_id'=>$request->wallet_id,'wallet_hashId' => $request->wallet_id_hash ]);
        Session::flash('flash_notification', array('message' =>trans('controlpanel.wallet_details_updated'), 'level' => 'success'));

        // return redirect()->back();
        return redirect('admin/control-panel/payout-manager'.'#nav-contact');

    }
    public function payout_options(Request $request)
    {

        if ($request->key =='Manual/Bank') {
            $update= Payoutmanagemt::where('payment_mode', 'Manual/Bank')->update(['status'=>$request->value ]);
            return Response::json(array('status' => $request->value));
        } elseif ($request->key == 'Hyperwallet') {
            $update= Payoutmanagemt::where('payment_mode', 'Hyperwallet')->update(['status'=>$request->value ]);
            return Response::json(array('status' => $request->value));
        } elseif ($request->key == 'Paypal') {
            $update= Payoutmanagemt::where('payment_mode', 'Paypal')->update(['status'=>$request->value ]);
            return Response::json(array('status' => $request->value));
        } elseif ($request->key == 'Bitaps') {
            $update= Payoutmanagemt::where('payment_mode', 'Bitaps')->update(['status'=>$request->value ]);
            return Response::json(array('status' => $request->value));
        }
    }

    public function update(Request $request)
    {

        $input = $request->all();
        $rules = array(
            'key'   => 'required',
            'value' => 'required',
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json([
                'state' => 'error',
                'code' => 200
            ]);
        } else {
            (null !== $request->key ? Options::updateOptionByKey('app.'.$request->key, $request->value) :  abort(404) );

            return response()->json([
            'state' => 'success',
            'code' => 200
            ]);
        }
    }

    public function paymentgateway()
    {
        $title     = trans('controlpanel.payment_gateway_manager');
        $sub_title = trans('controlpanel.payment_gateway_manager');
        $base      = trans('controlpanel.payment_gateway_manager');
        $method    = trans('controlpanel.payment_gateway_manager');
        $paymentgateway=PaymentType::all();
        $paymentdetails=PaymentGatewayDetails::find(1);

        return view('app.admin.control_panel.payout_manger.paymentgateway', compact('title', 'sub_title', 'base', 'method', 'paymentgateway', 'paymentdetails'));
    }

    public function uppaymentgateway(Request $request)
    {

        $input = $request->all();
        $rules = array(
          'key' => 'required',
          'value' => 'required',
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json([
                'state' => 'error',
                'code' => 200
            ]);
        } else {
            (null !== $request->key ? PaymentType::updatePayOptionByKey($request->key, $request->value) :  abort(404) );

            return response()->json([
            'state' => 'success',
            'code' => 200
            ]);
        }
    }


    public function chequepayment(Request $request)
    {

        
        $input = $request->all();
        $rules = array(
            'bank_details' => 'required',
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            Session::flash('flash_notification', array('level'=>'error','message'=>trans('profile.value_required')));
            return redirect()->back();
        } else {
            PaymentGatewayDetails::where('id', 1)->update(['bank_details' => $request->bank_details]);
            Session::flash('flash_notification', array('level'=>'success','message'=>trans('profile.bank_details_updated')));
            return redirect()->back();
        }
    }

    public function bitapspayment(Request $request)
    {
         $input = $request->all();
        $rules = array(
            'btc_address' => 'required',
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            Session::flash('flash_notification', array('level'=>'error','message'=>trans('profile.value_required')));
            return redirect()->back();
        } else {
            PaymentGatewayDetails::where('id', 1)->update(['btc_address' => $request->btc_address]);
            Session::flash('flash_notification', array('level'=>'success','message'=>trans('controlpanel.bitaps_details_updated_successfully')));
            return redirect()->back();
        }
    }
    public function authorizepayment(Request $request)
    {

        $input = $request->all();
        $rules = array(
           'auth_merchant_name' => 'required',
           'auth_transaction_key' => 'required',
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            Session::flash('flash_notification', array('level'=>'error','message'=>trans('profile.value_required')));
            return redirect()->back();
        } else {
            PaymentGatewayDetails::where('id', 1)->update(['auth_merchant_name' => $request->auth_merchant_name,'auth_transaction_key' =>$request->auth_transaction_key]);
            Session::flash('flash_notification', array('level'=>'success','message'=>trans('controlpanel.authorize_details_updated_successfully')));
            return redirect()->back();
        }
    }
    public function ravepayment(Request $request)
    {

        $input = $request->all();
        $rules = array(
           'rave_public_key' => 'required',
           'rave_secret_key' => 'required',
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            Session::flash('flash_notification', array('level'=>'error','message'=>trans('profile.value_required')));
            return redirect()->back();
        } else {
            PaymentGatewayDetails::where('id', 1)->update(['rave_public_key' => $request->rave_public_key,'rave_secret_key' =>$request->rave_secret_key ]);
            Session::flash('flash_notification', array('level'=>'success','message'=>trans('controlpanel.rave_payment_details_updated_successfully')));
            return redirect()->back();
        }
    }
    public function paypalpayment(Request $request)
    {

        $input = $request->all();
        $rules = array(
           'paypal_username' => 'required',
           'paypal_password' => 'required',
           'paypal_secret_key' => 'required',
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            Session::flash('flash_notification', array('level'=>'error','message'=>trans('profile.value_required')));
            return redirect()->back();
        } else {
            PaymentGatewayDetails::where('id', 1)->update(['paypal_username' => $request->paypal_username,'paypal_password' =>$request->paypal_password,'paypal_secret_key' => $request->paypal_secret_key]);
            Session::flash('flash_notification', array('level'=>'success','message'=>trans('controlpanel.paypal_details_updated_successfully')));
            return redirect()->back();
        }
    }
    public function stripepayment(Request $request)
    {

        $input = $request->all();
        $rules = array(
           'stripe_secret_key' => 'required',
           'stripe_public_key' => 'required',
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            Session::flash('flash_notification', array('level'=>'error','message'=>trans('profile.value_required')));
            return redirect()->back();
        } else {
            PaymentGatewayDetails::where('id', 1)->update(['stripe_secret_key' => $request->stripe_secret_key,'stripe_public_key' => $request->stripe_public_key]);
            Session::flash('flash_notification', array('level'=>'success','message'=>trans('controlpanel.stripe_details_updated_successfully')));
            return redirect()->back();
        }
    }
    public function ipayghpayment(Request $request)
    {

        $input = $request->all();
        $rules = array(
           'ipaygh_merchant_key' => 'required',
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            Session::flash('flash_notification', array('level'=>'error','message'=>trans('profile.value_required')));
            return redirect()->back();
        } else {
            PaymentGatewayDetails::where('id', 1)->update(['ipaygh_merchant_key' => $request->ipaygh_merchant_key]);
            Session::flash('flash_notification', array('level'=>'success','message'=>trans('controlpanel.ipaygh_details_updated_successfully')));
            return redirect()->back();
        }
    }
    public function skrillpayment(Request $request)
    {

        $input = $request->all();
        $rules = array(
           'skrill_mer_email' => 'required',
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            Session::flash('flash_notification', array('level'=>'error','message'=>trans('profile.value_required')));
            return redirect()->back();
        } else {
            PaymentGatewayDetails::where('id', 1)->update(['skrill_mer_email' => $request->skrill_mer_email]);
            Session::flash('flash_notification', array('level'=>'success','message'=>trans('controlpanel.skrill_payment_details_updated_successfully')));
            return redirect()->back();
        }
    }

    public function mipayamount(Request $request)
    {           
        payout_gateway_details::where('id', 1)->update(['min_payout_amount' => $request->min_payout_amount,'payout_setup_admin' => $request->payout_type]);

        $binary_commission=BinaryCommissionSettings::find(1);
        $binary_commission->monthly_maintenance=$request->monthly_maintenance;
        $binary_commission->save();

         Session::flash('flash_notification', array('level'=>'success','message'=>trans('controlpanel.payout_details_updated_successfully')));
            return redirect()->back();
    }
}
