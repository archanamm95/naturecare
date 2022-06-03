<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Country;
use App\Voucher;
use App\Settings;
use App\Tree_Table;
use App\Sponsortree;
use App\PointTable;
use App\Ranksetting;
use App\Commission;
use App\Packages;
use App\PointHistory;
use App\Sales;
use App\Emails;
use App\AppSettings;
use App\Balance;
use App\RegisterPoint;
use App\UserDebit;
use App\RsHistory;
use App\LeadershipBonus;
use App\DirectSposnor;
use App\Codes;
use App\TempDetails;
use App\PaymentType;
use App\ProfileInfo;
use App\PurchaseHistory;
use App\stripeCustomer;
use App\ShoppingCountry;
use App\ShoppingZone;
use App\PaymentGatewayDetails;
use App\payout_gateway_details;
use App\PendingTransactions;
use App\VoucherHistory;
use App\Product;
use Response;
use App\Welcome;
use Mail;
use DB;
use Crypt;
use Session;
use Validator;
use Auth;
use App\MenuSettings;
use Redirect;
use CountryState;
use App\Activity;
use App\PaypalDetails;
use App\Http\Controllers\user\UserAdminController;
use Input;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Account;
use Stripe\Token;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Models\ControlPanel\Options;
use Rave;



use App\Jobs\SendEmail;

class RegisterController extends UserAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
          private $api_context;
    protected static $provider;
