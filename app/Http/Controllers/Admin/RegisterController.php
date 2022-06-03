<?php
namespace App\Http\Controllers\Admin;

use App\AppSettings;
use App\Balance;
use App\Commission;
use App\Country;
use App\Emails;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\LeadershipBonus;
use App\MenuSettings;
use App\Packages;
use App\Transactions;
use App\RegisterPoint;
use App\PaymentType;
use App\PointTable;
use App\ProfileInfo;
use App\Productaddcart;
use App\Product;
use App\PurchaseHistory;
use App\Settings;
use App\Sponsortree;
use App\TempDetails;
use App\Tree_Table;
use App\RsHistory;
use App\ProfileModel;
use App\PaymentGatewayDetails;
use App\User;
use App\Voucher;
use App\PendingTransactions;
use App\stripeCustomer;
use App\MyRole;
use App\payout_gateway_details;
use Auth;
use CountryState;
use App\Welcome;
use Crypt;
use DB;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Mail;
use Redirect;
use Session;
use Validator;
use App\Activity;
use Illuminate\Support\Facades\Hash;
use App\ShoppingCountry;
use App\ShoppingZone;
use App\VoucherHistory;
use Response;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Account;
use Stripe\Token;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Models\ControlPanel\Options;
use Rave;
use Input;
use Artisan;



use App\Jobs\SendEmail;

