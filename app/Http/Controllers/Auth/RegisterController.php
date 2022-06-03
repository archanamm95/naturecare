<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Packages;
use App\Country;
use App\Settings;
use App\Voucher;
use App\PaymentType;
use App\Activity;
use App\AppSettings;
use App\Emails;
use App\EmailTemplates;
use App\stripeCustomer;
use App\Commission;
use App\PurchaseHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use GeoIP;
use Mail;
use Input;
use Crypt;
use CountryState;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\TempRegDetails;
use App\Balance;
use App\Welcome;
use App\ShoppingCountry;
use App\ShoppingZone;
use App\TempDetails;
use App\Product;
use DB;
use App\ProductHistory;
use App\ProfileInfo;
use App\Sponsortree;
use App\Tree_Table;
use App\PointTable;
use App\LeadCapture;
use App\Shippingaddress;
use App\PendingTransactions;
use App\PaymentGatewayDetails;
use App\payout_gateway_details;
use App\VoucherHistory;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Account;
use Stripe\Token;
use Srmklive\PayPal\Services\ExpressCheckout;
use Rave;
use Redirect;
use Response;
use App\Models\Marketing\Contact;
use App\Models\ControlPanel\Options;



use App\Jobs\SendEmail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
// 
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected static $provider;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
         self::$provider = new ExpressCheckout;
    }

    
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm($sponsorname = null)
    {
       
        $user_registration = option('app.user_registration');

        // if ($user_registration ==3) {

        //     if (property_exists($this, 'registerView')) {
        //     return view($this->registerView);
        //     }
        if ($user_registration == 1 || $user_registration == 2) {
            Session::flash('flash_notification', array('level' => 'warning', 'message' => trans('register.permission_denied')));
            return Redirect::to('login');
        } else {
            if (User::where('username', '=', $sponsorname)->count() > 0) {
                $id             = User::where('username', '=', $sponsorname)->value('id'); 
                $placement_id   = Tree_Table::getSponsorVaccantId([$id]);
                $vaccant_count  = count(Tree_Table::where('placement_id', $placement_id)->where("type","vaccant")->get());
                $placement_id   = Tree_Table::where('placement_id', $placement_id)->where("type","vaccant")->value('id');
                $tree_data      = Tree_Table::find($placement_id);
                $placement_user = User::where('id', $tree_data->placement_id)->value('username');
                $leg            = $tree_data->leg;
                $sponsor_name   = $sponsorname;

            } else {
                $id             = User::where('id', 1)->first()->id; 
                $placement_id   = Tree_Table::getSponsorVaccantId([$id]);
                $vaccant_count  = count(Tree_Table::where('placement_id', $placement_id)->where("type","vaccant")->get());
                $placement_id   = Tree_Table::where('placement_id', $placement_id)->where("type","vaccant")->value('id');
                $tree_data      = Tree_Table::find($placement_id);
                $placement_user = User::where('id', $tree_data->placement_id)->value('username');
                $leg            = $tree_data->leg;
                $sponsor_name   = User::where('id', 1)->first()->username;
            }

            $location = GeoIP::getLocation();
            $ip_latitude = $location['lat'];
            $ip_longtitude = $location['lon'];
            $countries = CountryState::getCountries();
            $states = CountryState::getStates('MY');
            // $placement_user = $sponsor_name;
            $country = Country::all();
            $package = Packages::all();
            $joiningfee = Settings::value('joinfee');
            $voucher_code = Voucher::value('voucher_code');
            $payment_type = PaymentType::where('status', 'yes')->where('payment_name','!=','Register Point')->where('id','!=',7)->get();
            $payment_gateway=PaymentGatewayDetails::find(1);
            $transaction_pass=str_random(40);
            $shipping_countries = ShoppingCountry::all();
            $shipping_states = ShoppingZone::where('country_id', '=', 129)->get();
            $product = Product::where('quantity','>',0)->get(); 
            
           

            return view('auth.register', compact('sponsor_name', 'countries', 'states', 'ip_latitude', 'ip_longtitude', 'leg', 'placement_user', 'package', 'joiningfee', 'voucher_code', 'payment_type', 'transaction_pass', 'package', 'shipping_countries', 'shipping_states', 'payment_gateway','product','vaccant_count'));
        // }
          
        // else {
        //   return view('auth.login');
        // }
        }
    }
 

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {


        return Validator::make($data, [
            //Login information
            'sponsor_name' => 'exists:users,username',
            'username' => 'required|max:255|unique:users,username|unique:pending_transactions,username',
            'password' => 'required|min:6',
            'firstname' => 'required|max:255',
            'lastname' => 'max:255',//OPTIONAL
            // 'gender' => 'required|max:255',
            'tax_id' => 'max:255', //TAX ID //VAT// National Identification Number //OPTIONAL
            // 'product_ids' =>'accepted',
            // 'product'=>'required',
            // 'bank_file' =>'required',

            //Contact Information
            'country' => 'required|max:255',
            'state' => 'required|max:255',
            'city' => 'required|max:255',
            'post_code' => 'max:255',//OPTIONAL
            'address' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email|unique:pending_transactions,email',
            'phone' => 'max:255',//OPTIONAL
            // 'twitter_username' => 'max:255', //OPTIONAL
            // 'facebook_username' => 'max:255', //OPTIONAL
            // 'youtube_username' => 'max:255', //OPTIONAL
            // 'linkedin_username' => 'max:255', //OPTIONAL
            // 'pinterest_username' => 'max:255', //OPTIONAL
            // 'instagram_username' => 'max:255', //OPTIONAL
            // 'google_username' => 'max:255', //OPTIONAL
            // 'skype_username' => 'max:255', //OPTIONAL
            // 'whatsapp_number' => 'max:255', //OPTIONAL
            // 'bio' => 'max:600', //OPTIONAL

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        
        return User::create([

            //Login information
            'username' => $data['username'],
            'password' => Hash::make($data['password']),

            //Network Information
            'role_id' => '2',
            'sponsor_id' => User::findByUsernameOrFail($data['sponsor_name'])->id,
          
            //Identification
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],

            // 'gender' => $data['gender'],
            'date_of_birth' => $data['date_of_birth'],
            'job_title' => $data['job_title'],
            'tax_id' => $data['tax_id'],
            // 'passport' => $data['passport'],

            //Contact information
            'country' => $data['country'],
            'state' => $data['state'],
            'city' => $data['city'],
            'post_code' => $data['post_code'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'address' => $data['address'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            

            //Media
            // 'profile_photo' => $data['profile_photo'],
            // 'profile_coverphoto' => $data['profile_coverphoto'],

            //Social links
            'twitter_username' => $data['twitter_username'],
            'facebook_username' => $data['facebook_username'],
            'youtube_username' => $data['youtube_username'],
            'linkedin_username' => $data['linkedin_username'],
            'pinterest_username' => $data['pinterest_username'],
            'instagram_username' => $data['instagram_username'],
            'google_username' => $data['google_username'],

            //Instant Messaging Ids (IM)
            'skype_username' => $data['skype_username'],
            'whatsapp_number' => $data['whatsapp_number'],

            //Profile
            'bio' => $data['bio'],



            //App Specific



        ]);
    }


    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
    
          // 
  // dd($request->payment);
        // $userCount  = PendingTransactions::where('username','like',$request->country.'%')->count();
        // $userCount  = $userCount+1;
        // $num_padded = sprintf("%06d", $userCount);
        // $num_padded  = rand(10,99);
        // $prod_bv   = Product::find($request->product)->value('bv');
        // $total_bv  = $prod_bv * $request->quantity;
        // $pack_id   = Packages::where('pv','>',$total_bv)->value('id');
        // if($pack_id){
        //     $package = $pack_id-1;
        // }
        // else{
        //     $max_pv  = Packages::max('pv');
        //     $package = Packages::where('pv',$max_pv)->value('id');
        // }
     
    
        $data                           = array();
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

        $data['passport']               = $request->passport;
        $data['file_name']              = $request->id_file;
        $data['file_name']              = $request->id_file;
        $data['sponsor']                = $request->sponsor;
        $data['password']               = $request->password;
        $data['package']                = $request->package;
        $data['product']                = $request->product_ids;
        $data['product_details']        = $request->product;
        $data['quantity']               = $request->quantity;
        // $data['username']               = $request->country.$num_padded;
        $data['counthidden']            = $request->counthidden;
        $data['address']                = $request->address;
        $data['address2']               = $request->address2;
        $data['city']                   = $request->city;
        $data['zip']                    = $request->zip;
        $data['country']                = $request->country;
        $data['state']                  = $request->state;
        $data['bank_file']              = '';
        // $data['placement_user']         = $request->placement_user;

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
        $data['placement_user']         = $request->placement_user;
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
        
       
    

        $validator = $this->validator($data)->validate();

        $sponsor_id = User::checkUserAvailable($data['sponsor']);
        $user_registration = option('app.user_registration');
        /**
         * Checking if placement_user exist in users table
         * @var [type]
         */
        $placement_id =  $sponsor_id ;// User::checkUserAvailable($data['placement_user']);
        if (!$sponsor_id) {
            /**
             * If sponsor_id validates as false, redirect back without registering , with errors
             */
            return redirect()->back()->withErrors([trans('register.sponsor_not_exist')])->withInput();
        }
          $count = $data['counthidden'];
          // dd($count);
         if ($count > 2) {
             
            
         return redirect()->back()->withErrors([trans('please select only two items! ')])->withInput();

         }
     

        $payment_gateway=PaymentGatewayDetails::find(1);
        $prod_amount = Product::where('id',$data['product'])->value('price');
        $joiningfee  = $prod_amount*$data['quantity'];
        $orderid = mt_rand();

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

            $bitaps_det = PendingTransactions::where('username', $request->username)
                                                      ->where('payment_status', 'pending')
                                                      ->where('payment_method', $request->payment)
                                                      ->first();
            
        if ($request->payment == 'bitaps' && $bitaps_det <> null) {
            $register=$bitaps_det;
        } else {
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
            // if ($request->payment == 'bankwire') {
            //     $validator = Validator::make($request->all(), [
            //         'bank_file'        => 'required|mimes:jpeg,png,jpg'
            //     ]);
            //     if ($validator->fails())
            //         return redirect()->back()->withErrors($validator)->withInput();

            //     if(isset($request->bank_file) && !empty($request->bank_file)){
            //         if (Input::hasFile('bank_file')) {
            //             $destinationPath   = public_path() . '/uploads/documents';
            //             $extension         = Input::file('bank_file')->getClientOriginalExtension();
            //             $bank_file         = rand(000011111, 99999999999) . '.' . $extension;
            //             Input::file('bank_file')->move($destinationPath, $bank_file);
            //             $data['bank_file'] = $bank_file;
            //         }
            //     }
            //     else{
            //         Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('register.error_in_payment')));
            //         return Redirect::to('admin/register');
            //     }
            //     $flag=true;
            // }
            
            $register=PendingTransactions::create([
                 'order_id'       => $orderid,
                 'username'       => $data['username'],
                 'email'          => $data['email'],
                 'sponsor'        => $data['sponsor'],
                 'package'        => $data['package'],
                 // 'invoice'        => $data['bank_file'],
                 'request_data'   => json_encode($data),
                 'payment_method' => $request->payment,
                 'payment_code'   => $data['payment_date'],
                 'payment_type'   =>'register',
                 'payment_status' => 'complete'
                
                 // 'amount'         => $joPendingTransactionsiningfee,
                ]);
          
        }
        
      // dd($register);

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
                                 'user_id'     => $sponsor_id,
                                 'customer_id' => $customer->id,
                                 'amount'      => $fee,
                                 'package_id'  => 1,
                                 'category_id' => 1,
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
        if ($request->payment == 'cheque') {
            if ($user_registration <> 6) {
                 PendingTransactions::where('id', $register->id)->update(['payment_status' => 'complete']) ;
                 $flag=true;
            } else {
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

        //     /**
        //      * If request contains payment mode paypal, application will handle the payment process
        //      * @var [string]
        //      */
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
                 $data['return_url'] = url('/paypal/success', $register->id);
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

     
            /**
             * If request has payment mode as voucher, will check against the vouchers for validation
             * @var [type]
             */

        

           
        if ($request->payment == 'skrill') {
                echo '  <form id="skrill" action="https://pay.skrill.com" method="post" > 
                         <input type="hidden" name="pay_to_email" value="'.$payment_gateway->skrill_mer_email.'">
                        <input type="hidden" name="return_url" value="'.url('skrill/success', $register->id).'" >
                        <input type="hidden" name="status_url" value="'.url('skrill-status', $register->id).'">
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

    


       
        if($request->payment == 'bankwire'){
        Session::flash('flash_notification', array('message'=> 'Your registration Successful!.','level'=>'success'));
        // dd($register->id);
        // $id = bcrypt($register->id);
                $id = $register->id;
                $crypt_id = Crypt::encrypt($id);

        return redirect('purchase/pending/'. $crypt_id);


  
        }
            $purchase_id=$register->id;
            $reg_type=$user_registration;
            return view('auth.regcomplete', compact('purchase_id', 'reg_type'));
            return redirect()->back();
        
    }


    public function purchase_pending($id){


          $title = trans('Product Purchase');
          $sub_title = trans('Details'); 
          $base = trans('Details');  
          $method = trans('Details'); 


           $decrypt_id = Crypt::decrypt($id);


          $userdet = PendingTransactions::where('id',$decrypt_id)->first();

          return view('auth.purchase_pending_view',compact('title', 'sub_title', 'method', 'base','userdet'));
        
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
           
            return view('auth.preview', compact('title', 'sub_title', 'method', 'base', 'userresult', 'sponsorUserName', 'country', 'state', 'sub_title'));
        } else {
            return redirect()->back();
        }
    }

    public function xpress()
    {
        require_once "paypal_functions.php";
        $url = "";
        foreach ($_GET as $key => $value) {
            $url .= $key . '=' . $value . '&';
        }
        $tok      = "&" . $url;
        $resArray = hash_call("GetExpressCheckoutDetails", $tok);
        $ack      = strtoupper($resArray["ACK"]);
        if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
            $myresult = ConfirmPayment($resArray['L_PAYMENTREQUEST_0_AMT0'], $resArray);
        }
        if ($myresult['PAYMENTINFO_0_PAYMENTSTATUS'] == "Completed") {
            DB::table('temp_details')->where('token', $myresult['TOKEN'])->update(['paystatus' => 1]);
            $temp_details = TempDetails::all()->where('token', $myresult['TOKEN'])->pluck('regdetails');
            $str1         = $temp_details->first();
            $str          = json_decode($str1, true);

            $settings     = Settings::getSettings();
            DB::beginTransaction();
            if (is_numeric($str['shipping_country'])) {
                $shipping_country = ShoppingCountry::where('country_id', $str['shipping_country'])->value('name');
            } else {
                $shipping_country = $str['shipping_country'];
            }
            if (is_numeric($str['shipping_state'])) {
                $shipping_state = ShoppingZone::where('zone_id', '=', $str['shipping_state'])->select('name', 'shipping_cost')->first();
            } else {
                $shipping_state = ShoppingZone::where('name', '=', $str['shipping_state'])->select('name', 'shipping_cost')->first();
            }
            $ship_country= $shipping_country ;
            $ship_state= $shipping_state->name ;
            $rank_update_date = date('Y-m-d H:i:s');


            $data=array();
            $data['firstname']=$str['L_PAYMENTREQUEST_0_NAME0'];
            $data['lastname']=$str['lastname'];
            $data['email']=$str['email'];
            $data['username']=$str['username'];
            $data['register_by']='PaypalExpress';
            $data['password']=Hash::make($str['password']);
            $data['shipping_country']=$ship_country;
            $data['shipping_state']= $ship_state;
            $data['reg_by']='PaypalExpress';
            $data['transaction_pass']=$str['transaction_pass'];
            $data['confirmation_code']=str_random(40);
            $data['phone']=$str['phone'];
            $data['passport']=$str['L_PAYMENTREQUEST_0_PASSPORT0'];
            $data['gender']=$str['gender'];
            $data['country']=$str['country'];
            $data['state']=$str['state'];
            $data['city']=$str['city'];
            $data['address']=$str['address'];
            $data['zip']=$str['zip'];
            $data['package']=$str['package'];
            $data['cpf']=null;
            $data['location']=null;
            $data['leg']=$str['leg'];
            $data['rank_update_date']=$rank_update_date = date('Y-m-d H:i:s');


            $sponsor_id   = User::checkUserAvailable($str['sponsor']);
            $placement_id = User::checkUserAvailable($str['placement_user']);

            $userresult = User::add($data, $sponsor_id, $placement_id);
            $sponsor_id   = User::checkUserAvailable($str['sponsor']);
            $placement_id = User::checkUserAvailable($str['placement_user']);

            if (!$sponsor_id) {
                return redirect()->back()->withErrors(['The username not exist'])->withInput();
            }

            $sponsortreeid        = Sponsortree::where('sponsor', $sponsor_id)->orderBy('id', 'desc')->take(1)->value('id');
            $sponsortree          = Sponsortree::find($sponsortreeid);
            $sponsortree->user_id = $userresult->id;
            $sponsortree->sponsor = $sponsor_id;
            $sponsortree->type    = "yes";
            $sponsortree->save();
            $sponsorvaccant = Sponsortree::createVaccant($sponsor_id, $sponsortree->position);
            $uservaccant    = Sponsortree::createVaccant($userresult->id, 0);
            $placement_id   = Tree_Table::getPlacementId($placement_id, $str['leg']);
            $tree_id        = Tree_Table::vaccantId($placement_id, $str['leg']);
            $tree           = Tree_Table::find($tree_id);
            $tree->user_id  = $userresult->id;
            $tree->sponsor  = $sponsor_id;
            $tree->type     = 'yes';
            $tree->save();
            Tree_Table::getAllUpline($userresult->id);
            $key = array_search($sponsor_id, Tree_Table::$upline_id_list);
            if ($key >= 0 && $sponsor_id != 1) {
                if (Tree_Table::$upline_users[$key]['leg'] == 'L') {
                    User::where('id', $sponsor_id)->increment('left_count');
                } elseif (Tree_Table::$upline_users[$key]['leg'] == 'R') {
                    User::where('id', $sponsor_id)->increment('right_count');
                }
            }
            Tree_Table::createVaccant($tree->user_id);
            PointTable::addPointTable($userresult->id);
            User::insertToBalance($userresult->id);
            $email        = Emails::find(1);
            $app_settings = AppSettings::find(1);
            $setting=Welcome::first();
            Mail::send('emails.register', ['email' => $email, 'company_name' => $app_settings->company_name,'content' => $setting->body,'firstname' => $str['L_PAYMENTREQUEST_0_NAME0'], 'name' => $str['lastname'], 'login_username' => $str['username'], 'password' => $str['password']], function ($m) use ($str, $email, $setting) {
                $m->to($str['email'], $str['L_PAYMENTREQUEST_0_NAME0'])->subject($setting->subject)->from($email->from_email, $email->from_name);
            });
            //dd(543896);
            DB::commit();
            return redirect("register/preview/" . Crypt::encrypt($userresult->id));
        }
    }



    public function verifyUser($confirmation_code)
    {

             $user = User::where('confirmation_code', $confirmation_code)->first();

        if (isset($user)) {
            if (!$user->confirmed) {
                $user->confirmed = 1;
                $user->keyid = 1;
                $user->save();

                $email = Emails::find(1);
                $app_settings = AppSettings::find(1);
                SendEmail::dispatch($user, $user->email,  $user->name, 'register')
                                ->delay(now()->addSeconds(5));
                $level = 'success';
                $status = "Your e-mail is verified.";
            } else {
                $level = 'info';
                $status = "Your e-mail is already verified.";
            }
        } else {
            Session::flash('flash_notification', array('level' => 'warning', 'message' => trans('register.sorry_your_email_cannot_be_identified')));
            return redirect('/login')->with('warning', trans('register.sorry_your_email_cannot_be_identified'));
        }
 
        Session::flash('flash_notification', array('level' => $level, 'message' => $status));
        Auth::loginusingid($user->id);
        return redirect('/user/dashboard')->with('status', $status);
    }
    public function cancelreg()
    {
        dd("cancelreg-RegisterController");
    }

    public function RandomString()
    {
        $characters       = "23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
        $charactersLength = strlen($characters);
        $randstring       = '';
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

    public function leadView($username)
    {

        $title     = trans('register.leadcapture');
        $sub_title = trans('register.leadcapture');
        $base      = trans('register.leadcapture');
        $method    = trans('register.leadcapture');

        $app = $app = AppSettings::find(1);
        $user_id = User::where('username', '=', $username)->value('id');
        $profile_photo = ProfileInfo::where('user_id', '=', $user_id)->value('profile');

        return view('auth.leadcapture', compact('title', 'username', 'sub_title', 'base', 'method', 'app', 'profile_photo'));
    }

    public function leadPost(Request $request)
    {

        $validator = Validator::make($request->all(), [
          'username'   => 'required',
          'name'     => 'required',
          'email' => 'required',
          'phone' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }


        LeadCapture::create(['username'=>$request->username,
                           'name'=>$request->name,
                           'email'=>$request->email,
                           'mobile'=>$request->phone]);
        Session::flash('flash_notification', array('level' =>"success", 'message' =>trans('register.lead_capture_added_successfully')));
       
        return redirect()->back();
    }

    public function bitapssuccess(Request $request)
    {
       
        $item = PendingTransactions::where('payment_code', $request->code)->first();
        $item->payment_response_data = json_encode($request->all());
        $item->save();
        if ($request->confirmations >=3) {
            $user_registration = option('app.user_registration');
            if ($user_registration <> 6) {
                $item->payment_status='complete';
                $item->save();
            }
        }
          dd("done");
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
            $user_registration = option('app.user_registration');
            if ($user_registration <> 6) {
                $item->payment_status='complete';
                $item->save();
            }
            
            $purchase_id=$item->id;
            $reg_type=$user_registration;
            return view('auth.regcomplete', compact('purchase_id', 'reg_type'));
        } else {
            Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('register.error_in_payment')));
            return Redirect::to('register');
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
                $user_registration = option('app.user_registration');
                if ($user_registration <> 6) {
                    PendingTransactions::where('rave_ref_id', $ref_id)->update(['payment_status' => 'complete']);
                }
                $reg_type=$user_registration;
                return view('auth.regcomplete', compact('purchase_id', 'reg_type'));
            } else {
                return redirect('register')->withErrors([trans('register.error_in_payment')]);
                 return redirect("register");
            }
        } else {
            return redirect('register')->withErrors([trans('register.error_in_payment')]);
             return redirect("register");
        }
    }
    public function skrillsuccess(Request $request, $id)
    {
        // dd($request->all());

        $item = PendingTransactions::find($id);
        $item->payment_response_data = json_encode($request->all());
       
        $item->save();
        $user_registration = option('app.user_registration');
        if ($user_registration <> 6) {
             $item->payment_status  ='complete';
             $item->save();
        }
            $purchase_id=$item->id;
            $reg_type=$user_registration;
            return view('auth.regcomplete', compact('purchase_id', 'reg_type'));
    }


    public function ipaysuccess(Request $request, $id)
    {

        $item = PendingTransactions::find($id);
        $item->payment_response_data = json_encode($request->all());
        $item->save();
        $user_registration = option('app.user_registration');
        if ($user_registration <> 6) {
             $item->payment_status  ='complete';
             $item->save();
        }
          $purchase_id=$item->id;
          $reg_type=$user_registration;
          return view('auth.regcomplete', compact('purchase_id', 'reg_type'));
    }

    public function ipaycanceled(Request $request)
    {

         return redirect('register')->withErrors([trans('register.error_in_payment')]);
            return redirect("register");
    }

    public function ipayipn(Request $request)
    {

        dd($request->all());
    }


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

    public function bitapspreview(Request $request, $transid)
    {

        $title=trans('register.bitaps_preview');
        $base=trans('register.bitaps_preview');
        $method=trans('register.bitaps_preview');
        $sub_title=trans('register.bitaps_preview');

        return view('auth.bitapspreview');
    }

    public function bitapstorepurchase(Request $request)
    {
      
        $item = PendingTransactions::where('payment_code', $request->code)->first();
        $item->payment_response_data = json_encode($request->all());
        $item->save();
        if ($request->confirmations >=3) {
            $data=json_decode($item->request_data, true);
       
            $order_data= Shippingaddress::saveShippingRequest($item->user_id, $data['fname'], $data['email'], $data['phone'], $data['shipping_country'], $data['shipping_state'], $data['city'], $data['address'], $data['zip'], 1, 1, $data['payment'], 'order placed', 0, $data['new_shipping_cost']);
          
            if ($order_data <> 0) {
                PendingTransactions::where('id', $item->id)->update(['payment_status' => 'finish']) ;
            }
        }

        dd("done");
    }


    public function terms_and_conditions()
    {

        $title     = trans('controlpanel.terms_and_conditions');
        $sub_title = trans('controlpanel.terms_and_conditions');
        $base      = trans('controlpanel.terms_and_conditions');
        $method    = trans('controlpanel.terms_and_conditions');
         $t_and_c =Settings::value('content');
        
         return view('auth.terms_and_conditions', compact('title', 'sub_title', 'base', 'method', 't_and_c'));
    }
    public function cookie()
    {

        $title     = trans('controlpanel.cookie');
        $sub_title = trans('controlpanel.cookie');
        $base      = trans('controlpanel.cookie');
        $method    = trans('controlpanel.cookie');
        $cookie =Settings::value('cookie');
             
       

         return view('auth.cookies', compact('title', 'sub_title', 'base', 'method', 'cookie'));
    }
    public function placementData(Request $request){
        $sponsordata    = User::where('username',$request->sponsor)->first();
        if(!empty($sponsordata)){
            $placement_id   = $sponsordata->id;
            $placement_id   = Tree_Table::getSponsorVaccantId([$placement_id]);
            $vaccant_count  = count(Tree_Table::where('placement_id', $placement_id)->where("type","vaccant")->get());
            $placement_id   = Tree_Table::where('placement_id', $placement_id)->where("type","vaccant")->value('id');
            $tree_data      = Tree_Table::find($placement_id);
            $placement_user = User::where('id', $tree_data->placement_id)->first();
            $leg            = $tree_data->leg;
            return response()->json(['status' => true , 'placement_user'=>$placement_user->username ,'leg' => $leg ,'vaccant_count' => $vaccant_count , 'value' => $sponsordata->username. ' : '.$sponsordata->name.' '.$sponsordata->lastname , 'placementvalue' => $placement_user->username. ' : '.$placement_user->name.' '.$placement_user->lastname]);
        }
        return response()->json(['valid' => false , 'value' => 'No such sponsor exists!', 'placementvalue' => '']);
    }   
    public function changePlacement(Request $request){
        $substring = explode(' ', $request->placementUser);;
        $substring = $substring[0];

        $placement_id   = User::where('username',$substring)->value('id');
        $sponsor_id     = User::where('username',$request->sponsor)->value('id');
        $downline_id_list             = [];
        Tree_Table::$downline_id_list = [];
        Tree_Table::getDownlineuser(true,$sponsor_id);
        $downline_id_list = Tree_Table::$downline_id_list;
        if(in_array($placement_id, $downline_id_list)){
            $count = Tree_Table::where('placement_id',$placement_id)->where('type','vaccant')->count();
            if($count == 1)
            {   
                $placement_user = User::where('username', $substring)->first();
                $leg            = Tree_Table::where('placement_id',$placement_id)->where('type','vaccant')->value('leg');
                $vaccant_count  = $count;
                return response()->json(['status' => true , 'placement_user'=>$placement_user->username ,'leg' => $leg ,'vaccant_count' => $vaccant_count, 'placementvalue' => $placement_user->username. ' : '.$placement_user->name.' '.$placement_user->lastname]);
            }
            elseif($count == 2){
                $placement_user = User::where('username', $substring)->first();
                $leg            = "L";
                $vaccant_count  = $count;
                return response()->json(['status' => true , 'placement_user'=>$placement_user->username ,'leg' => $leg ,'vaccant_count' => $vaccant_count, 'placementvalue' => $placement_user->username. ' : '.$placement_user->name.' '.$placement_user->lastname]);
            }
        }
        else{
            $placement_id =  $sponsor_id ;
        }
        if($placement_id > 0){
            $placement_id   = Tree_Table::getSponsorVaccantId([$placement_id]);
            $vaccant_count  = count(Tree_Table::where('placement_id', $placement_id)->where("type","vaccant")->get());
            $placement_id   = Tree_Table::where('placement_id', $placement_id)->where("type","vaccant")->value('id');
            $tree_data      = Tree_Table::find($placement_id);
            $placement_user = User::where('id', $tree_data->placement_id)->first();
            $leg            = $tree_data->leg;
            return response()->json(['status' => true , 'placement_user'=>$placement_user->username ,'leg' => $leg ,'vaccant_count' => $vaccant_count, 'placementvalue' => $placement_user->username. ' : '.$placement_user->name.' '.$placement_user->lastname]);
        }
        return response()->json(['valid' => false, 'placementvalue' => '']);
    }   
    public static function autocomplete(Request $request)
    {
    
        $term = $request->get('term');
    // dd($term);
        $results = array();
    
        $queries = DB::table('users')
        ->where('username', 'LIKE', '%'.$term.'%')
        ->orWhere('name', 'LIKE', '%'.$term.'%')
        ->orWhere('lastname', 'LIKE', '%'.$term.'%')
        // ->select('id')
        ->take(5)->get();
    
        foreach ($queries as $query) {
            $results[] = [ 'id' => $query->id, 'value' => $query->username. ' : '.$query->name.' '.$query->lastname,'user_id' => Crypt::encrypt($query->id),'username' => $query->username ];
        }
        return Response::json($results);
    }
    public function getDownloadId(Request $request)
    {
        $name    = $request->name;
        $file    = public_path() . "/uploads/documents/" . $request->name;
        $headers = array(
            'Content-Type: application/pdf',
        );


        return Response::download($file, $request->name, $headers);
        //dd($name);
    }
    public static function autocompleteplacement(Request $request,$username)
    {
        $user_id = User::where('username',$username)->value('id');
        $term = $request->get('term');
    // dd($term);
        $results = array();
        $data = Tree_Table::where('va');
        $queries = DB::table('users')
        ->where('username', 'LIKE', '%'.$term.'%')
        ->orWhere('name', 'LIKE', '%'.$term.'%')
        ->orWhere('lastname', 'LIKE', '%'.$term.'%')
        // ->select('id')
        ->take(5)->get();
    
        foreach ($queries as $query) {
            $results[] = [ 'id' => $query->id, 'value' => $query->username. ' : '.$query->name.' '.$query->lastname,'user_id' => Crypt::encrypt($query->id),'username' => $query->username ];
        }
        return Response::json($results);
    }
  public function viewinvoice($id)
    {
        
        $decrypt_id = Crypt::decrypt($id);

        $title     =  'Invoice';
        $sub_title =  'Invoice';
        $base      =  'Invoice';
        $method    =  'Invoice';
          
        $invoice = PurchaseHistory::where('purchase_history.id','=',$decrypt_id)
                                ->join('billing_addresses','billing_addresses.id','=','purchase_history.billing_address_id')
                                ->join('packages','packages.id','=','purchase_history.package_id')
                                ->join('users','purchase_history.user_id','=','users.id')
                                ->select('purchase_history.*','billing_addresses.*','packages.package','packages.amount','users.*')->first();
                             
      $products =ProductHistory::where('product_history.purchase_history_id','=',$decrypt_id)
                               ->join('product','product.id','=','product_history.product_id')
                               ->where('purchase_history_id','=',$decrypt_id)
                               ->select('product.name','product.price','product_history.quantity','product_history.total_price')
                               ->get();

       $date = date('d-m-Y');
 
       $Grand_total   = 0;
       foreach ($products as $value) {
                      
        $Grand_total  = $Grand_total + $value->total_price;
                    
       }                     


       $company_address = AppSettings::first();

   

        return view('auth.invoice', compact('title', 'sub_title', 'base', 'method','invoice','company_address','products','Grand_total','date'));
    }


   
}
