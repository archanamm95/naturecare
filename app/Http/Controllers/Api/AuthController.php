<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use Auth;
use App\User;
use App\PointTable;
use App\Balance;
use App\Payout;
use App\Ranksetting;
use App\PurchaseHistory;
use App\RsHistory;
use App\ProfileModel;
use App\Packages;
use App\Sponsortree;
use App\Tree_Table;
use App\PaymentGatewayDetails;
use App\Product;
use App\PendingTransactions;
use Input;
use Response;

class AuthController extends Controller
{
    public function index(Request $request)
    {
         
        $login  = urldecode($request->email) ;
        $confirmation_code   = urldecode($request->code)  ;
        $webpenter_token   = urldecode($request->token)  ;
        Session::put('webpenter_token', $webpenter_token);
        $user = User::where('email', '=', urldecode($login))
                ->where('confirmation_code', $confirmation_code)
                ->first();

        if ($user) {
            Auth::login($user);
            return redirect('user/genealogy');
        } else {
            return redirect()->back();
        }
    }
 
    public function store(Request $request)
    {
        $login  = $request->email ;
         $confirmation_code   = $request->code  ;
        $webpenter_token   = $request->token  ;
        Session::put('webpenter_token', $webpenter_token);
        $user = User::where('email', '=', urldecode($login))->where('confirmation_code', $confirmation_code)->first();

        if ($user) {
            Auth::login($user);
            return Response::json([1000=>'OK'])->header('Content-Type', 'application/json');
        } else {
            return Response::json([1000=>'not ok'])->header('Content-Type', 'application/json');
        }
    }

    // public function login(Request $request)
    // {
       
    //     $validator = Validator::make($request->all(), [
               
    //         'username' => 'required|alpha_num|max:255',
    //         'password' => 'required|min:6',
             
    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json(['status'=>false,'message'=>$validator->errors()], 200);
    //     } else {
    //         if (Auth::attempt(['username' => request('username'), 'password' => request('password')])) {
    //             $user = Auth::user();
    //             $user_id =User::where('username', $request->username)->value('id');
    //             $userresult = User::select('users.*')
    //                     ->where('username', $request->username)
    //                     ->get();
           
    //             $GLOBAL_RANK = Ranksetting::where('id', $userresult[0]->rank_id)->value('rank_name');
    //             ;
    //             $left_bv  =  PointTable::where('user_id', $user_id)->value('left_carry');
    //             $right_bv = PointTable::where('user_id', $user_id)->value('right_carry');
    //             $balance  = Balance::getTotalBalance($user_id);
    //             $total_rs = RsHistory::where('user_id', $user_id)->sum('rs_credit');
    //             $payout   = payout::where('user_id', $user_id)
    //                            ->where('status', '=', 'released')->sum('amount');
    //             $total_invest = PurchaseHistory::where('user_id', $user_id)->sum('total_amount');
    //             $total_top_up = PurchaseHistory::where('user_id', $user_id)->sum('count');
    //             $new_users = User::join('profile_infos', 'profile_infos.user_id', '=', 'users.id')
    //                           ->join('tree_table', 'tree_table.user_id', '=', 'users.id')
    //                           ->where('tree_table.sponsor', '=', $user_id)
    //                           ->limit(8)
    //                           ->get();
    //             $count_new    = count($new_users);

    //             $dashboard_data['GLOBAL_RANK']=$GLOBAL_RANK;
    //             $dashboard_data['left_bv']=$left_bv;
    //             $dashboard_data['right_bv']=$right_bv;
    //             $dashboard_data['balance']=$balance;
    //             $dashboard_data['total_rs']=$total_rs;
    //             $dashboard_data['payout']=$payout;
    //             $dashboard_data['total_invest']=$total_invest;
    //             $dashboard_data['total_top_up']=$total_top_up;
    //             $dashboard_data['new_users']=$new_users;
    //             $dashboard_data['count_new']=$count_new;
               
                


    //             $access_token = $user->createToken('login')->accessToken;
    //             return response()->json(['status'=>true,'message'=>"success",'dashboard_data'=>$dashboard_data,'access_token'=>$access_token], 200);
    //         } else {
    //              return response()->json(['status'=>false,'message'=>"failed"], 200);
    //         }
    //     }
    // }


    public static function backofficelogin($username,Request $request)
    {

        $user = User::where('username','=',base64_decode($username))->first()->id;
        if ($user) {

           Auth::loginusingid($user);
           return redirect('/user/dashboard');
        } 
        else {

           return redirect()->to(env('SITE_URL'))->send();
        }

    }

