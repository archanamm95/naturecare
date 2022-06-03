<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Tree_Table;
use App\Commission;
use App\Packages;
use App\ProfileModel;
use App\PurchaseHistory;
use App\ProfileInfo;
use App\RsHistory;
use App\Activity;
use App\Emails;
use App\TempDetails;
use App\PendingTransactions;
use DateTime;
use Mail;
use DB;
use Artisan;
use Crypt;
use Validator;
use Auth;
use Response;
use File;
use App\Payout;
use App\Balance;
use App\Debit;
use App\UserDebit;
use App\AppSettings;
use App\Order;
use App\PaymentGatewayDetails;
use App\Product;
use App\Job;
use App\LeadCapture;
use App\Shippingaddress;
use App\BillingAddress;
use Input;
use App\LevelCommissionSettings;


class InfluencerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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



  public function ocInfluencerRegister(Request $request)
    {
       
// return 3;
        if ($request->all() == null || empty($request->all()) ) {

             return Response::json(['status'=>true,'message'=>'failed'])->header('Content-Type','application/json');
        }
        $data=json_encode($request->all());
        $tempdata= TempDetails::create([
                'regdetails'=>$data,
                'paystatus'=>'checkout-reg',
                'token'=>0
        ]);

        $data                           = array();
        $data['sponsor']                = $request->sponsor;
        $data['purchase']               = $request->purchase;
        $data['ic_number']              = $request->ic_number;
        $data['username']               = $request->username;
        $data['firstname']              = $request->firstname;
        $data['lastname']               = $request->lastname;
        $data['email']                  = $request->email;
        $data['phone']                  = '+'.$request->phone_code.$request->phone;
        $data['dateofbirth']            = $request->dateofbirth;
        $data['facebook_username']      = $request->facebook_username;
        $data['WeChat_id']              = $request->WeChat_id;
        $data['Instagram_Id']           = $request->Instagram_Id;
        $data['tiktok_id']              = $request->tiktok_id;
        $data['Shopee_Shop_Name']       = $request->Shopee_Shop_Name;
        $data['Lazada_Shop_name']       = $request->Lazada_Shop_name;
        $data['twitter_username']       = $request->twitter_username;
        $data['youtube_username']       = $request->youtube_username;
        $data['file_name']              = $request->id_file;
        $data['password']               = $request->password;
        $data['package']                = 1;
        $data['product']                = $request->product;
        $data['product_details']        = $request->product_details;
        $data['total_quantity']         = $request->total_quantity;
        $data['total_price']            = $request->total_price;
        $data['address']                = $request->address;
        $data['address2']               = $request->address2;
        $data['city']                   = $request->city;
        $data['zip']                    = $request->zip;
        $data['country']                = $request->country;
        $data['state']                  = $request->state;
        $data['bank_file']              = '';
        $data['user_type']              = $request->user_type;
        $data['reg_by']                 = $request->payment;
        $data['reg_type']               = $request->reg_type;
        $data['confirmation_code']      = str_random(40);
        $data['order_id']               = $request->order_id;
        // $data['billing_firstname']      = $request->billing_firstname;
        // $data['billing_lastname']       = $request->billing_lastname;
        // $data['payment_company']        = $request->payment_company;
        // $data['billing_address']        = $request->billing_address;
        // $data['billing_address2']       = $request->billing_address2;
        // $data['billing_city']           = $request->billing_city;
        // $data['payment_zone_id']        = $request->payment_zone_id;
        // $data['billing_zip']            = $request->billing_zip;
        // $data['payment_zone']           = $request->payment_zone;
        // $data['payment_zone_code']      = $request->payment_zone_code;
        // $data['billing_country']        = $request->billing_country;
        // $data['shipping_firstname']     = $request->shipping_firstname;
        // $data['shipping_lastname']      = $request->shipping_lastname;
        // $data['shipping_address']       = $request->shipping_address;
        // $data['shipping_address2']      = $request->shipping_address2;
        // $data['shipping_city']          = $request->shipping_city;
        // $data['shipping_zip']           = $request->shipping_zip;
        // $data['shipping_firstname']     = $request->shipping_firstname;
        // $data['shipping_lastname']      = $request->shipping_lastname;
        // $data['shipping_address']       = $request->shipping_address;
        // $data['shipping_address2']      = $request->shipping_address2;
        // $data['shipping_city']          = $request->shipping_city;
        // $data['shipping_zip']           = $request->shipping_zip;
        // $data['shipping_country']       = $request->shipping_country;
        // $data['shipping_state']         = $request->shipping_state;
        $data['payment_date']           = $request->payment_date;
        $data['shipping_country']       = $request->shipping_country;
        $data['package_count']          = $request->package_count;
        $data['registration_type']      = $request->registration_type;
        $data['tracking_id']            = isset($request->tracking_id) ? $request->tracking_id : 'not_found';
        $data['courier_service']        = isset($request->courier_service) ? $request->courier_service : 'not_found';

        $messages = [
                'unique' => 'The :attribute already existis in the system',
                'exists' => 'The :attribute not found in the system',

        ];

        $validator = Validator::make($data, [
                'sponsor'          => 'required|exists:users,username|max:255',
                'email'            => 'required|unique:users,email|email|max:255',
                'username'         => 'required|unique:users,username|max:255',
        ]);

        if ($validator->fails()) {
            $data=$validator->errors();
            return Response::json(['status'=>0,'message'=>$data])->header('Content-Type','application/json');
        } 
        else {
                // DB::beginTransaction();
          try {

            // $sponsor_details = User::where('username',$data['sponsor'])->first();
            // $sponsor_id = $sponsor_details->id;
            // $sponsor_type = $sponsor_details->user_type;
            $sponsor_id =User::where('username',$data['sponsor'])->value('id');
            $placement_id =  $sponsor_id ;


                if (!$sponsor_id)
                {

                   $sponsor_id = 1;
                   $placement_id = 1;
                    
                }

                     $payment   = PendingTransactions::create([
                     'order_id' =>$request->order_id,
                     'username' =>$request->username,
                     'email'    =>$request->email,
                     'sponsor'  => $sponsor_id,
                     'package'  => 0,
                     'request_data'     =>json_encode($data),
                     'payment_method'   =>'influencer',
                     'payment_type'     =>'register',
                     'payment_status'   =>'complete',
                     'amount'           => 0,
                    ]);

                 
                // DB::commit();

                Artisan::call('process:influencer', ['--payment_id' =>$payment->id]);               
             
                TempDetails::where('id',$tempdata->id)->update(['token'=>1]);

                return Response::json(['status'=>1,'message'=>['success'],'userID'=>$tempdata->id])->header('Content-Type','application/json');
               }
               catch(\Exception $e)
               {
                 
                 DB::rollback();
                 
                    $error1 = $e->getMessage();
                   
                    $line_number = $e->getLine();
                    TempDetails::where('id',$tempdata->id)->update(['error' => $error1,
                                      'line_number' => $line_number]);
               
               return Response::json(['status'=>0,'message'=>$error1,'1000'=>$error1])->header('Content-Type','application/json');
               }

        }  
    }


    // Opencart Checkout (Repurchase)
    public function ocInfluencerCheckout(Request $request)
    {

        if ($request->all() == null || empty($request->all()) ) {


        return Response::json(['status'=>true,'message'=>'failed'])->header('Content-Type','application/json');
        }

        $email = json_encode($request->email);
        $tempdata=TempDetails::create([
                'regdetails'=>json_encode($request->all()),
                'paystatus'=>'checkout',
                'token'=>0
        ]);
        $seller_id=User::where('username',$request->purchase)->select('id','status')->first();

        
        $payment = PendingTransactions::create([
                     'order_id' =>$request->order_id,
                     'username' =>$request->email,                 
                     'email'    =>$request->email,
                     'sponsor'  =>$seller_id->id,
                     'package'  =>0,
                     'request_data'     =>json_encode($request->all()),
                     'payment_method'   =>'payment',
                     'payment_type'     =>'checkout',
                     'payment_status'   =>'complete',
                     'amount'           => 0,
                    ]);



        Artisan::call('process:influencer', ['--payment_id' =>$payment->id]); 
        // return 3;

        TempDetails::where('id',$tempdata->id)->update(['token'=>1]);




        return Response::json(['status'=>1,'message'=>['success']])->header('Content-Type','application/json');

    }
}