class RegisterController extends AdminController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller - Admin
    |--------------------------------------------------------------------------
    |
    | This controller handles registering users for the application and
    | redirecting them to preview screen.
    |
     */
      
    protected static $provider;
   
    /**
     * View registration page.
     *
     * @var placement_id (Encrypted Placement Id) : if placement id is set, registration will be done under the-
     * specified placement id rather than authenticated user.
     * returns view page
     *
     */

    public function __construct()
    {
       
        self::$provider = new ExpressCheckout;
    }

    public function index($placement_id = "")
    {
        $title     = trans('registration.register');
        $sub_title = trans('register.register_new_influencer');
        $base      = trans('registration.register');
        $method    = trans('registration.register');
       
        return view('app.admin.register.influencer_register', compact('title', 'sub_title', 'base', 'method'));
       
    }

    public function addTocart(Request $request){
        try{
            $product=product::where('id', $request->product_id)
                            ->whereNull('deleted_at')
                            -> first();
            $productaddcart = productaddcart::firstOrNew(['product_id' => $request->product_id,'user_id'=>Auth::user()->id]);
            if ($productaddcart->cart_quantity + $request->quantity <= $product->quantity) {
                $productaddcart->cart_quantity =$productaddcart->cart_quantity + $request->quantity;
                $productaddcart->save();
                $message = trans('all.product_added_successfully');
                return Response::json(['status'=>true,'message'=>$message])->header('Content-Type','application/json');
            } else{
                $message = trans('all.insufficient_product_quantity');
                return Response::json(['status'=>false,'message'=>$message])->header('Content-Type','application/json');
            } 
        } catch (\Exception $e) {
            return Response::json(['status'=>false,'message'=> $e->getMessage()])->header('Content-Type','application/json');
        }
    }
    public function register(Request $request)
    {  
        // dd($request->all());
       if ($request->all() == null || empty($request->all()) ) {

             return Response::json(['status'=>true,'message'=>'failed'])->header('Content-Type','application/json');
        }

        $data=json_encode($request->all());
        $tempdata= TempDetails::create([
                'regdetails'=>$data,
                'paystatus'=>'checkout-reg',
                'token'=>0
        ]);
        $sposorname=User::where('id',1)->select('id','username')->get();
// dd($sposorname[0]['username']);
        $data                           = array();
        $data['sponsor']                = $sposorname[0]['username'];
        $data['purchase']               = '';
        $data['ic_number']              = '';
        $data['username']               = $request->email;
        $data['firstname']              = $request->firstname;
        $data['lastname']               = $request->lastname;
        $data['email']                  = $request->email;
        $data['phone']                  = '+'.$request->phone;
        $data['dateofbirth']            = '';
        $data['facebook_username']      = '';
        $data['WeChat_id']              = '';
        $data['Instagram_Id']           = '';
        $data['tiktok_id']              = '';
        $data['Shopee_Shop_Name']       ='';
        $data['Lazada_Shop_name']       = '';
        $data['twitter_username']       = '';
        $data['youtube_username']       = '';
        $data['file_name']              = '';
        $data['password']               = $request->password;
        $data['package']                = 1;
        $data['product']                = '';
        $data['product_details']        = '';
        $data['total_quantity']         = '';
        $data['total_price']            = '';
        $data['address']                = '';
        $data['address2']               = '';
        $data['city']                   = '';
        $data['zip']                    = '';
        $data['country']                = '';
        $data['state']                  = '';
        $data['bank_file']              = '';
        $data['user_type']              = 'Influencer';
        $data['reg_by']                 = '';
        $data['reg_type']               = '';
        $data['confirmation_code']      = str_random(40);
        $data['order_id']               = '';
        $data['billing_firstname']      = '';
        $data['billing_lastname']       = '';
        $data['payment_company']        = '';
        $data['billing_address']        = '';
        $data['billing_address2']       = '';
        $data['billing_city']           = '';
        $data['payment_zone_id']        = '';
        $data['payment_date']           = '';
        $data['billing_zip']            = '';
        $data['payment_zone']           = '';
        $data['payment_zone_code']      = '';
        $data['billing_country']        = '';
        $data['shipping_firstname']     = '';
        $data['shipping_lastname']      = '';
        $data['shipping_address']       = '';
        $data['shipping_address2']      = '';
        $data['shipping_city']          = '';
        $data['shipping_zip']           = '';
        $data['shipping_country']       = '';
        $data['shipping_firstname']     = '';
        $data['shipping_lastname']      = '';
        $data['shipping_address']       = '';
        $data['shipping_address2']      = '';
        $data['shipping_city']          = '';
        $data['shipping_zip']           = '';
        $data['shipping_country']       = '';
        $data['shipping_state']         = '';
        $data['package_count']          = '';
        $data['registration_type']      = '';
        $data['tracking_id']            = isset($request->tracking_id) ? $request->tracking_id : 'not_found';
        $data['courier_service']        = isset($request->courier_service) ? $request->courier_service : 'not_found';
// dd($data);
        $messages = [
                'unique' => 'The :attribute already existis in the system',
                'exists' => 'The :attribute not found in the system',

        ];

        $validator = Validator::make($data, [
                'sponsor'          => 'required|exists:users,username|max:255',
                'email'            => 'required|unique:users,email|email|max:255',
                'phone'            => 'required|numeric',
        ]);

        // if ($validator->fails()) {
        //     $datas=$validator->errors();
        //     dd($datas);
        //     // return Response::json(['status'=>0,'message'=>$data])->header('Content-Type','application/json');
        // } 
         if ($validator->fails()) 
            return redirect()->back()->withErrors($validator)->withInput();
        else {

                // DB::beginTransaction();
                try {

                $sponsor_id = $sposorname[0]['id'];
          
                $placement_id =  $sponsor_id ;


                if (!$sponsor_id)
                {

                   $sponsor_id = 1;
                   $placement_id = 1;
                    
                }
// dd($sponsor_id);

                     $payment   = PendingTransactions::create([
                     'order_id' =>0,
                     'username' =>$request->email,
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

               Session::flash('flash_notification', array('message'=>trans('register.registered Successfully'),'level'=>'success'));
                    return redirect()->back();
               }
               catch(\Exception $e)
               {
                 
                 DB::rollback();
                 
                    $error1 = $e->getMessage();
                   
                    $line_number = $e->getLine();
                    TempDetails::where('id',$tempdata->id)->update(['error' => $error1,
                                      'line_number' => $line_number]);
               
               Session::flash('flash_notification', array('message'=>trans('register. not registered Successfully'),'level'=>'error'));
                    return redirect()->back();
               }

            }  


        // $validator = Validator::make($request->all(), [
           
        //     'email'            => 'required|unique:pending_transactions,email|unique:users,email|email|max:255',
        //     'password'         => 'required|min:4',
           
        // ]);
       
        // if ($validator->fails()) 
        //     return redirect()->back()->withErrors($validator)->withInput();
             


        // $sponsor=User::where('id',1)->value('username');
        // $request['sponsor']=$sponsor;
        // $request['username']=$request->email;
        // $sponsor_id = User::checkUserAvailable($sponsor);  
        // $register=PendingTransactions::create([
        //              'order_id'       => 0,
        //              'username'       => $request->email,
        //              'email'          => $request->email,
        //              'sponsor'        => $sponsor,
        //              'package'        => 0,
        //              'invoice'        => 0,
        //              'request_data'   => json_encode($request->all()),
        //              'payment_method' =>'influencer',
        //              'payment_type'   =>'register',
        //              'amount'         => 0,
        //              'payment_status' => 'complete',
        //             ]);
        // Artisan::call('process:influencer', ['--payment_id' =>$register->id]);

        // Session::flash('flash_notification', array('message'=>trans('register.registered Successfully'),'level'=>'success'));
        // return redirect()->back();
    }

    public function preview($idencrypt)
    {
        $title     = trans('register.registration');
        $sub_title = trans('register.preview');
        $method    = trans('register.preview');
        $base      = trans('register.preview');
// echo Crypt::decrypt($idencrypt) ;
// die();
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
            return view('app.admin.register.preview', compact('title', 'sub_title', 'method', 'base', 'userresult', 'sponsorUserName', 'country', 'state', 'sub_title'));
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
            $userresult = User::create([
                'name'        => $str['L_PAYMENTREQUEST_0_NAME0'],
                'lastname'    => $str['lastname'],
                'email'       => $str['email'],
                'username'    => $str['username'],
                'rank_id'     => '1',
                'register_by' => 'PaypalExpress',
                'password'    => Hash::make($str['password']),
            ]);
            $user_profile = ProfileInfo::create([
                'mobile'   => $str['phone'],
                'passport' => $str['L_PAYMENTREQUEST_0_PASSPORT0'],
                'gender'   => $str['gender'],
                'country'  => $str['country'],
                'state'    => $str['state'],
                'city'     => $str['city'],
                'address1' => $str['address'],
                'zip'      => $str['zip'],
                'package'  => $str['package'],
            ]);
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
            Mail::send('emails.register', ['email' => $email, 'company_name' => $app_settings->company_name, 'firstname' => $str['L_PAYMENTREQUEST_0_NAME0'], 'name' => $str['lastname'], 'login_username' => $str['username'], 'password' => $str['password']], function ($m) use ($str, $email) {
                $m->to($str['email'], $str['L_PAYMENTREQUEST_0_NAME0'])->subject('Successfully registered')->from($email->from_email, $email->from_name);
            });
            DB::commit();
            return redirect("admin/register/preview/" . Crypt::encrypt($userresult->id));
        }
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


    public function paypalsuccess(Request $request, $id)
    {
         
        $response = self::$provider->getExpressCheckoutDetails($request->token);
        $item = PendingTransactions::find($id);
        $item->payment_response_data = json_encode($response);
        $item->save();
        $express_data=json_decode($item->paypal_express_data, true);
        $response = self::$provider->doExpressCheckoutPayment($express_data, $request->token, $request->PayerID);
            
        if ($response['ACK'] == 'Success') {
            $item->payment_status='complete';
            $item->save();
            $title=trans('register.payment_complete');
            $sub_title=trans('register.payment_complete');
            $base=trans('register.payment_complete');
            $method=trans('register.payment_complete');
            $purchase_id=$item->id;
            return view('app.admin.register.regcomplete', compact('title', 'sub_title', 'base', 'method', 'purchase_id'));
        } else {
            Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('register.error_in_payment')));
            return Redirect::to('admin/register');
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
                return view('app.admin.register.regcomplete', compact('title', 'sub_title', 'base', 'method', 'purchase_id'));
            } else {
                return redirect('register')->withErrors([trans('register.error_in_payment')]);
                 return redirect("admin/register");
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
        return view('app.admin.register.regcomplete', compact('title', 'sub_title', 'base', 'method', 'purchase_id'));
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
        return view('app.admin.register.regcomplete', compact('title', 'sub_title', 'base', 'method', 'purchase_id'));
    }

    public function ipaycanceled(Request $request)
    {
        return redirect('admin/register')->withErrors([trans('register.error_in_payment')]);
            return redirect("admin/register");
    }

    public function ipayipn(Request $request)
    {

        dd($request->all());
    }

     public function adminregister()
    {

        $title     = trans('registration.create_new_admin');
        $sub_title = trans('registration.create_new_admin');
        $base      = trans('registration.create_new_admin');
        $method    = trans('registration.create_new_admin');
            
        return view('app.admin.register.adminregister', compact('title', 'sub_title', 'base', 'method'));
    }

   public function admin_register(Request $request){

                $data = array();
                $data['firstname'] = $request->firstname;        
                $data['phone']     = $request->phone;
                $data['email']     = $request->email;
                $data['username']  = $request->username;
                $data['password']  = $request->password;
                $data['reg_type']  = 'adminregister';
                $data['user_type'] = $request->user_type;

                    
                $messages = [
                    'unique'    => 'The :attribute already existis in the system',
                    'exists'    => 'The :attribute not found in the system',   
                ];
                $validator = Validator::make($data, [
                    'email' => 'required|unique:users,email|unique:pending_transactions,email|email|max:255',
                    'username' => 'required|unique:users,username|max:255',
                    'password' => 'required|min:6',
                ]);

                if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                } else {

                        DB::beginTransaction();

                            $userresult=User::create([
                                'name'             => $data['firstname'],
                                'email'            => $data['email'],           
                                'username'         => $data['username'],
                                'phone'            => $data['phone'],  
                                'register_by'      => $data['reg_type'],
                                'password'         => bcrypt($data['password']), 
                                'admin'            => 1,
                                'confirmed'        => 1,
                                'active'           => 'yes',
                                'rank_id'          => 1,
                                'user_type'        => $data['user_type']
                            ]);


                            $userProfile=ProfileInfo::create([
                                'user_id'   => $userresult->id,
                                'mobile'    => $data['phone'],  
                            ]);
                        if($data['user_type'] == 'accountant_admin'){
                            $data_array = array(33,36,37,38);
                        }else{
                            $data_array = array(11,12,13,17,22,23,25,26,27,28,37,38,43,44,45,46,47,48);
                        }

                        MyRole::create([
                           'user_id' => $userresult->id,
                           'role_id' => json_encode($data_array)
                           ]);

                       

           
                        DB::commit();
       
                        Session::flash('flash_notification', array('level' => 'success', 'message' =>trans('admin.Your_registration_completed_successfully')));
                        return redirect()->back();
                }
    }
    public function dummyRegisterIndex($placement_id = "")
    {

        $title     = trans('register.register_dummy_member');
        $sub_title = trans('registration.register');
        $base      = trans('registration.register');
        $method    = trans('registration.register');
        $user_registration = option('app.user_registration');
        /**
         * Checking if the current user permitted for accessing the registration page.
         *
         * @var id : Checks against the specified userid-
         * if status set to no will redirect to dashboard with warning message
         * if status set to yes, will proceed
         */

        $status = MenuSettings::find(1);
        if ($user_registration == 3 || $user_registration == 6) {
            Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('register.permission_denied')));
             return redirect()->back();
        } else {
            if ($placement_id) {

              
                /**
                 * if placement id set ,will decrypt and check in tree_table to find it has vacant positions
                 */

                $placement_id  = urldecode(Crypt::decrypt($placement_id));

                
                
                $place_details = Tree_Table::find($placement_id);
                /**
                 * if no vacant positions available under specified placement id,
                 * redirect back without placement id param
                 */

                if ($place_details->type != 'vaccant') {
                    return redirect()->back();
                }
                $placement_user = User::where('id', $place_details->placement_id)->value('username');
                $vaccant_count  = count(Tree_Table::where('placement_id', $place_details->placement_id)->where("type","vaccant")->get());
                $leg            = $place_details->leg;

                // dd($leg);
            } else {
                $placement_id   = Tree_Table::getSponsorVaccantId([Auth::user()->id]);
                $vaccant_count  = count(Tree_Table::where('placement_id', $placement_id)->where("type","vaccant")->get());
                $placement_id   = Tree_Table::where('placement_id', $placement_id)->where("type","vaccant")->value('id');
                $tree_data      = Tree_Table::find($placement_id);
                $placement_user = User::where('id', $tree_data->placement_id)->value('username');
                $leg            = $tree_data->leg;
            }

            $user_details = array();
            $user_details = User::where('username', Auth::user()->username)->get();
            
            

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
            /**
             * Get all packages from database
             * @var [collection]
             */
            $package = Packages::all();
            /**
             * Get joining fee from settings table
             * @var int
             */
            $joiningfee = Settings::value('joinfee');
            /**
             * Get Voucher code from Voucher table
             * @var [type]
             */
            $voucher_code = Voucher::value('voucher_code');
            /**
             * Get all active payment methods from database [payment_type]
             * @var [collection]
             */
            $payment_type = PaymentType::where('status', 'yes')->get();

            $payment_gateway=PaymentGatewayDetails::find(1);

            /**
             * Generate a random string for the transation password for user
             * to keep in database for future use,
             * @var string
             */
            $transaction_pass = self::RandomString();
            /**
             * returns registration view with provided variables
             */

             $product = Product::find(1);
             $shipping_countries = ShoppingCountry::all();
             $shipping_states = ShoppingZone::where('country_id', '=', 129)->get();
            return view('app.admin.register.dummy_register', compact('title', 'sub_title', 'base', 'method', 'package', 'countries', 'states', 'user_details', 'placement_user', 'leg', 'joiningfee', 'voucher_code', 'payment_type', 'transaction_pass', 'shipping_countries', 'shipping_states', 'payment_gateway','product','vaccant_count'));
        }
    }

    /**
     * Once the registration form filled, and on submit, this function will handle the process/
     * @param  Request $request , We do not use laravel specific request file to -
     * validate but in controller itself for easy access
     * @return [array]           [this array will contain all values passed from the registration form]
     */
    public function dummyRegister(Request $request)
    {   
        /**
         * [$data array to hold specified incming request values]
         * @var array
         */
       
        // $userCount  = PendingTransactions::where('username','like',$request->country.'%')->count();
        // $userCount  = $userCount+1;
        // $num_padded = sprintf("%06d", $userCount);
        $num_padded  = rand(10,99);

        // $prod_bv   = Product::find($request->product)->value('bv');
        // $total_bv  = $prod_bv * $request->quantity;
        // $pack_id   = Packages::where('pv','>',$total_bv)->value('id');
        // if($pack_id){
            // $package = $pack_id-1;
        // }
        // else{
            // $max_pv  = Packages::max('pv');
            // $package = Packages::where('pv',$max_pv)->value('id');
        // }

        $package = $request->package;
        $request->payment = 'dummy_reg';
        
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
        
        /**
         * if placement user passed from form
         * (Which will be set as hidden input if placement_id specified and if it has vacant positions ),
         * it will set as placement_user, else the placement will be under sponsor
         *
         */
    
        if ($request->placement_user) {
            $data['placement_user'] = $request->placement_user;
        } else {
            $data['placement_user'] = $request->sponsor;
        }

        /**
         * Validation custom messages
         * @var [array]
         */
        $messages = [
            'unique' => 'The :attribute already existis in the system',
            'exists' => 'The :attribute not found in the system',

        ];
        /**
         * Validating the incoming data we stored the $data variable
         * @var [boolean]
         */
        // dd($data);
        $validator = Validator::make($data, [
            'sponsor'          => 'required|exists:users,username|max:255',
            'placement_user'   => 'sometimes|exists:users,username|max:255',
            'email'            => 'required|unique:pending_transactions,email|unique:users,email|email|max:255',
            'username'         => 'required|alpha_num|max:255',
            'password'         => 'required|min:6',
            'transaction_pass' => 'required|alpha_num|min:6',
            'package'          => 'required|exists:packages,id',
            // 'leg'              => 'required',
            'country'          => 'required|country',
            'file_name'        => 'required|mimes:jpeg,png,jpg'

        ]);
        /**
         * On fail, redirect back with error messages
         */
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {


             /**
             * Checking if sponsor_id exist in users table
             * @var [boolean]
             */
            $sponsor_id = User::checkUserAvailable($data['sponsor']);
            /**
             * Checking if placement_user exist in users table
             * @var [type]
             */
            $placement_id = User::checkUserAvailable($data['placement_user']);
            
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
            $joiningfee = $prod_amount*$data['quantity'];
            $orderid = mt_rand();

           
            $flag=false;
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
          
            $register=PendingTransactions::create([
                     'order_id'       => $orderid,
                     'username'       => $data['username'],
                     'email'          => $data['email'],
                     'sponsor'        => $data['sponsor'],
                     'package'        => $data['package'],
                     'invoice'        => $data['bank_file'],
                     'request_data'   => json_encode($data),
                     'payment_method' => $request->payment,
                     'payment_type'   =>'dummy_reg',
                     'amount'         => $joiningfee,
                     'payment_status' => 'complete',
                    ]);
            $flag=true;
            if ($flag) {
                $title=trans('register.payment_complete');
                $sub_title=trans('register.payment_complete');
                $base=trans('register.payment_complete');
                $method=trans('register.payment_complete');
                $purchase_id=$register->id;
                return view('app.admin.register.regcomplete', compact('title', 'sub_title', 'base', 'method', 'purchase_id'));
            } else {
                Session::flash('flash_notification', array('message'=>trans('register.payment_failure'),'level'=>'warning'));
                return redirect()->back();
            }
        }
    }
    public function processReturnUrl(Request $request){
        // dd($request->all());
        if($request->status_id  == 1)
        {
            PendingTransactions::where('order_id', $request->order_id)->update(['payment_status' => 'complete']) ;
                    $flag=true;
        }
        elseif($request->status_id  == 0)
        {
             Session::flash('flash_notification', array('message'=>trans('register.payment_failure'),'level'=>'warning'));
                return redirect()->back();

        // $secretkey=3438-296;
        // return view('app.user.product.onepagepayment', compact('secretkey'));
        }
    }
    

}