/**
** We declare the Api context as above and initialize it in the contructor
**/
    public function __construct()
    {
         parent::__construct();
         self::$provider = new ExpressCheckout;
    }
    public function index($placement_id = null)
    {


        $title     = trans('all.register');
        $sub_title = trans('all.register');
        $base   = trans('all.register');
        $method = trans('all.register');
        $placementcheck = 0;
            /**
             * Get Countries from mmdb
             * @var [collection]
             */
        $countries = CountryState::getCountries();
            /**
             * [Get States from mmdb]
             * @var [collection]
             */
            $states = CountryState::getStates('MY');
              $user_registration = option('app.user_registration');

        $status=MenuSettings::find(1);
        if ($user_registration == 1 || $user_registration == 3 || $user_registration == 4) {
            Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('register.permission_denied')));
            return Redirect::to('user\dashboard');
        } else {
            if ($placement_id) {
                $placementcheck = 1;
                $placement_id = Crypt::decrypt($placement_id);
           
                $place_details = Tree_Table::find($placement_id);

                if ($place_details->type <> 'vaccant') {
                    return redirect()->back();
                }
                $placementdata = User::find($place_details->placement_id);
                $placement_user = $placementdata->username;
                $vaccant_count  = count(Tree_Table::where('placement_id', $place_details->placement_id)->where("type","vaccant")->get());
                $leg = $place_details->leg;
            } else {
                $placement_id   = Tree_Table::getSponsorVaccantId([Auth::user()->id]);
                $vaccant_count  = count(Tree_Table::where('placement_id', $placement_id)->where("type","vaccant")->get());
                $placement_id   = Tree_Table::where('placement_id', $placement_id)->where("type","vaccant")->value('id');
                $tree_data      = Tree_Table::find($placement_id);
                $placementdata  = User::find($tree_data->placement_id);
                $placement_user = User::where('id', $tree_data->placement_id)->value('username');
                $leg            = $tree_data->leg;
            }
            $user_details = array();
            $user_details = User::where('username', Auth::user()->username)->get();
            $title = "Register new member";
            $rules = ['sponsor' => 'required|min:5','username' => 'unique:users,username|required|min:5','email' => 'unique:users,email|required','password' => 'required|same:password_confirmation'];
            $country = Country::all();
            $package = Packages::all();
            $joiningfee = Settings::value('joinfee');
            $voucher_code=Voucher::pluck('voucher_code');
            $payment_type=PaymentType::where('status', 'yes')->where('id','!=',7)->get();
            $payment_gateway=PaymentGatewayDetails::find(1);
            $transaction_pass=self::RandomString();
            $shipping_countries = ShoppingCountry::all();
            $shipping_states = ShoppingZone::where('country_id', '=', 129)->get();
            $product = Product::first();

            return view('app.user.register.index', compact('title', 'sub_title', 'base', 'method', 'rules', 'country', 'countries', 'states', 'user_details', 'package', 'placement_user', 'leg', 'joiningfee', 'voucher_code', 'payment_type', 'transaction_pass', 'shipping_countries', 'shipping_states', 'payment_gateway','product','vaccant_count','placementcheck','placementdata'));
        }
    }
    public function register(Request $request)
    {

        // $userCount  = PendingTransactions::where('username','like',$request->country.'%')->count();
        // $userCount  = $userCount+1;
        // $num_padded = sprintf("%06d", $userCount);
        $num_padded  = rand(10,99);

        $prod_bv   = Product::find($request->product)->value('bv');
        $total_bv  = $prod_bv * $request->quantity;
        $pack_id   = Packages::where('pv','>',$total_bv)->value('id');
        if($pack_id){
            $package = $pack_id-1;
        }
        else{
            $max_pv  = Packages::max('pv');
            $package = Packages::where('pv',$max_pv)->value('id');
        }

        if(!empty($request->bank_file) &&  $package >1)
            $request->payment = 'bankwire';

        $data                           = array();
        $data['firstname']              = $request->firstname;
        $data['lastname']               = $request->lastname;
        $data['email']                  = $request->email;
        $data['phone']                  = '+'.$request->phone_code.$request->phone;
        $data['passport']               = $request->passport;
        $data['file_name']              = $request->id_file;
        $data['file_back']              = $request->id_file_back;
        $data['sponsor']                = $request->sponsor;
        $data['password']               = $request->password;
        $data['package']                = $package;
        $data['product']                = $request->product;
        $data['quantity']               = $request->quantity;
        $data['username']               = $request->country.$num_padded;
        $data['address']                = $request->address;
        $data['address2']               = $request->address2;
        $data['city']                   = $request->city;
        $data['zip']                    = $request->zip;
        $data['country']                = $request->country;
        $data['state']                  = $request->state;
        $data['bank_file']              = '';
        $data['placement_user']         = $request->placement_user;

        $data['reg_by']                 = $request->payment;
        $data['reg_type']               = $request->reg_type;
        $data['cpf']                    = $request->cpf;
        $data['gender']                 = $request->gender;
        $data['location']               = $request->location;
        $data['leg']                    = $request->leg;
        $data['transaction_pass']       = $request->transaction_pass;
        $data['confirmation_code']      = str_random(40);

        $data['billing_firstname']      = $request->billing_firstname;
        $data['billing_lastname']       = $request->billing_lastname;
        $data['billing_address']        = $request->address;
        $data['billing_address2']       = $request->address2;
        $data['billing_city']           = $request->city;
        $data['billing_zip']            = $request->zip;
        $data['billing_country']        = $request->country;
        $data['billing_state']          = $request->state;
        $data['payment_date']           = $request->date;

        if(isset($request->shipping) && $request->shipping == 'yes'){
            $data['shipping_firstname'] = $request->billing_firstname;
            $data['shipping_lastname']  = $request->billing_lastname;
            $data['shipping_address']   = $request->address;
            $data['shipping_address2']  = $request->address2;
            $data['shipping_city']      = $request->city;
            $data['shipping_zip']       = $request->zip;
            $data['shipping_country']   = $request->country;
            $data['shipping_state']     = $request->state;

        }
        else{
            $data['shipping_firstname'] = $request->shipping_firstname;
            $data['shipping_lastname']  = $request->shipping_lastname;
            $data['shipping_address']   = $request->shipping_address;
            $data['shipping_address2']  = $request->shipping_address2;
            $data['shipping_city']      = $request->shipping_city;
            $data['shipping_zip']       = $request->shipping_zip;
            $data['shipping_country']   = $request->shipping_country;
            $data['shipping_state']     = $request->shipping_state;
        }

        if ($data['placement_user'] != null) {
            $data['placement_user'] = $data['placement_user'];
        } else {
            $data['placement_user'] = $data['sponsor'];
        }
        $messages = [
            'unique'    => 'The :attribute already existis in the system',
            'exists'    => 'The :attribute not found in the system',
        ];
        $validator = Validator::make($data, [
            'sponsor' => 'required|exists:users,username|max:255',
            'placement_user' => 'sometimes|exists:users,username|max:255',
            'email' => 'required|unique:pending_transactions,email|unique:users,email|email|max:255',
            'username' => 'required|alpha_num|max:255',
            'password' => 'required|min:6',
            'transaction_pass' => 'required|alpha_num|min:6',
            'package'          => 'required|exists:packages,id',
            // 'leg'              => 'required',
            'country'          => 'required|country',
            'file_name'        => 'required|mimes:jpeg,png,jpg'
            ]);

        if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
        } else {
            if ($request->payment == "ewallet") {
                if ($request->ewalletusername == null ||$request->ewallet_password == null) {
                    return redirect()->back()->withErrors(['The ewalletusername and password required']);
                }
            }

            
               /**
             * Checking if sponsor_id exist in users table
             * @var [boolean]
             */
            $sponsor_id = User::checkUserAvailable($data['sponsor']);
            /**
             * Checking if placement_user exist in users table
             * @var [type]
             */
             $placement_id = User::where('username', $data['placement_user'])->value('id') ;// User::checkUserAvailable($data['placement_user']);
            if (!$sponsor_id) {
                /**
                 * If sponsor_id validates as false, redirect back without registering , with errors
                 */
                return redirect()->back()->withErrors([trans('register.username_not_exist')])->withInput();
            }
            if (!$placement_id) {
                /**
                 * If placement_id validates as false, redirect back without registering , with errors
                 */
                return redirect()->back()->withErrors([trans('register.username_not_exist')])->withInput();
            }


            $payment_gateway=PaymentGatewayDetails::find(1);
            $prod_amount = Product::where('id',$data['product'])->value('price');
            $joiningfee  = $prod_amount*$data['quantity'];
            $orderid = mt_rand();
            $flag=false;

            if ($request->payment == "rave") {
                if ($joiningfee > 1000) {
                    return redirect()->back()->withErrors([trans('register.the_amount_should_be_between_1_and_100_for_rave_payment')]);
                }
            }


            if ($request->payment == "ewallet") {
                $ewallet_user=User::where('username', $request->ewalletusername)->first();
                if ($ewallet_user == null) {
                    return redirect()->back()->withErrors(['The User doesnt exist']);
                }
            
                if ($request->ewallet_password <> $ewallet_user->transaction_pass) {
                    return redirect()->back()->withErrors(['Transaction password is incorrect']);
                }


                $balance=Balance::where('user_id', $ewallet_user->id)->value('balance');
                 
                if ($balance < $joiningfee && $ewallet_user->id > 1) {
                    return redirect()->back()->withErrors(['Insufficient Balance']);
                }
            }

            if (Input::hasFile('id_file')) {
                $destinationPath = public_path() . '/uploads/documents';
                $extension       = Input::file('id_file')->getClientOriginalExtension();
                $fileName        = rand(000011111, 99999999999) . '.' . $extension;
                Input::file('id_file')->move($destinationPath, $fileName);
                $data['file_name']              = $fileName;
            }
            else{
                $data['file_name']              = '';
            }
            if (Input::hasFile('id_file_back')) {
                $destinationPath = public_path() . '/uploads/documents';
                $extension       = Input::file('id_file_back')->getClientOriginalExtension();
                $fileName        = rand(000011111, 99999999999) . '.' . $extension;
                Input::file('id_file_back')->move($destinationPath, $fileName);
                $data['file_back']              = $fileName;
            }
            else{
                $data['file_back']              = '';
            }
            if ($request->payment == 'bankwire') {
                $validator = Validator::make($request->all(), [
                    'bank_file'        => 'required|mimes:pdf,doc,docx,jpeg,png,jpg'
                ]);
                if ($validator->fails())
                    return redirect()->back()->withErrors($validator)->withInput();

                if(isset($request->bank_file) && !empty($request->bank_file)){
                    if (Input::hasFile('bank_file')) {
                        $destinationPath   = public_path() . '/uploads/documents';
                        $extension         = Input::file('bank_file')->getClientOriginalExtension();
                        $bank_file         = rand(000011111, 99999999999) . '.' . $extension;
                        Input::file('bank_file')->move($destinationPath, $bank_file);
                        $data['bank_file'] = $bank_file;
                    }
                }
                else{
                    Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('register.error_in_payment')));
                    return Redirect::to('admin/register');
                }
                $flag=true;
            }

            $register=PendingTransactions::create([
                     'order_id'       => $orderid,
                     'username'       => $data['username'],
                     'email'          => $data['email'],
                     'sponsor'        => $data['sponsor'],
                     'package'        => $data['package'],
                     'invoice'        => $data['bank_file'],
                     'request_data'   => json_encode($data),
                     'payment_method' => $request->payment,
                     'payment_code'   => $data['payment_date'],
                     'payment_type'   =>'register',
                     'amount'         => $joiningfee,
                    ]);

            if ($request->payment == 'stripe') {
                try{
                    
                    Stripe::setApiKey(config('services.stripe.secret'));
                    #create customer
                    $customer=Customer::create([
                      'email'   =>request('email'),
                      'source'  =>request('stripeToken')
                    ]);
                    $id  = $customer->id;
                    $fee = $joiningfee;
                      #creating pament intend
                    $data = array();
                    $data['amount'] = $fee*100;
                    $data['currency'] = 'USD';
                    $data['setup_future_usage'] = 'off_session';
                    $data['payment_method_types'][] = 'card';
                    $data['customer'] = $id;
                       

                    $url = 'https://api.stripe.com/v1/payment_intents';
                    $key_secret = config('services.stripe.secret');
                      //cURL Request
                    $ch = curl_init();
                      //set the url, number of POST vars, POST data
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_USERPWD, $key_secret);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    
                    $params = http_build_query($data);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
                    $output = curl_exec ($ch);
                    $intend_output = json_decode($output);
                    $intend_id = $intend_output->id;

                      #conforming payment_intent
                    $data2 = array();
                    $data2['payment_method'] = $customer->default_source;
                    $url1 = 'https://api.stripe.com/v1/payment_intents/'.$intend_id.'/confirm';
                      //cURL Request
                    $ch1 = curl_init();
                      //set the url, number of POST vars, POST data
                    curl_setopt($ch1, CURLOPT_URL, $url1);
                    curl_setopt($ch1, CURLOPT_USERPWD, $key_secret);
                    curl_setopt($ch1, CURLOPT_TIMEOUT, 60);
                    curl_setopt($ch1, CURLOPT_POST, 1);
                    $params1 = http_build_query($data2);
                    curl_setopt($ch1, CURLOPT_POSTFIELDS, $params1);
                    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, true);
                    $output2 = curl_exec ($ch1);
                    $Charge = json_decode($output2);

                    $stripedetails = stripeCustomer::create([
                                     'user_id'     => Auth::user()->id,
                                     'customer_id' => $customer->id,
                                     'amount'      => $fee,
                                     'package_id'  => 1,
                                     'category_id'  => 1,
                                     'country_id'  => $intend_id,
                                     'currency'    => 'USD',
                                     'source'      => $customer->default_source,
                                     'stripe_id'   => json_encode($Charge,true)
                    ]);

                    if(isset($Charge->error))
                    {

                      Session::flash('flash_notification', array('level' => 'warning', 'message' => "Some error occur, sorry for inconvenient"));
                      return redirect()->back()->withErrors('Some error occur, sorry for inconvenient');
                    }
                    PendingTransactions::where('id', $register->id)->update(['payment_status' => 'complete']) ;
                    $flag=true;
                }

                catch(\Stripe\Error\Card $e) {
                    $body = $e->getJsonBody();
                    $err  = $body['error'];

                    echo 'Status is:' . $e->getHttpStatus() . "\n" ;
                    echo 'Type is:' . $err['type'] . "\n" ;
                    echo 'Code is:' . $err['code'] . "\n" ;die();

                } catch (Stripe_InvalidRequestError $e) {
                    return redirect()->back();
                } catch (Stripe_AuthenticationError $e) {
                  return redirect()->back();
                } catch (Stripe_ApiConnectionError $e) {
                   return redirect()->back();
                } catch (Stripe_Error $e) {
                   return redirect()->back();
                } catch (Exception $e) {
                   return redirect()->back();
                }
            }
            if ($request->payment == "register_point") {
                $balance=Balance::where('user_id', $sponsor_id)->value('register_point');
                if ($sponsor_id == 1) {
                    PendingTransactions::where('id', $register->id)->update(['payment_status' => 'complete']) ;
                    $flag=true;
                }
                $userProduct = Product::find($data['product']);
                $targetbv    = $userProduct->bv * $data['quantity'];

                if ($balance>=$targetbv && $sponsor_id > 1) { 
                    RegisterPoint::create([
                        'user_id'       =>  $sponsor_id,
                        'product_id'    =>  $data['product'],
                        'order_id'      =>  0,
                        'bv'            =>  $targetbv,
                        'count'         =>  $data['quantity'],
                        'total_amount'  =>  $targetbv,
                        'type'          =>  'debit',
                    ]);
                    Balance::where('user_id', $sponsor_id)->decrement('register_point', $targetbv);
              
                    PendingTransactions::where('id', $register->id)->update(['payment_status' => 'complete']) ;
                    $flag=true;
                }
            }
            if ($request->payment == 'senangpay') {

                $senag_data=payout_gateway_details::select('merchant_id','secret_key')
                            ->where('id',1)->first();
                $merchant_id=$senag_data->merchant_id;
                $secretkey=$senag_data->secret_key;
                $joiningfee=$joiningfee;
                $orderidd=$orderid;
                return view('auth.senangpayPaymentPage',compact('joiningfee','orderidd','merchant_id','secretkey'));
            }

            if ($request->payment == 'cheque') {
                PendingTransactions::where('id', $register->id)->update(['payment_status' => 'complete']) ;
                $flag=true;
            }
            if ($request->payment == "ewallet") {
                $balance=Balance::where('user_id', $ewallet_user->id)->value('balance');
                if ($ewallet_user->id == 1) {
                    PendingTransactions::where('id', $register->id)->update(['payment_status' => 'complete']) ;
                    $flag=true;
                }
                if ($balance>=$joiningfee && $ewallet_user->id > 1) {
                    Balance::where('user_id', $ewallet_user->id)->decrement('balance', $joiningfee);
                    Commission::create([
                      'user_id'=>$ewallet_user->id,
                      'from_id'=>1,
                      'total_amount'=>$joiningfee*-1,
                      'payable_amount'=>$joiningfee*-1,
                      'payment_type'=>'register',
                      'note'           => 'register',
                      ]);
                  
                    PendingTransactions::where('id', $register->id)->update(['payment_status' => 'complete']) ;
                    $flag=true;
                }
            }
          

            /**
             * If request contains payment mode paypal, application will handle the payment process
             * @var [string]
             */
            if ($request->payment == 'paypal') {
                    Session::put('paypal_id', $register->id);

                    $data = [];
                    $data['items'] = [
                        [
                            'name' => Config('APP_NAME'),
                            'price' => $joiningfee,
                            'qty' => 1
                        ]
                    ];

                    $data['invoice_id'] = time();
                    $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
                    $data['return_url'] = url('/user/paypal/success', $register->id);
                    $data['cancel_url'] = url('register');

                    $total = 0;
                    foreach ($data['items'] as $item) {
                        $total += $item['price']*$item['qty'];
                    }

                    $data['total'] = $total;

                    $response = self::$provider->setExpressCheckout($data);
                    PendingTransactions::where('id', $register->id)
                                        ->update(['payment_data' => json_encode($response),'paypal_express_data' => json_encode($data)]);
                    return redirect($response['paypal_link']);
            }

            if ($request->payment == 'bitaps') {
                $title=trans('register.bitaps_payment');
                $sub_title=trans('register.bitaps_payment');
                $base=trans('register.bitaps_payment');
                $method=trans('register.bitaps_payment');

            
                $url ='https://api.bitaps.com/btc/v1//create/payment/address' ;
                $payment_details = $this->url_get_contents($url, [
                                                'forwarding_address'=>$payment_gateway->btc_address,
                                                'callback_link'=>url('bitaps/paymentnotify'),
                                                'confirmations'=>3
                                            ]);

                  $conversion = $this->url_get_contents('https://api.bitaps.com/market/v1/ticker/btcusd', false);

                  $package_amount = $joiningfee/$conversion->data->last;
                   $package_amount=round($package_amount, 8);

                  $trans_id=$register->id;

                 PendingTransactions::where('id', $register->id)->update(['payment_code'=>$payment_details->payment_code,'invoice'=>$payment_details->invoice,'payment_address'=>$payment_details->address,'payment_data'=>json_encode($payment_details)]);

                 return view('app.user.register.bitaps', compact('title', 'sub_title', 'base', 'method', 'payment_details', 'data', 'package_amount', 'setting', 'trans_id'));
            }
            
            /**
             * If request has payment mode as voucher, will check against the vouchers for validation
             * @var [type]
             */

            if ($request->payment == 'rave') {
                $rave_call= Rave::initialize(url('user/ravecallback'));
                $pay_data=json_decode($rave_call, true);

                PendingTransactions::where('id', $register->id)->update(['rave_ref_id' =>$pay_data['txref'],'payment_data' => json_encode($rave_call)]);
                die();
            }
            if ($request->payment == 'voucher') {
                $voucher_total = $joiningfee;
                $flag = false ;
                foreach ($request->voucher as $key => $vouchervalue) {
                        if($vouchervalue == null ){  
                             $voucher = Voucher::where('voucher_code', $vouchervalue)->first();
                            $voucher_total= $voucher_total-$voucher->balance_amount ;
                        }                       
                        
                         
                        if ($voucher_total <=0) {
                            $flag = true;
                        }
                }
                  // dd("Asd");

                if ($flag) {
                     $package_amount = $joiningfee;
                    foreach ($request->voucher as $key => $vouchervalue) {
                     // echo "2<br>";
                     //  echo "voucher".$vouchervalue."<br>";
                        $voucher = Voucher::where('voucher_code', $vouchervalue)->first();
                        if ($package_amount > $voucher->balance_amount) {
                                $package_amount = $package_amount -  $voucher->balance_amount ;
                                $used_amount =  $voucher->balance_amount;
                                $voucher->balance_amount = 0 ;
                                $voucher->save();
                        } else {
                                $used_amount =  $voucher->balance_amount - $package_amount;
                                $voucher->balance_amount = $used_amount;
                                $voucher->save();
                        }
                    }
                      // dd("asdf");
                }
            }
            if ($request->payment == 'voucher' && $flag ==true) {
                foreach ($request->voucher as $key => $vouchervalue) {
                    // echo "3<br>";
                               
                      // echo "voucher".$vouchervalue."<br>";
                       $used_total=VoucherHistory::where('voucher_id', '=', $vouchervalue)->value('used_amount');
                    if (isset($used_total)) {
                        // echo "1st";
                        $total = Voucher::where('voucher_code', $vouchervalue)->value('total_amount');
                        $amount = $total-$used_total;
                    } else {
                        // echo "2nd";
                        $balence = Voucher::where('voucher_code', $vouchervalue)->value('balance_amount');
                        $total = Voucher::where('voucher_code', $vouchervalue)->value('total_amount');
                        $amount=$total -$balence;
                    }
                         // echo "amount".$amount."<br>";
                         
                        VoucherHistory::create([
                        'voucher_id'=>$vouchervalue,
                        'used_by'=>Auth::user()->id,
                        'used_for'=> "Registration",
                        'used_amount'=>$amount,
                         ]) ;
                }

                    PendingTransactions::where('id', $register->id)->update(['payment_status' => 'complete']);
                    // dd("Ad");
            }
            if ($request->payment == 'skrill') {
                echo '  <form id="skrill" action="https://pay.skrill.com" method="post" > 
                     <input type="hidden" name="pay_to_email" value="'.$payment_gateway->skrill_mer_email.'">
                    <input type="hidden" name="return_url" value="'.url('user/skrill/success', $register->id).'" >
                    <input type="hidden" name="status_url" value="'.url('user/skrill-status', $register->id).'">
                    <input type="hidden" name="language" value="EN">
                    <input type="hidden" name="amount" value="'.$joiningfee.'">
                    <input type="hidden" name="currency" value="USD">

                    <input type="hidden" name="pay_from_email" value="'.$request->email.'">
                    <input type="hidden" name="firstname" value="'.$request->firstname.'">
                    <input type="hidden" name="lastname" value="'.$request->lastname.'">

                    <input type="hidden" name="rec_amount" value="'.$joiningfee.'">
                    <input type="hidden" name="rec_start_date" value="'.date('d/m/Y', strtotime('+30 days')).'">
                    <input type="hidden" name="rec_end_date" value="'.date('d/m/Y', strtotime('+20 years')).'">
                    <input type="hidden" name="rec_period" value="1">
                    <input type="hidden" name="rec_cycle" value="month">
                    <input type="hidden" name="rec_status_url" value="'.url('rec-skrill-status').'">
                    <input type="hidden" name="rec_status_url2" value="'.url('rec-skrill-status2').'">


                    <input type="hidden" name="detail1_description" value="Description:'.Config('APP_NAME').'">
                    <input type="hidden" name="detail1_text" value="'.Config('APP_NAME') .' : Subscription payment ">
                     ';
                echo '  </form>';

                echo '  <script type="text/javascript">';
                echo "   document.forms['skrill'].submit()";
                echo '  </script>';

                die();
            }

            if ($request->payment == 'ipaygh') {
                echo '<form id="ipaygh" method=POST action="https://community.ipaygh.com/gateway">
                        <input type=hidden name=merchant_key value="'.$payment_gateway->ipaygh_merchant_key.'" />
                        <input type=hidden name=invoice_id value="'.$orderid.'" />
                        <input type=hidden name=success_url value="'.url('user/paymentnotify/success/'.$register->id, $orderid).'" />
                        <input type=hidden name=cancelled_url value="'.url('user/paymentnotify/canceled/'.$register->id, $orderid).'" />
                        <input type=hidden name=deferred_url value="'.url('user/paymentnotify/success/'.$register->id, $orderid).'" />
                        <input type=hidden name=ipn_url value="'.url('user/paymentnotify/ipn').'" />
                        <input type=hidden name=currency value="GHS" />
                        <input type=hidden name=total value="16" /> 
                    </form>';

                echo '  <script type="text/javascript">';
                echo "  document.forms['ipaygh'].submit()  ";
                echo '  </script>';

                die();
            }

            if ($request->payment == 'authorize') {
                $expiry = date('Y-m', strtotime($request->year.'-'.$request->month));
                $amount = Packages::where('id', $request->package)->value('amount') ;
                $invoice = time() ;
                $responsechargecard = AuthorizePaymentModel::chargeCreditCard($expiry, $fee, $invoice, $request) ;
                if (!$responsechargecard) {
                    return redirect('register');
                }
                $item->paypal_recurring_responce = $responsechargecard->getSubscriptionId() ;
                $item->save();
            }

            if ($flag) {
               if($request->payment == 'bankwire'){
                    Session::flash('flash_notification', array('message'=> 'Your registration Successful! Your bankwire transaction approval will takes 1-3 business days.','level'=>'success'));
                    return redirect()->back();
                }
                $title=trans('register.payment_complete');
                $sub_title=trans('register.payment_complete');
                $base=trans('register.payment_complete');
                $method=trans('register.payment_complete');
                $purchase_id=$register->id;
                return view('app.user.register.regcomplete', compact('title', 'sub_title', 'base', 'method', 'purchase_id'));
            } else {
                Session::flash('flash_notification', array('message'=>trans('register.payment_failure'),'level'=>'danger'));
                return redirect()->back();
            }
        }
    }
    public function paypalReg(Request $request)
    {

        $payment_id = Session::get('paypal_payment_id');
        $temp_data=PaypalDetails::where('token', '=', $payment_id)->first();
        $data=json_decode($temp_data->regdetails, true);
        
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('register.payment_failure')));

             return redirect("user/register");
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        $result = $payment->execute($execution, $this->_api_context);
        
        if ($result->getState() == 'approved') {
            $sponsor_id = User::checkUserAvailable($data['sponsor']);
            $placement_id =  User::checkUserAvailable($data['placement_user']);

            $userresult = User::add($data, $sponsor_id, $placement_id);
            if (!$userresult) {
                return redirect('user/register')->withErrors(['Opps something went wrong'])->withInput();
            }
             $userPackage = Packages::find($data['package']);
            $sponsorname = $userresult->sponsor ? $userresult->sponsor : Auth::user()->username;
            $placement_username = User::find($placement_id)->username;
            $legname = $data['leg'] == "L" ? "Left" : "right";
            Activity::add("Added user $userresult->username", "Added $userresult->username sponsor as $sponsorname and placement user as $placement_username in $legname Leg");
            Activity::add("Joined as $userresult->username", "Joined in system as $userresult->username sponsor as $sponsorname and placement user as $placement_username in $legname Leg", $userresult->id);
            // Activity::add("Package purchased", "Purchased package - $userPackage->package ", $userresult->id);
            $email = Emails::find(1);
            $app_settings = AppSettings::find(1);
            $setting=Welcome::first();
            //dd($setting);
            Mail::send(
                'emails.register',
                ['email'         => $email,
                    'company_name'   => $app_settings->company_name,
                    'firstname'      => $data['firstname'],
                    'name'           => $data['lastname'],
                    'login_username' => $data['username'],
                    'password'       => $data['password'],
                    'content'=>$setting->body,
                ],
                function ($m) use ($data, $email, $setting) {
                    $m->to($data['email'], $data['firstname'])->subject($setting->subject)->from($email->from_email, $email->from_name);
                }
            );
            return redirect("user/register/preview/" . Crypt::encrypt($userresult->id));
        }
        Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('register.payment_failure')));
        return redirect("user/register");
    }
    public function RandomString()
    {
                $characters = "23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
                $charactersLength = strlen($characters);
                $randstring = '';
        for ($i = 0; $i < 11; $i++) {
            $randstring .= $characters[rand(0, $charactersLength - 1)];
        }
                return $randstring;
    }
    public function data(Request $request)
    {
                $key = $request->key;
        if (isset($key)) {
            $voucher = $request->voucher ;
            $vocher=Voucher::where('voucher_code', $key)->get();
            return Response::json($vocher);
        }
    }
    public function preview($idencrypt)
    {
        $title     = trans('register.registration');
        $sub_title = trans('register.preview');
        $method    = trans('register.preview');
        $base      = trans('register.preview');
   
        $userresult      = User::with(['profile_info', 'profile_info.package_detail', 'sponsor_tree', 'tree_table', 'purchase_history.package'])->find(Crypt::decrypt($idencrypt));


        $userCountry = $userresult->profile_info->country;
        if ($userCountry) {
            $countries = CountryState::getCountries();
            $country   = array_get($countries, $userCountry);
        } else {
            $country = "A downline";
        }
        $userState = $userresult->profile_info->state;
        if ($userState) {
            $states = CountryState::getStates($userCountry);
            $state  = array_get($states, $userState);
        } else {
            $state = "unknown";
        }

        $sponsorId       = $userresult->sponsor_tree->sponsor;
        $sponsorUserName = \App\User::find($sponsorId)->username;


        if ($userresult) {
            // dd($user);
            return view('app.user.register.preview', compact('title', 'sub_title', 'method', 'base', 'userresult', 'sponsorUserName', 'country', 'state', 'sub_title'));
        } else {
            return redirect()->back();
        }
    }

         
    public function paypalsuccess(Request $request, $id)
    {
         
        $response = self::$provider->getExpressCheckoutDetails($request->token);
        $item = PendingTransactions::find($id);
        $item->payment_response_data = json_encode($response);
        $item->save();
        $express_data=json_decode($item->paypal_express_data, true);
        $response = self::$provider->doExpressCheckoutPayment($express_data, $request->token, $request->PayerID);
        if ($response['ACK'] == 'Success') {
            $item->payment_status ='complete';
            $item->save();
             $title=trans('register.payment_complete');
            $sub_title=trans('register.payment_complete');
            $base=trans('register.payment_complete');
            $method=trans('register.payment_complete');
            $purchase_id=$item->id;
            return view('app.user.register.regcomplete', compact('title', 'sub_title', 'base', 'method', 'purchase_id'));
        } else {
            Session::flash('flash_notification', array('level' => 'danger', 'message' =>  trans('register.error_in_payment')));
            return Redirect::to('user/register');
        }
    }
        
    function url_get_contents($Url, $params)
    {
        if (!function_exists('curl_init')) {
            die('CURL is not installed!');
        }
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($params) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        }

          

        $output = curl_exec($ch);

        curl_close($ch);
        return  json_decode($output);
    }

    public function ravecallback(Request $request)
    {

        $resp = Rave::verifyTransaction(request()->txref);
 
        if ($resp <> null) {
            $ref_id=$resp->data->txref;
            $rave_det=PendingTransactions::where('rave_ref_id', $ref_id)
                                             ->first();
            $rave_det->payment_response_data = json_encode($resp);
            $rave_det->save();
            $message=$resp->data->status;
         
            if ($resp->status == "success" && $message == 'successful' && $rave_det->payment_status == 'pending') {
                PendingTransactions::where('rave_ref_id', $ref_id)->update(['payment_status' => 'complete']);
                $title=trans('register.payment_complete');
                $sub_title=trans('register.payment_complete');
                $base=trans('register.payment_complete');
                $method=trans('register.payment_complete');
                $purchase_id=$rave_det->id;
                return view('app.user.register.regcomplete', compact('title', 'sub_title', 'base', 'method', 'purchase_id'));
            } else {
                return redirect('register')->withErrors([trans('register.error_in_payment')]);
                 return redirect("user/register");
            }
        } else {
            return redirect('register')->withErrors([trans('register.error_in_payment')]);
             return redirect("admin/register");
        }
    }
    public function skrillsuccess(Request $request, $id)
    {

        $item = PendingTransactions::find($id);
        $item->payment_response_data = json_encode($request->all());
        $item->payment_status  ='complete';
        $item->save();
        $title=trans('register.payment_complete');
        $sub_title=trans('register.payment_complete');
        $base=trans('register.payment_complete');
        $method=trans('register.payment_complete');
        $purchase_id=$item->id;
        return view('app.user.register.regcomplete', compact('title', 'sub_title', 'base', 'method', 'purchase_id'));
    }

   

    public function ipaysuccess(Request $request, $id)
    {

        $item = PendingTransactions::find($id);
        $item->payment_response_data = json_encode($request->all());
        $item->payment_status  ='complete';
        $item->save();
        $title=trans('register.payment_complete');
        $sub_title=trans('register.payment_complete');
        $base=trans('register.payment_complete');
        $method=trans('register.payment_complete');
        $purchase_id=$item->id;
        return view('app.user.register.regcomplete', compact('title', 'sub_title', 'base', 'method', 'purchase_id'));
    }

    public function ipaycanceled(Request $request)
    {

        return redirect('user/register')->withErrors([trans('register.error_in_payment')]);
            return redirect("user/register");
    }

    public function ipayipn(Request $request)
    {

        dd($request->all());
    }
    public function xpress()
    {
        require_once("paypal_functions.php");
        $url = "";
        foreach ($_GET as $key => $value) {
                $url .= $key . '=' . $value . '&';
        }
            $tok="&" . $url;
            $resArray=hash_call("GetExpressCheckoutDetails", $tok);
            $ack = strtoupper($resArray["ACK"]);
        if ($ack == "SUCCESS" || $ack=="SUCCESSWITHWARNING") {
                        $myresult = ConfirmPayment($resArray['L_PAYMENTREQUEST_0_AMT0'], $resArray);
        }
        if ($myresult['PAYMENTINFO_0_PAYMENTSTATUS']== "Completed") {
                            DB::table('temp_details')->where('token', $myresult['TOKEN'])      ->update(['paystatus' => 1]);
                            $temp_details = TempDetails::all()->where('token', $myresult['TOKEN'])->pluck('regdetails');
                            $str1 = $temp_details->first();
                            $str = json_decode($str1, true);
                            $settings = Settings::getSettings();
                            DB::beginTransaction();
                            $userresult=User::create([
                                'name'       => $str['L_PAYMENTREQUEST_0_NAME0'],
                                'lastname'   => $str['lastname'],
                                'email'      => $str['email'],
                                'username'   => $str['username'],
                                'rank_id'    => '1',
                                'register_by'=> 'PaypalExpress',
                                'password'   => bcrypt($str['password'])
                                ]);
                            $user_profile=ProfileInfo::create([
                                'user_id' =>$userresult->id,
                                'mobile'  => $str['phone'],
                                'passport'=> $str['L_PAYMENTREQUEST_0_PASSPORT0'],
                                'gender'  => $str['gender'],
                                'country' => $str['country'],
                                'state'   => $str['state'],
                                'city'    => $str['city'],
                                'address1'=> $str['address'],
                                'zip'     => $str['zip'],
                                'package' => '1'
                                ]);
            if ($str['placement_user']) {
                $str['placement_user'] = $str['placement_user'];
            } else {
                $str['placement_user'] = $str['sponsor'];
            }
                            $sponsor_id = User::checkUserAvailable($str['sponsor']);
                            $placement_id = User::checkUserAvailable($str['placement_user']);
            if (!$sponsor_id) {
                return redirect()->back()->withErrors(['The username not exist']);
            }
                            $sponsortreeid=Sponsortree::where('sponsor', $sponsor_id)->orderBy('id', 'desc')->take(1)->pluck('id');
                            $sponsortree=Sponsortree::find($sponsortreeid);
                            $sponsortree->user_id=$userresult->id;
                            $sponsortree->sponsor=$sponsor_id;
                            $sponsortree->type="yes";
                            $sponsortree->save();
                            $sponsorvaccant = Sponsortree::createVaccant($sponsor_id, $sponsortree->position);
                            $uservaccant = Sponsortree::createVaccant($userresult->id, 0);
                            $placement_id = Tree_Table::getPlacementId($placement_id, $str['leg']);
                            $tree_id = Tree_Table::vaccantId($placement_id, $str['leg']);
                            $tree = Tree_Table::find($tree_id);
                            $tree->user_id = $userresult->id;
                            $tree->sponsor = $sponsor_id;
                            $tree->type = 'yes';
                            $tree->save();
                            Tree_Table::getAllUpline($userresult->id);
                            $key = array_search($sponsor_id, Tree_Table::$upline_id_list);
            if ($key >= 0   && $sponsor_id  != 1) {
            }
                            Tree_Table::createVaccant($tree->user_id);
                            PointTable::addPointTable($userresult->id);
                            User::insertToBalance($userresult->id);
                            $email = Emails::find(1) ;
                            $app_settings = AppSettings::find(1) ;
                            Mail::send('emails.register', ['email'=>$email,'company_name'=>$app_settings->company_name,'firstname'=>$str['L_PAYMENTREQUEST_0_NAME0'],'name'=>$str['lastname'],'login_username' => $str['username'],'password'=> $str['password']], function ($m) use ($str, $email) {
                                $m->to($str['email'], $str['L_PAYMENTREQUEST_0_NAME0'])->subject('Successfully registered')->from($email->from_email, $email->from_name);
                            });
                            DB::commit();
                            return  redirect("user/register/preview/".Crypt::encrypt($userresult->id));
        }
    }
    public function cancelreg()
    {
        dd("hi");
    }
}