     public function logout($username)
    {

        $oc_logout_link=env('SITE_URL')."index.php?route=account/logout";
        $userToLogout = User::where('username',base64_decode($username))->first();
        Auth::setUser($userToLogout);
        Auth::logout();

        return redirect()->to($oc_logout_link)->send();

    }
       

































    //     protected function validator(array $data)
    // {

    //     // dd($data);




    //     return Validator::make($data, [ 
    //         'sponsor' => 'exists:users,username',
    //         'username' => 'required|max:255|unique:users,username|unique:pending_transactions,username',
    //         'password' => 'required|min:6',
    //         'firstname_' => 'required|max:255',
    //         'lastname' => 'max:255',//OPTIONAL
    //         // 'gender' => 'required|max:255',
    //         // 'tax_id' => 'max:255', //TAX ID //VAT// National Identification Number ,

    //         //Contact Information
    //         'country' => 'required|max:255',
    //         'state' => 'required|max:255',
    //         // 'city' => 'required|max:255',
    //         // 'zip' => 'max:255',//OPTIONAL
    //         'address' => 'required|max:255',
    //         'email' => 'required|email|max:255|unique:users,email|unique:pending_transactions,email',
    //         'phone' => 'max:255',//OPTIONAL
    //     ]);


 


    // }
    


//     public function register_api(Request $request)
//     {
//         // dd($request->all());
        
//      // dd($request->firstname_);
//         $data                           = array();
//         $data['username']               = $request->username;
//         $data['firstname_']              = $request->firstname_;
//         $data['lastname']               = $request->lastname;
//         $data['email']                  = $request->email;
//         $data['phone']                  = '+'.$request->phone_code.$request->phone;
//         $data['dateofbirth']            = $request->dateofbirth;
//         $data['facebook_username']      = $request->facebook_username;
//         $data['WeChat_id']              = $request->WeChat_id;
//         $data['Instagram_Id']           = $request->Instagram_Id;
//         $data['tiktok_id']              = $request->tiktok_id;
//         $data['Shopee_Shop_Name']       = $request->Shopee_Shop_Name;
//         $data['Lazada_Shop_name']       = $request->Lazada_Shop_name;
//         $data['twitter_username']       = $request->twitter_username;
//         $data['youtube_username']       = $request->youtube_username;

//         $data['passport']               = $request->passport;
//         $data['file_name']              = $request->id_file;
//         // $data['file_name']              = $request->id_file;
//         $data['sponsor']                = $request->sponsor;
//         $data['password']               = $request->password;
//         $data['package']                = $request->package;
//         $data['product']                = $request->product_ids;
//         $data['product_details']        = $request->product;
//         $data['quantity']               = $request->quantity;
//         // $data['username']               = $request->country.$num_padded;
//         $data['counthidden']            = $request->counthidden;
//         $data['address']                = $request->address;
//         $data['address2']               = $request->address2;
//         $data['city']                   = $request->city;
//         $data['zip']                    = $request->zip;
//         $data['country']                = $request->country;
//         $data['state']                  = $request->state;
//         $data['bank_file']              = '';
//         // $data['placement_user']         = $request->placement_user;

//         $data['reg_by']                 = $request->payment;
//         $data['reg_type']               = $request->reg_type;
//         $data['cpf']                    = $request->cpf;
//         $data['gender']                 = $request->gender;
//         $data['location']               = $request->location;
//         $data['leg']                    = $request->leg;
//         $data['transaction_pass']       = $request->transaction_pass;
//         $data['confirmation_code']      = str_random(40);

//         $data['billing_firstname']      = $request->billing_firstname;
//         $data['billing_lastname']       = $request->billing_lastname;
//         $data['billing_address']        = $request->address;
//         $data['billing_address2']       = $request->address2;
//         $data['billing_city']           = $request->city;
//         $data['billing_zip']            = $request->zip;
//         $data['billing_country']        = $request->country;
//         $data['billing_state']          = $request->state;
//         $data['placement_user']         = $request->placement_user;
//         $data['payment_date']           = $request->date;

//         if(isset($request->shipping) && $request->shipping == 'yes'){
//             $data['shipping_firstname'] = $request->billing_firstname;
//             $data['shipping_lastname']  = $request->billing_lastname;
//             $data['shipping_address']   = $request->address;
//             $data['shipping_address2']  = $request->address2;
//             $data['shipping_city']      = $request->city;
//             $data['shipping_zip']       = $request->zip;
//             $data['shipping_country']   = $request->country;
//             $data['shipping_state']     = $request->state;

//         }
//         else{

//             $data['shipping_firstname'] = $request->shipping_firstname;
//             $data['shipping_lastname']  = $request->shipping_lastname;
//             $data['shipping_address']   = $request->shipping_address;
//             $data['shipping_address2']  = $request->shipping_address2;
//             $data['shipping_city']      = $request->shipping_city;
//             $data['shipping_zip']       = $request->shipping_zip;
//             $data['shipping_country']   = $request->shipping_country;
//             $data['shipping_state']     = $request->shipping_state;
//         }
        


//         $validator = $this->validator($data)->validate();



        


//         //  $validatedData = $request->validate([
//         // 'username' => 'required|unique:users|max:255',
//         // 'firstname' => 'required',
//         // 'sponsor'   => 'exists:users,username',
//         //  ]);


   

//         $sponsor_id = User::checkUserAvailable($data['sponsor']);
//         // dd($sponsor_id);
//         $user_registration = option('app.user_registration');
//         // dd($user_registration);
//         /**
//          * Checking if placement_user exist in users table
//          * @var [type]
//          */
//         $placement_id =  $sponsor_id ;// User::checkUserAvailable($data['placement_user']);
//         if (!$sponsor_id) {
//             /**
//              * If sponsor_id validates as false, redirect back without registering , with errors
//              */
//             return redirect()->back()->withErrors([trans('register.sponsor_not_exist')])->withInput();
//         }
//           $count = $data['counthidden'];
//           // dd($count);
//          if ($count > 2) {
             
            
//          return redirect()->back()->withErrors([trans('please select only two items! ')])->withInput();

//          }
     

//         $payment_gateway=PaymentGatewayDetails::find(1);
//         $prod_amount = Product::where('id',$data['product'])->value('price');
//         $joiningfee  = $prod_amount*$data['quantity'];
//         $orderid = mt_rand();

//         if ($request->payment == "rave") {
//             if ($joiningfee > 1000) {
//                   return redirect()->back()->withErrors([trans('register.the_amount_should_be_between_1_and_100_for_rave_payment')]);
//             }
//         }

//         if ($request->payment == "ewallet") {
//             $ewallet_user=User::where('username', $request->ewalletusername)->first();
//             if ($ewallet_user == null) {
//                 return redirect()->back()->withErrors(['The User doesnt exist']);
//             }
            
//             if ($request->ewallet_password <> $ewallet_user->transaction_pass) {
//                 return redirect()->back()->withErrors(['Transaction password is incorrect']);
//             }


//             $balance=Balance::where('user_id', $ewallet_user->id)->value('balance');
                 
//             if ($balance < $joiningfee && $ewallet_user->id > 1) {
//                 return redirect()->back()->withErrors(['Insufficient Balance']);
//             }
//         }

//             $bitaps_det = PendingTransactions::where('username', $request->username)
//                                                       ->where('payment_status', 'pending')
//                                                       ->where('payment_method', $request->payment)
//                                                       ->first();
            
//         if ($request->payment == 'bitaps' && $bitaps_det <> null) {
//             $register=$bitaps_det;
//         } else {
//             if (Input::hasFile('id_file')) {
//                 $destinationPath = public_path() . '/uploads/documents';
//                 $extension       = Input::file('id_file')->getClientOriginalExtension();
//                 $fileName        = rand(000011111, 99999999999) . '.' . $extension;
//                 Input::file('id_file')->move($destinationPath, $fileName);
//                 $data['file_name']              = $fileName;
//             }
//             else{
//                 $data['file_name']              = '';
//             }
//             if (Input::hasFile('id_file_back')) {
//                 $destinationPath = public_path() . '/uploads/documents';
//                 $extension       = Input::file('id_file_back')->getClientOriginalExtension();
//                 $fileName        = rand(000011111, 99999999999) . '.' . $extension;
//                 Input::file('id_file_back')->move($destinationPath, $fileName);
//                 $data['file_back']              = $fileName;
//             }
//             else{
//                 $data['file_back']              = '';
//             }
//             // if ($request->payment == 'bankwire') {
//             //     $validator = Validator::make($request->all(), [
//             //         'bank_file'        => 'required|mimes:jpeg,png,jpg'
//             //     ]);
//             //     if ($validator->fails())
//             //         return redirect()->back()->withErrors($validator)->withInput();

//             //     if(isset($request->bank_file) && !empty($request->bank_file)){
//             //         if (Input::hasFile('bank_file')) {
//             //             $destinationPath   = public_path() . '/uploads/documents';
//             //             $extension         = Input::file('bank_file')->getClientOriginalExtension();
//             //             $bank_file         = rand(000011111, 99999999999) . '.' . $extension;
//             //             Input::file('bank_file')->move($destinationPath, $bank_file);
//             //             $data['bank_file'] = $bank_file;
//             //         }
//             //     }
//             //     else{
//             //         Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('register.error_in_payment')));
//             //         return Redirect::to('admin/register');
//             //     }
//             //     $flag=true;
//             // }
            
//             $register=PendingTransactions::create([
//                  'order_id'       => $orderid,
//                  'username'       => $data['username'],
//                  'email'          => $data['email'],
//                  'sponsor'        => $data['sponsor'],
//                  'package'        => $data['package'],
//                  // 'invoice'        => $data['bank_file'],
//                  'request_data'   => json_encode($data),
//                  'payment_method' => $request->payment,
//                  'payment_code'   => $data['payment_date'],
//                  'payment_type'   =>'register',
//                  'payment_status' => 'complete'
                
//                  // 'amount'         => $joPendingTransactionsiningfee,
//                 ]);
          
//         }
      

     

//         if ($request->payment == 'stripe') {
//             try{
                
//                 Stripe::setApiKey(config('services.stripe.secret'));
//                 #create customer
//                 $customer=Customer::create([
//                   'email'   =>request('email'),
//                   'source'  =>request('stripeToken')
//                 ]);
//                 $id  = $customer->id;
//                 $fee = $joiningfee;
//                   #creating pament intend
//                 $data = array();
//                 $data['amount'] = $fee*100;
//                 $data['currency'] = 'USD';
//                 $data['setup_future_usage'] = 'off_session';
//                 $data['payment_method_types'][] = 'card';
//                 $data['customer'] = $id;
                   

//                 $url = 'https://api.stripe.com/v1/payment_intents';
//                 $key_secret = config('services.stripe.secret');
//                   //cURL Request
//                 $ch = curl_init();
//                   //set the url, number of POST vars, POST data
//                 curl_setopt($ch, CURLOPT_URL, $url);
//                 curl_setopt($ch, CURLOPT_USERPWD, $key_secret);
//                 curl_setopt($ch, CURLOPT_TIMEOUT, 60);
//                 curl_setopt($ch, CURLOPT_POST, 1);
                
//                 $params = http_build_query($data);
//                 curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
//                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
//                 $output = curl_exec ($ch);
//                 $intend_output = json_decode($output);
//                 $intend_id = $intend_output->id;

//                   #conforming payment_intent
//                 $data2 = array();
//                 $data2['payment_method'] = $customer->default_source;
//                 $url1 = 'https://api.stripe.com/v1/payment_intents/'.$intend_id.'/confirm';
//                   //cURL Request
//                 $ch1 = curl_init();
//                   //set the url, number of POST vars, POST data
//                 curl_setopt($ch1, CURLOPT_URL, $url1);
//                 curl_setopt($ch1, CURLOPT_USERPWD, $key_secret);
//                 curl_setopt($ch1, CURLOPT_TIMEOUT, 60);
//                 curl_setopt($ch1, CURLOPT_POST, 1);
//                 $params1 = http_build_query($data2);
//                 curl_setopt($ch1, CURLOPT_POSTFIELDS, $params1);
//                 curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
//                 curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, true);
//                 $output2 = curl_exec ($ch1);
//                 $Charge = json_decode($output2);

//                 $stripedetails = stripeCustomer::create([
//                                  'user_id'     => $sponsor_id,
//                                  'customer_id' => $customer->id,
//                                  'amount'      => $fee,
//                                  'package_id'  => 1,
//                                  'category_id' => 1,
//                                  'country_id'  => $intend_id,
//                                  'currency'    => 'USD',
//                                  'source'      => $customer->default_source,
//                                  'stripe_id'   => json_encode($Charge,true)
//                 ]);

//                 if(isset($Charge->error))
//                 {
//                   Session::flash('flash_notification', array('level' => 'warning', 'message' => "Some error occur, sorry for inconvenient"));
//                   return redirect()->back()->withErrors('Some error occur, sorry for inconvenient');
//                 }
//                 PendingTransactions::where('id', $register->id)->update(['payment_status' => 'complete']) ;
//                 $flag=true;
//             }

//             catch(\Stripe\Error\Card $e) {
//                 $body = $e->getJsonBody();
//                 $err  = $body['error'];

//                 echo 'Status is:' . $e->getHttpStatus() . "\n" ;
//                 echo 'Type is:' . $err['type'] . "\n" ;
//                 echo 'Code is:' . $err['code'] . "\n" ;die();

//             } catch (Stripe_InvalidRequestError $e) {
//                 return redirect()->back();
//             } catch (Stripe_AuthenticationError $e) {
//               return redirect()->back();
//             } catch (Stripe_ApiConnectionError $e) {
//                return redirect()->back();
//             } catch (Stripe_Error $e) {
//                return redirect()->back();
//             } catch (Exception $e) {
//                return redirect()->back();
//             }
//         }
//         if ($request->payment == 'cheque') {
//             if ($user_registration <> 6) {
//                  PendingTransactions::where('id', $register->id)->update(['payment_status' => 'complete']) ;
//                  $flag=true;
//             } else {
//                    $flag=true;
//             }
//         }
//         if ($request->payment == 'senangpay') {

//                 $senag_data=payout_gateway_details::select('merchant_id','secret_key')
//                             ->where('id',1)->first();
//                 $merchant_id=$senag_data->merchant_id;
//                 $secretkey=$senag_data->secret_key;
//                 $joiningfee=$joiningfee;
//                 $orderidd=$orderid;
//                 return view('auth.senangpayPaymentPage',compact('joiningfee','orderidd','merchant_id','secretkey'));
//             }

//         //     /**
//         //      * If request contains payment mode paypal, application will handle the payment process
//         //      * @var [string]
//         //      */
//         if ($request->payment == 'paypal') {
//                  Session::put('paypal_id', $register->id);

//                  $data = [];
//                  $data['items'] = [
//                      [
//                          'name' => Config('APP_NAME'),
//                          'price' => $joiningfee,
//                          'qty' => 1
//                      ]
//                  ];

//                  $data['invoice_id'] = time();
//                  $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
//                  $data['return_url'] = url('/paypal/success', $register->id);
//                  $data['cancel_url'] = url('register');

//                  $total = 0;
//                  foreach ($data['items'] as $item) {
//                      $total += $item['price']*$item['qty'];
//                  }

//                  $data['total'] = $total;

//                  $response = self::$provider->setExpressCheckout($data);
//                  PendingTransactions::where('id', $register->id)
//                                      ->update(['payment_data' => json_encode($response),'paypal_express_data' => json_encode($data)]);
                 
//                  return redirect($response['paypal_link']);
//         }

     
//             /**
//              * If request has payment mode as voucher, will check against the vouchers for validation
//              * @var [type]
//              */

        

           
//         if ($request->payment == 'skrill') {
//                 echo '  <form id="skrill" action="https://pay.skrill.com" method="post" > 
//                          <input type="hidden" name="pay_to_email" value="'.$payment_gateway->skrill_mer_email.'">
//                         <input type="hidden" name="return_url" value="'.url('skrill/success', $register->id).'" >
//                         <input type="hidden" name="status_url" value="'.url('skrill-status', $register->id).'">
//                         <input type="hidden" name="language" value="EN">
//                         <input type="hidden" name="amount" value="'.$joiningfee.'">
//                         <input type="hidden" name="currency" value="USD">

//                         <input type="hidden" name="pay_from_email" value="'.$request->email.'">
//                         <input type="hidden" name="firstname" value="'.$request->firstname.'">
//                         <input type="hidden" name="lastname" value="'.$request->lastname.'">

//                         <input type="hidden" name="rec_amount" value="'.$joiningfee.'">
//                         <input type="hidden" name="rec_start_date" value="'.date('d/m/Y', strtotime('+30 days')).'">
//                         <input type="hidden" name="rec_end_date" value="'.date('d/m/Y', strtotime('+20 years')).'">
//                         <input type="hidden" name="rec_period" value="1">
//                         <input type="hidden" name="rec_cycle" value="month">
//                         <input type="hidden" name="rec_status_url" value="'.url('rec-skrill-status').'">
//                         <input type="hidden" name="rec_status_url2" value="'.url('rec-skrill-status2').'">


//                         <input type="hidden" name="detail1_description" value="Description:'.Config('APP_NAME').'">
//                         <input type="hidden" name="detail1_text" value="'.Config('APP_NAME') .' : Subscription payment ">
//                          ';
//             echo '  </form>';

//             echo '  <script type="text/javascript">';
//             echo "   document.forms['skrill'].submit()";
//             echo '  </script>';

//             die();
//         }

//         if($request->payment == 'bankwire'){
//         Session::flash('flash_notification', array('message'=> 'Your registration Successful!.','level'=>'success'));


//         // $id = bcrypt($register->id);
//         //         $id = $register->id;
//         //         $crypt_id = Crypt::encrypt($id);

//         // return redirect('purchase/pending/'. $crypt_id);


  
//         }
//             // $purchase_id=$register->id;
//             // $reg_type=$user_registration;
//             // return view('auth.regcomplete', compact('purchase_id', 'reg_type'));
         
//             return redirect()->back();
    

// }

}
