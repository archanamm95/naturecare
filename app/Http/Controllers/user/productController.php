<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\MatchingBonus;
use App\Balance;
use App\User;
use App\Packages;
use App\Commission;
use App\stripeCustomer;
use App\Transactions;
use App\Sponsortree;
use App\PurchaseHistory;
use App\Ranksetting;
use App\Sales;
use App\PointTable;
use App\DirectSposnor;
use App\RsHistory;
use App\LeadershipBonus;
use App\payout_gateway_details;
use App\Tree_Table;
use App\UserDebit;
use App\Currency;
use App\Voucher;
use App\BillingAddress;
use App\VoucherHistory;
use Auth;
use Session;
use Input;
use Validator;
use App\ProfileModel;
use App\ProfileInfo;
use App\Product;
use App\Productaddcart;
use App\ShoppingCountry;
use App\ShoppingZone;
use App\Order;
use App\PaymentType;
use App\PendingTransactions;
use App\StockManagement;
use DB;
use Redirect;
use App\DeliveryTrackingDetails;
use App\Shippingaddress;
use App\Orderproduct;
use App\InvoiceTable;
use App\Settings;
use App\AppSettings;
use App\PaymentGatewayDetails;
use Crypt;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Account;
use Stripe\Token;
use Srmklive\PayPal\Services\ExpressCheckout;
use Rave;
use App\Http\Controllers\user\UserAdminController;
use CountryState;

class productController extends UserAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      private $api_context;
    protected static $provider;

    public function __construct()
    {
         parent::__construct();
         self::$provider = new ExpressCheckout;
    }

    public function index()
    {
        

        $plan_id=ProfileModel::where('user_id', Auth::user()->id)->value('package');
        $package = Packages::where('id', '>', $plan_id)->get();
        $product = Product::find(1);
        $title = trans('products.purchase_plan');
        $sub_title =  trans('products.purchase_plan');
        $rules = ['count' => 'required|min:1'];
        $base =  trans('products.purchase_plan');
        $method =  trans('products.purchase_plan');
        $balance =  Balance::where('user_id', Auth::user()->id)->value('balance');
        $min_amount =  Packages::min('amount');
        $payment_gateway=PaymentGatewayDetails::find(1);
        $joiningfee = Settings::value('joinfee');
        $countries = CountryState::getCountries();
        $states = CountryState::getStates('MY');
        $shipping_countries = ShoppingCountry::all();
        $shipping_states = ShoppingZone::where('country_id', '=', 129)->get();
        $payment_type=PaymentType::where('status', 'yes')->where('id','!=',6)->get();
        $BillingAddress = BillingAddress::where('user_id',Auth::user()->id)->first();
        $Shippingaddress = Shippingaddress::where('user_id',Auth::user()->id)->where('option_type',1)->first();
        $userData        = User::join('profile_infos','profile_infos.user_id','users.id')->where('users.id',Auth::user()->id)->select('name','email','mobile')->first();

        return view('app.user.product.index', compact('title', 'package', 'rules', 'base', 'method', 'sub_title', 'balance', 'min_amount', 'payment_gateway','joiningfee','product','shipping_countries','countries','shipping_states','states','payment_type','BillingAddress','Shippingaddress','userData'));
    }


    public function purchasehistory()
    {
        $data = PurchaseHistory::join('packages', 'packages.id', '=', 'purchase_history.package_id')
                 ->where('user_id', Auth::user()->id)
                 ->select('packages.package as package', 'count', 'total_bv', 'total_amount', 'purchase_history.created_at', 'purchase_history.pv', 'purchase_history.pay_by','purchase_history.shipping_country','purchase_history.invoice_id','purchase_history.order_status','purchase_history.id')
                 ->orderBy('purchase_history.id', 'DESC')
                 ->where('type','product')
                 ->where('purchase_type','!=','shop_purchase')
                 ->paginate(10);

        $package_data = Packages::all();

           
        $title = trans('products.purchase_history');
        $sub_title = trans('products.purchase_history');
        $base = trans('products.purchase_history');
        $method = trans('products.purchase_history');
        return view('app.user.product.purchase-history', compact('title', 'data', 'base', 'method', 'sub_title','package_data'));
    }   
     public function stockhistory()
    {
       
        $title     = trans('products.stock_history');
        $sub_title = trans('products.stock_history');
        $base      = trans('products.stock_history');
        $method    = trans('products.stock_history');

        $stock      = StockManagement::where('user_id',Auth::user()->id)
                    ->join('share_partners','share_partners.id','stock_management.product_id')
                    ->select('stock_management.product_id','stock_management.in','stock_management.out','stock_management.balance','share_partners.Products')
                    ->get();
                    // dd($stock);
      
        
           
        return view('app.user.product.stock-history', compact('title', 'sub_title','base', 'method', 'stock'));
    }     
    public function shophistory()
    {


         $data = PurchaseHistory::join('users', 'users.id', '=', 'purchase_history.user_id')
                 ->join('users as seller_user', 'seller_user.id', '=', 'purchase_history.seller_id')
                 ->join('packages','packages.id','purchase_history.package_id')
                 ->where('purchase_history.user_id', Auth::user()->id)
                 ->select('purchase_history.id', 'purchase_history.total_amount', 'purchase_history.product_name','purchase_history.package_id','purchase_history.created_at', 'purchase_history.pay_by','purchase_history.shipping_country','purchase_history.invoice_id','purchase_history.tracking_id','purchase_history.count','seller_user.username as seller_name','packages.package as packagename','purchase_history.type')
                 // ->GroupBy('purchase_history.invoice_id')
                 // ->orderBy('purchase_history.id', 'DESC')
                 ->get();
                       
            $report = [] ;

            $sum=0;
                   
                foreach ($data as $key => $value) {

                    $report[$value->invoice_id]['product'][] = $value->product_name ; 
                    $report[$value->invoice_id]['price'][] = $value->total_amount ; 
                    $report[$value->invoice_id]['count'][] = $value->count ; 
                    $report[$value->invoice_id]['invoice'] = $value->invoice_id ; 
                    $report[$value->invoice_id]['date'] = $value->created_at ; 
                    $report[$value->invoice_id]['seller'] = $value->seller_name ; 
                    $report[$value->invoice_id]['pay_by'] = $value->pay_by ; 
                    $report[$value->invoice_id]['tracking_id'] = $value->tracking_id ; 

                    $sum=$sum + $value->total_amount  ; 
                }
        // dd($report);

       // $seller = PurchaseHistory::join('users', 'users.id', '=','purchase_history.seller_id')
       //                            ->select('users.username')->get();
    
        $title = trans('products.order_history');
        $sub_title = trans('products.order_history');
        $base = trans('products.shop_history');
        $method = trans('products.shop_history');
        // dd($data);
        return view('app.user.product.shop-history', compact('title', 'report', 'base', 'method', 'sub_title','sum'));
    }



        public function salehistory()
        {

         $data = PurchaseHistory:: where('purchase_history.seller_id', Auth::user()->id)
                 // ->join('users', 'users.id', 'purchase_history.seller_id')
                 ->join('users as purchased_user', 'purchased_user.id','purchase_history.user_id')
                 ->where('purchased_user.user_type','Customer')
                 ->where('purchase_history.user_id','!=', Auth::user()->id)
                 ->select('purchase_history.id', 'purchase_history.total_amount', 'purchase_history.created_at', 'purchase_history.pay_by','purchase_history.product_name','purchase_history.shipping_country','purchase_history.invoice_id','purchase_history.order_status','purchase_history.tracking_id','purchase_history.count','purchased_user.username as purchaseduser_name','purchased_user.name','purchased_user.lastname','purchase_history.type')
                 // ->GroupBy('purchase_history.invoice_id')
                 // ->orderBy('purchase_history.id', 'DESC')
                 ->get();
            $report = [] ;
            $sum=0;
// dd($data);
                   
                foreach ($data as $key => $value) {

                    $report[$value->invoice_id]['product'][] = $value->product_name ; 
                    $report[$value->invoice_id]['price'][] = $value->total_amount ; 
                    $report[$value->invoice_id]['count'][] = $value->count ; 
                    $report[$value->invoice_id]['invoice'] = $value->invoice_id ; 
                    $report[$value->invoice_id]['date'] = $value->created_at ; 
                    $report[$value->invoice_id]['buyeremail'] = $value->purchaseduser_name ; 
                    $report[$value->invoice_id]['buyername'] = $value->name ;
                    $report[$value->invoice_id]['buyerlastname'] = $value->lastname ;
                    $report[$value->invoice_id]['pay_by'] = $value->pay_by ; 
                    $report[$value->invoice_id]['tracking_id'] = $value->tracking_id ;
                    $report[$value->invoice_id]['total_price'][] = $value->total_amount*$value->count; 

                    $sum+=$value->total_amount; 

                    $report[$value->invoice_id]['total'] = $sum ;

                }
               
        // dd($report);
    
        $title = 'Sales History';
        $sub_title = 'Sales History';
        $base = 'Sales History';
        $method ='Sales History';
        // return $report;
        return view('app.user.product.sale_history', compact('title', 'report', 'base', 'method', 'sub_title','sum'));
     }

      public function customer_list()
       {
        // dd(1);
         $data = PurchaseHistory:: where('purchase_history.seller_id', Auth::user()->id)
                 ->join('users', 'users.id', 'purchase_history.seller_id')
                 ->join('users as purchased_user', 'purchased_user.id','purchase_history.user_id')
                 ->where('purchased_user.user_type','Customer')
                 ->join('profile_infos', 'profile_infos.user_id','purchase_history.user_id')
                 ->select( 'purchased_user.id', 'purchased_user.name', 'purchased_user.lastname', 'purchased_user.username','purchased_user.email','purchased_user.status','purchased_user.user_type','profile_infos.*')
                 ->GroupBy('purchase_history.user_id')
                 ->get();
        // dd($data);
           
    
        $title = 'Customer List';
        $sub_title = 'Customer List';
        $base = 'Customer List';
        $method ='Customer List';
        // dd($data);
        return view('app.user.product.customer_list', compact('title', 'data', 'base', 'method', 'sub_title'));
     }



    public function purchase(Request $request)
    {   
        $validator = Validator::make($request->all(), [
           
            'payment'=>'required|min:1' ,
            'package'=>'required|exists:packages,id' ,
            ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
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
            $flag=false;

            $data['payment']                = $request->payment;
            $data['package']                = $package;
            $data['product']                = $request->product;
            $data['quantity']               = $request->quantity;
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



            $payment_gateway=PaymentGatewayDetails::find(1);
            $prod_amount = Product::where('id',$request->product)->value('price');
  
            $joiningfee  = $prod_amount*$request->quantity;
            $orderid = mt_rand();
            $joiningfee  = $prod_amount*$request->quantity;
            $sponsor_id = Sponsortree::where('user_id',Auth::user()->id)->value('sponsor');
            $sponsorname = User::find($sponsor_id)->username;
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
                    return Redirect::to('user/purchase-plan');
                }
                $flag=true;
            }
            $plan_upgrade=PendingTransactions::create([

                 'order_id' =>$orderid,
                 'user_id' =>Auth::user()->id,
                 'username' =>Auth::user()->username,
                 'email' =>Auth::user()->email,
                 'sponsor' => $sponsorname,
                 'package' =>$package,
                 'request_data' =>json_encode($data),
                 'payment_method'=>$request->payment,
                 'payment_type' =>'shop_purchase',
                 'payment_code'   => $data['payment_date'],
                 'amount' => $joiningfee,
                 'invoice'      => $request->payment == 'bankwire' ? $data['bank_file'] : "Na",
            ]);

            if ($request->payment == 'senangpay') {
                $senag_data=payout_gateway_details::select('merchant_id','secret_key')->where('id',1)->first();
                $merchant_id=$senag_data->merchant_id;
                $secretkey=$senag_data->secret_key;
                $joiningfee=$joiningfee;
                $orderidd=$orderid;

                return view('auth.senangpayPaymentPage',compact('joiningfee','orderidd','merchant_id','secretkey'));
            }
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
                    PendingTransactions::where('id', $plan_upgrade->id)->update(['payment_status' => 'complete']) ;
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
            if ($request->payment == "ewallet") {
                $balance=Balance::where('user_id', Auth::user()->id)->value('balance');
                if ($balance >= $joiningfee) {
                    Balance::where('user_id', Auth::user()->id)->decrement('balance', $joiningfee);
                    PendingTransactions::where('id', $plan_upgrade->id)->update(['payment_status' => 'complete']) ;
                    $flag=true;
                }
            }
            if ($flag) {
                if($request->payment == 'bankwire'){
                    Session::flash('flash_notification', array('message'=> 'Your Plan Purchase Successful! Admin need to Aprove your bankwire transaction','level'=>'success'));
                    return redirect()->back();
                }
                $title=trans('register.payment_complete');
                  $sub_title=trans('register.payment_complete');
                  $base=trans('register.payment_complete');
                  $method=trans('register.payment_complete');
                $purchase_id=$plan_upgrade->id;
                return view('app.user.product.purchasecomplete', compact('title', 'sub_title', 'base', 'method', 'purchase_id'));
            } else {
                Session::flash('flash_notification', array('message'=>trans('register.plan_purchase_failure'),'level'=>'warning'));
                return redirect()->back();
            }
        }
    }
    public function onlinestore()
    {
        $title="Online Store";
        $sub_title="Online Store";
        $method="Online Store";
        $product=Product::select('id', 'name', 'price', 'image', 'quantity')
                    ->where('product.quantity', '>', 0)
                    ->get();
        $cart= productaddcart::join('product', 'product.id', '=', 'productaddcart.product_id')
                    ->where('product.quantity', '>', 0)
                    ->where('productaddcart.user_id', '=', Auth::user()->id)
                    ->select('product.*', 'productaddcart.*')
                    ->get();
        $cart_amount = productaddcart::join('product', 'product.id', '=', 'productaddcart.product_id')
                    ->select(DB::raw('sum(productaddcart.cart_quantity*product.price) AS total_price'))
                    ->where('productaddcart.order_status', '=', 'pending')
                    ->where('productaddcart.user_id', '=', Auth::user()->id)
                    ->get();

        $cart_amount = $cart_amount[0]->total_price;
        $products = productaddcart::join('product', 'product.id', '=', 'productaddcart.product_id')
                                ->select('product.name', 'productaddcart.cart_quantity', 'productaddcart.id')
                                ->where('productaddcart.order_status', '=', 'pending')
                                ->where('productaddcart.user_id', '=', Auth::user()->id)
                                ->get();

        return view('app.user.product.onlinestore', compact('title', 'sub_title', 'method', 'product', 'cart', 'cart_amount', 'products'));
    }
    public function add_to_cart(Request $request)
    {
        if ($request->cart_quantity < 1) {
            Session::flash('flash_notification', array('level' => 'danger', 'message' => 'Please select a count greater than 1'));
            return redirect()->back();
        }
        $product=product::where('id', $request->product_id)
                    ->whereNull('deleted_at')
                    ->select('id', 'name', 'image', 'price', 'quantity', 'description', 'status')
                    -> get();

        $productaddcart = productaddcart::firstOrNew(['product_id' => $request->product_id,'user_id'=>Auth::user()->id]);
        $productaddcart->cart_quantity =$request->cart_quantity ;
        $productaddcart->save();
        $reponse = productaddcart::join('product', 'product.id', '=', 'productaddcart.product_id')
                    ->select('product.name', 'product.image', 'product.status', 'product.price', 'productaddcart.*')
                    ->where('productaddcart.user_id', '=', Auth::user()->id)
                    ->get();
        Session::flash('flash_notification', array('level' => 'success', 'message' => 'Product added successfully'));
        return redirect()->back();
    }
    public function shipping(Request $request)
    {
     
        $title = "Shipping Address";
        $sub_title = "Shipping Address";
        $method = "Shipping Address";
        if (isset($request->option)) {
            $title = "Order Confirmation";
            $Country = ShoppingCountry::get();
            $state = ShoppingCountry::where('shopping_country.iso_code_2', "MY")
             ->join('shopping_zone', 'shopping_country.country_id', '=', 'shopping_zone.country_id')
             ->get();
            $amount = productaddcart::join('product', 'product.id', '=', 'productaddcart.product_id')
            ->select(DB::raw('sum(productaddcart.cart_quantity*product.price) AS total_price'), 'cart_quantity', 'product.name')
            ->where('productaddcart.order_status', '=', 'pending')
            ->where('productaddcart.user_id', '=', Auth::user()->id)
            ->get();
          // $current_package = ProfileInfo::where('user_id','=',Auth::user()->id)->value('package');
          // $package = Packages::find($current_package);
            $price = $amount[0]->total_price;
            $quantity = $amount[0]->cart_quantity;
            $balace_ewallet = Balance::where('user_id', '=', Auth::user()->id)->value('balance');
            $option = $request->option;
            $profile_info = ProfileInfo::where('user_id', '=', Auth::user()->id)->select('country', 'state', 'city', 'zip', 'address1', 'address2')->first();
            $default_details = User::where('id', '=', Auth::user()->id)->first();
            $country = $default_details->shipping_country;
            $user_state = $default_details->shipping_state;
            $street = $profile_info->city;
            $zip = $profile_info->zip;
            $address1 = $profile_info->address1;
            $address2 = $profile_info->address2;
            $full_name = $default_details->name;
            $def_email = $default_details->email;
            $def_mob = $default_details->mobile;
            if (is_numeric($country)) {
                $country = ShoppingCountry::where('country_id', $country)->value('name');
            } else {
                $country = $country;
            }

            if (is_numeric($user_state)) {
                $state = ShoppingZone::where('zone_id', '=', $user_state)->select('name', 'shipping_cost')->first();
            } else {
                $state = ShoppingZone::where('name', '=', $user_state)->select('name', 'shipping_cost')->first();
            }

            $countries = ShoppingCountry::all();
            $statess = ShoppingZone::where('country_id', '=', 129)->get();
            $shipping_state_cost =$state->shipping_cost;
            return view('app.user.product.shippingaddress', compact('title', 'sub_title', 'method', 'Country', 'state', 'quantity', 'balace_ewallet', 'option', 'country', 'user_state', 'street', 'zip', 'countries', 'address1', 'address2', 'statess', 'full_name', 'def_email', 'def_mob', 'shipping_state_cost', 'price'));
        } else {
            Session::flash('flash_notification', array('level'=>'danger','message'=>'Please Select an Option'));
            return Redirect::back();
        }
    }
    // public function saveShippingRequest($id, $fname, $email, $contact, $country, $state, $city, $address, $pincode, $option, $ic_number, $payment, $my_feed_back, $total_amount, $shipping_amount)
    // {

    //     $tracking = DeliveryTrackingDetails::create([
    //     'status' =>'shipped',
    //     ]);

    //     if ($payment == 'bank_transfer') {
    //         $shipping_status = 'pending';
    //         $invoice_status = 'Pending';
    //     } else {
    //         $shipping_status = 'shipped';
    //         $invoice_status = 'Paid';
    //     }
    //     $address_details=shippingaddress::create([
    //                   'user_id'=>$id,
    //                   'payment'=>$payment,
    //                   'tracking_id' => $tracking->id,
    //                   'option_type' => $option,
    //                   'fname'=>$fname,
    //                   // 'lname'=>$lname,
    //                   'email'=>$email,
    //                   'contact'=>$contact,
    //                   'ic_number'=>$ic_number,
    //                   'country'=>$country,
    //                   'state'=>$state,
    //                   'city'=>$city,
    //                   'address'=>$address,
    //                   'pincode'=>$pincode,
    //                   'status'=>$shipping_status,
    //                   'my_feed_back'=>$my_feed_back,
    //                 ]);
    //     $product = product::join('productaddcart', 'product.id', '=', 'productaddcart.product_id')
    //               ->select('productaddcart.*', 'product.*')
    //               ->where('productaddcart.order_status', '=', 'pending')
    //               ->where('productaddcart.user_id', '=', Auth::user()->id)
    //               ->whereNull('productaddcart.deleted_at')
    //               ->get();
    //     $sum=0;
    //     $total_count=0;
    //     $total_pv=0;

    //     foreach ($product as $key => $value) {
    //         $sum =$sum +($value->price*$value->cart_quantity);
    //         $total_count=$total_count + ($value->cart_quantity);
    //         $total_pv=$total_pv + ($value->pvprice*$value->cart_quantity);
    //     }
    //     $sum=$sum+$shipping_amount;
    //     $order_table = order::create([
    //     'user_id'=>Auth::user()->id,
    //     'total_amount'=>$sum,
    //     'total_count'=>$total_count,
    //     'total_pv'=>$total_pv,
    //     'shipping_id'=>$address_details->id,
    //     ]);
    //     $order=$order_table->id;
    //     shippingaddress::where('id', $address_details->id)->update(['order_id'=>$order]);
    //     $per_shipping_amount = $shipping_amount/$total_count;
    //     foreach ($product as $key2 => $value) {
    //         orderproduct::create([
    //         'order_id'=>$order,
    //         'product_id'=>$value->product_id,
    //         'user_id'=>Auth::user()->id,
    //         'count'=>$value->cart_quantity,
    //         'amount'=>($value->cart_quantity)*($value->price)+($value->cart_quantity)*$per_shipping_amount,
    //         'pv'=>($value->cart_quantity)*($value->pvprice),
    //         ]);
    //     }
    //     $date = date('Ymd');
    //     $count = InvoiceTable::whereDate('created_at', '=', date('Y-m-d'))->count();
    //     $count = $count + 1;
    //     InvoiceTable::create([
    //     'user_id'=>Auth::user()->id,
    //     'order_id'=>$order,
    //     'invoice_id'=>'INV-'.$date.'-'.$count,
    //     'status'=>$invoice_status,
    //     ]);

    //     $list_orders = orderproduct::where('order_id', '=', $order)->get();
    //     foreach ($list_orders as $key => $list_order) {
    //         $total_product_count = product::where('id', '=', $list_order->product_id)->value('quantity');
    //         $pro_purchased_count = $list_order->count;
    //         if ($total_product_count >=  $pro_purchased_count) {
    //             $dec=$total_product_count - $pro_purchased_count;
    //             product::where('id', '=', $list_order->product_id)->update(['quantity'=>$dec]);
    //         } else {
    //              product::where('id', '=', $list_order->product_id)->update(['quantity'=>0]);
    //         }
    //     }
  
     
    //     productaddcart::where('user_id', Auth::user()->id)->where('order_status', '=', "pending")->update(['order_status'=>'complete']);
    //     $current_date=date('Y-m-d H:i:s');

    //     productaddcart::where('user_id', '=', Auth::user()->id)->update(['deleted_at'=>$current_date]);

                
    //     $app_settings = AppSettings::find(1);

    //     $user_details = User::where('id', Auth::user()->id)->first();
    //     $shippingaddress = shippingaddress::where('id', $address_details->id)->first();

    //     $product_details = orderproduct::join('product', 'product.id', '=', 'orderproduct.product_id')->where('orderproduct.order_id', $order)->select('product.name', 'orderproduct.amount', 'orderproduct.count', 'product.price')->get();


    //     $order_details = order::where('id', $order)->select('total_amount', 'total_count')->get();
    //     $invoice_id = InvoiceTable::where('order_id', $order)->pluck('invoice_id');
       
    //     return $address_details;
    // }

    public function shippingcreation(Request $request)
    {

        $product = product::join('productaddcart', 'product.id', '=', 'productaddcart.product_id')
                                    ->select('productaddcart.*', 'product.*')
                                    ->where('productaddcart.order_status', '=', 'pending')
                                    ->where('productaddcart.user_id', '=', Auth::user()->id)
                                    ->whereNull('productaddcart.deleted_at')
                                    ->get();

        foreach ($product as $key => $value) {
            if ($value->cart_quantity > $value->quantity) {
                return Redirect::action('user\productController@onlinestore')->withErrors('Insufficient Quantity');
            }
        }
        $product_quantity=$product[0]->cart_quantity;
        $product_price=$product[0]->price;
                         
        if ($request->option == 1) {
            if ($request->radio_address == 1) {
                $data = array();
                $data['fname']=$request->fname1;
                $data['phone'] = $request->contact1;
                $data['email'] = $request->email1;
                $data['country'] = $request->country1;
                $data['state'] = $request->state1;
                $data['city'] = $request->city1;
                $data['address'] = $request->address1;
                $data['zip'] = $request->pincode1;
            } elseif ($request->radio_address == 2) {
                $data = array();
                $data['fname']=$request->fname2;
                // $data['lname'] = $request->lname2;
                $data['phone'] = $request->contact2;
                $data['email'] = $request->email2;
                $data['country'] = $request->country2;
                $data['state'] = $request->state2;
                $data['city'] = $request->city2;
                $data['address'] = $request->address2;
                $data['zip'] = $request->pincode2;
            }

            if (is_numeric($data['country'])) {
                $scountry = ShoppingCountry::where('country_id', $data['country'])->value('name');
            } else {
                $scountry = $data['country'];
            }
            if (is_numeric($data['state'])) {
                $sstate = ShoppingZone::where('zone_id', '=', $data['state'])->select('name', 'shipping_cost')->first();
            } else {
                $sstate = ShoppingZone::where('name', '=', $data['state'])->select('name', 'shipping_cost')->first();
            }
            $data['shipping_country'] = $scountry ;
            $data['shipping_state'] = $sstate->name ;



            if (is_numeric($data['state'])) {
                $shipping_cost = ShoppingZone::where('zone_id', '=', $data['state'])->value('shipping_cost');
                $new_shipping_cost = $request->quantity*$shipping_cost;
            } else {
                $shipping_cost = ShoppingZone::where('name', '=', $data['state'])->value('shipping_cost');
                $new_shipping_cost = $request->quantity*$shipping_cost;
            }
            $request->total_amount = $request->PAYMENTREQUEST_0_ITEMAMT+$new_shipping_cost;


            $messages = [
            'unique'    => 'The :attribute already existis in the system',
            'exists'    => 'The :attribute not found in the system',
            ];
            $validator = Validator::make($data, [
            
            'fname' => 'required',
            // 'lname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'zip' => 'required',
            
            ]);

            if ($validator->fails()) {
                return Redirect::action('user\productController@onlinestore')->withErrors($validator);
            }
        }

        $total_price=productaddcart::join('product', 'product.id', '=', 'productaddcart.product_id')
                      ->select(DB::raw('sum(productaddcart.cart_quantity*product.price) AS total_price'))
                      ->where('productaddcart.order_status', '=', 'pending')
                      ->where('productaddcart.user_id', '=', Auth::user()->id)
                      ->get();
        $select_payment=$request->payment;
        $total_price = $request->total_amount;
        $request->ic_number = 1;

        if ($request->payment == 'ewallet') {
            $balance=Balance::where('user_id', Auth::user()->id)->value('balance');
            if ($balance>=$request->total_amount) {
                Balance::where('user_id', Auth::user()->id)->decrement('balance', $request->total_amount);
            } else {
                Session::flash('flash_notification', array('level' => 'danger', 'message' => "Insufficient fund !!!"));
                return Redirect::action('user\productController@onlinestore');
            }

            if ($request->option == 2) {
                $data = User::join('profile_infos', 'profile_infos.user_id', '=', 'users.id')
                    ->where('users.id', '=', Auth::user()->id)
                    ->select('users.name', 'users.lastname', 'users.email', 'profile_infos.*')->first();

                $country = ShoppingCountry::where('country_id', $scountry)->value('name');
                dd($scountry);
                $state = ShoppingZone::where('zone_id', '=', $sstate)->value('name');

                if ($state == null) {
                    $state = ShoppingZone::where('name', '=', $sstate)->value('name');
                }
                if (is_numeric($data['state'])) {
                    $shipping_cost = ShoppingZone::where('zone_id', '=', $data['state'])->value('shipping_cost');
                    $new_shipping_cost = $request->quantity*$shipping_cost;
                } else {
                    $shipping_cost = ShoppingZone::where('name', '=', $data['state'])->value('shipping_cost');
                    $new_shipping_cost = $request->quantity*$shipping_cost;
                }
                self::saveShippingRequest(Auth::user()->id, $data['fname'], $data['email'], $$data['phone'], $data['shipping_country'], $data['shipping_state'], $data['city'], $data['address'], $data['zip'], $request->option, $data->passport, $request->payment, $request->my_feed_back1, $request->PAYMENTREQUEST_0_ITEMAMT, $new_shipping_cost);
            } else {
                self::saveShippingRequest(Auth::user()->id, $data['fname'], $data['email'], $data['phone'], $data['shipping_country'], $data['shipping_state'], $data['city'], $data['address'], $data['zip'], $request->option, $request->ic_number, $request->payment, $request->my_feed_back1, $request->PAYMENTREQUEST_0_ITEMAMT, $new_shipping_cost);
            }

            $package = ProfileInfo::where('user_id', Auth::user()->id)->value('package');
            $package = Packages::find($package);
            $id = shippingaddress::where('user_id', Auth::user()->id)->max('id');
            $sponsor_id = Sponsortree::where('user_id', Auth::user()->id)->value('sponsor');
            $sponsor_pack = ProfileInfo::where('user_id', $sponsor_id)->value('package');
            $my_pack = ProfileInfo::where('user_id', Auth::user()->id)->value('package');
            return  redirect("user/orderconfirm/".Crypt::encrypt($id).'/'.$select_payment);
        }
    }
    public function orderconfirm($idencrypt, $payment)
    {
      //dd(Crypt::decrypt($idencrypt));
        $title="Order Confirmation";
        $sub_title="Order Confirmation";
        $method="Order Confirmation";
        $user=shippingaddress::where('id', '=', Crypt::decrypt($idencrypt))->first();
        //dd($user);
        $country  = $user->country;
        $fname  = $user->fname;
        $lname  = $user->lname;
        $state  = $user->state;
        $contact  = $user->contact;
        $email  = $user->email;
        $address  = $user->address;
        $city  = $user->city;

        $max_id=order::where('user_id', Auth::user()->id)->max('id');
        $total = order::where('user_id', Auth::user()->id)
                      ->where('id', $max_id)->get();


        Session::flash('flash_notification', array('level' => 'success', 'message' =>"Your order has been placed successfully"));
        
        return view('app.user.product.orderconfirm', compact('title', 'sub_title', 'method', 'user', 'country', 'fname', 'total', 'lname', 'state', 'contact', 'email', 'address', 'city'));
    }


 



    public function sales()
    {

        $title="My Order";
        $sub_title="My Order";
        $method="My Order";
        $cart = order::where('order.user_id', Auth::user()->id)
        ->join('invoice_table', 'invoice_table.order_id', '=', 'order.id')
        ->select('invoice_table.id', 'invoice_table.invoice_id', 'invoice_table.created_at', 'order.total_amount', 'invoice_table.bank_slip', 'invoice_table.status', 'invoice_table.payment_details')
        ->get();

       
        return view('app.user.product.sales', compact('title', 'sub_title', 'method', 'cart', 'shipping_cost'));
    }


    public function viewmore($id)
    {
        $title="view order";
        $base="view order";
        $method="view order";
        $sub_title="view order";
       
        $product=InvoiceTable::where('order_id', '=', $id)->select('*')->paginate(5);
        $product_list=orderproduct::join('product', 'orderproduct.product_id', '=', 'product.id')
                                ->select('product.name', 'orderproduct.order_id', 'orderproduct.count')
                                ->where('orderproduct.order_id', '=', $id)
                                ->get();

       
        return view('app.user.product.viewmore', compact('title', 'product', 'category', 'product_list', 'base', 'method', 'sub_title'));
    }
    public function deletecart($id)
    {
        $product=productaddcart::where('id', $id)->delete();
       
        Session::flash('flash_notification', array('level'=>'danger','message'=>'Product Removed From Cart'));

        return  redirect()->back();
    }


    public function purcompletestatus(Request $request, $paymentid)
    {

        $item = PendingTransactions::where('id', $paymentid)->first();

        if (is_null($item)) {
            return response()->json(['valid' => false]);
        } elseif ($item->payment_status == 'finish') {
            return response()->json(['valid' => true,'status'=>$item->payment_status,'id'=>Crypt::encrypt($item->id)]);
        } else {
             return response()->json(['valid' => true,'status'=>$item->payment_status,'id'=>null]);
        }
        
        return response()->json(['valid' => false]);
    }

   

    public function purcompleteview($idencrypt)
    {
        $title=trans('products.purchase_success');
        $sub_title=trans('products.purchase_success');
        $base=trans('products.purchase_success');
        $method=trans('products.purchase_success');
      
        return view('app.user.product.purchasesuccess', compact('title', 'sub_title', 'base', 'method'));
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


    public function planpurchasepaypal(Request $request, $id)
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
            $purchase_id=$item->id;
            $title=trans('products.payment_complete');
            $sub_title=trans('products.payment_complete');
            $base=trans('products.payment_complete');
            $method=trans('products.payment_complete');
            return view('app.user.product.purchasecomplete', compact('title', 'sub_title', 'base', 'method', 'purchase_id'));
        } else {
            Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('products.error_in_payment')));
            return Redirect::to('user/purchase-plan');
        }
    }

    public function raveplanpurchase(Request $request)
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
                $purchase_id=$rave_det->id;
                $title=trans('products.payment_complete');
                $sub_title=trans('products.payment_complete');
                $base=trans('products.payment_complete');
                $method=trans('products.payment_complete');
                return view('app.user.product.purchasecomplete', compact('title', 'sub_title', 'base', 'method', 'purchase_id'));
            } else {
                return redirect('user/purchase-plan')->withErrors([trans('products.error_in_payment')]);
            }
        } else {
            return redirect("user/purchase-plan")->withErrors([trans('products.error_in_payment')]);
        }
    }

    public function skrillplansuccess(Request $request, $id)
    {
          
        $item = PendingTransactions::find($id);
        $item->payment_response_data = json_encode($request->all());
        $item->payment_status  ='complete';
        $item->save();
        $purchase_id=$item->id;
        $title=trans('products.payment_complete');
        $sub_title=trans('products.payment_complete');
        $base=trans('products.payment_complete');
        $method=trans('products.payment_complete');
        return view('app.user.product.purchasecomplete', compact('title', 'sub_title', 'base', 'method', 'purchase_id'));
    }

     

    public function ipayghplansuccess(Request $request, $id)
    {

        $item = PendingTransactions::find($id);
        $item->payment_response_data = json_encode($request->all());
        $item->payment_status  ='complete';
        $item->save();
        $purchase_id=$item->id;
        $title=trans('products.payment_complete');
        $sub_title=trans('products.payment_complete');
        $base=trans('products.payment_complete');
        $method=trans('products.payment_complete');
        return view('app.user.product.purchasecomplete', compact('title', 'sub_title', 'base', 'method', 'purchase_id'));
    }

    public function ipayghplancanceled(Request $request)
    {

        return redirect('user/purchase-plan')->withErrors([trans('products.error_in_payment')]);
        return redirect("user/purchase-plan");
    }

    public function ipayghplanipn(Request $request)
    {

        dd($request->all());
    }
    public function shopIndex()
    {
        

        $product = Product::find(1);
        $title = trans('products.shop');
        $sub_title =  trans('products.shop');
        $base =  trans('products.shop');
        $method =  trans('products.shop');
        $payment_gateway=PaymentGatewayDetails::find(1);
        $joiningfee = Settings::value('joinfee');
        $countries = CountryState::getCountries();
        $BillingCountry = BillingAddress::where('user_id',Auth::user()->id)->value('country');
        $states = CountryState::getStates($BillingCountry);
        $shoppingCountry = Shippingaddress::where('user_id',Auth::user()->id)->value('country');
        $shopstates = CountryState::getStates($shoppingCountry);
        $shipping_countries = ShoppingCountry::all();
        $shipping_states = ShoppingZone::where('country_id', '=', 129)->get();
        $payment_type=PaymentType::where('status', 'yes')->where('id','!=',6)->get();
        $BillingAddress = BillingAddress::where('user_id',Auth::user()->id)->first();
        $Shippingaddress = Shippingaddress::where('user_id',Auth::user()->id)->where('option_type',1)->first();
        $balance =  Balance::where('user_id', Auth::user()->id)->value('balance');
        $userData = User::join('profile_infos','profile_infos.user_id','users.id')->where('users.id',Auth::user()->id)->select('name','email','mobile')->first();

        return view('app.user.product.shopIndex', compact('title', 'base', 'method', 'sub_title', 'payment_gateway','joiningfee','product','shipping_countries','countries','shipping_states','states','payment_type','BillingAddress','Shippingaddress','shopstates','balance','userData'));
    }
    public function purchaseShop(Request $request)
    {   
        $validator = Validator::make($request->all(), [
           
            'payment'=>'required|min:1' ,
            ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
           
            $flag=false;
            $data['fname']                  = $request->firstname;
            $data['email']                  = $request->email;
            $data['phone']                  = $request->phone;
            $data['payment']                = $request->payment;
            $data['product']                = $request->product;
            $data['quantity']               = $request->quantity;
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
               
                $data['shipping_firstname'] = $request->shipping_firstname ;
                $data['shipping_lastname']  = $request->shipping_lastname ;
                $data['shipping_address']   = $request->shipping_address ;
                $data['shipping_address2']  = $request->shipping_address2 ;
                $data['shipping_city']      = $request->shipping_city ;
                $data['shipping_zip']       = $request->shipping_zip ;
                $data['shipping_country']   = $request->shipping_country;
                $data['shipping_state']     = $request->shipping_state ;
            }
            // dd($data);

        if (is_numeric($data['shipping_state'])) {
            $shipping_cost = ShoppingZone::where('zone_id', '=', $data['shipping_state'])->value('shipping_cost');
            $new_shipping_cost = $request->quantity*$shipping_cost;
        } else {
            $shipping_cost = ShoppingZone::where('name', '=', $data['shipping_state'])->value('shipping_cost');
            $new_shipping_cost = $request->quantity*$shipping_cost;
        }

             $total_price=productaddcart::join('product', 'product.id', '=', 'productaddcart.product_id')
                      ->select(DB::raw('sum(productaddcart.cart_quantity*product.price) AS total_price'))
                      ->where('productaddcart.order_status', '=', 'pending')
                      ->where('productaddcart.user_id', '=', Auth::user()->id)
                      ->first();

            $product_details=productaddcart::select('product_id','cart_quantity')
                      ->where('productaddcart.order_status', '=', 'pending')
                      ->where('productaddcart.user_id', '=', Auth::user()->id)
                      ->get();
            foreach ($product_details as $key => $value) {
                $data['product'][$value->product_id] = $value->product_id;
                $data['quantity'][$value->product_id] = $value->cart_quantity;
            }
         // dd($data);
     
        $select_payment=$request->payment;
        $total_price = $total_price->total_price;
        $request->ic_number = 1;
        $request->option =1;
        $request->my_feed_back1 = 'order placed';

        $data['purchase_price'] = $total_price;
         $data['new_shipping_cost'] = $new_shipping_cost;

       
        $request->total_amount = $request->PAYMENTREQUEST_0_ITEMAMT+$new_shipping_cost;



            $payment_gateway=PaymentGatewayDetails::find(1);
            $prod_amount = Product::where('id',$request->product)->value('price');
  
           
            $orderid = mt_rand();
            $joiningfee  = $prod_amount*$request->quantity;
            $sponsor_id = Sponsortree::where('user_id',Auth::user()->id)->value('sponsor');
            $sponsorname = User::find($sponsor_id)->username;
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
                        $flag = true;
                    }
                }
                else{
                    Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('register.error_in_payment')));
                    return Redirect::to('user/shop');
                }
            }
            if($request->key_user_hidden ==null)
              $userdetails= User::find(Auth::user()->id);
            else
              $userdetails= User::where('username',$request->key_user_hidden)->first();
            $plan_upgrade=PendingTransactions::create([

                 'order_id'     =>$orderid,
                 'user_id'      =>$userdetails->id,
                 'username'     =>$userdetails->username,
                 'email'        =>$userdetails->email,
                 'sponsor'      =>Auth::user()->username,
                 'package'      =>1,
                 'request_data' =>json_encode($data),
                 'payment_method'=>$request->payment,
                 'payment_type' =>'shop_purchase',
                 'payment_code'   => $data['payment_date'],
                 'amount'       => $total_price,
                 'invoice'      => $request->payment == 'bankwire' ? $data['bank_file'] : "Na",
            ]);
           

            if ($request->payment == 'senangpay') {
                $senag_data=payout_gateway_details::select('merchant_id','secret_key')->where('id',1)->first();
                $merchant_id=$senag_data->merchant_id;
                $secretkey=$senag_data->secret_key;
                $joiningfee=$total_price;
                $orderidd=$orderid;

                return view('auth.senangpayPaymentPage',compact('joiningfee','orderidd','merchant_id','secretkey'));
            }
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
                    PendingTransactions::where('id', $plan_upgrade->id)->update(['payment_status' => 'complete']) ;
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
            if ($request->payment == "ewallet") {
                $balance=Balance::where('user_id', Auth::user()->id)->value('balance');
                if ($balance >= $joiningfee) {
                    Balance::where('user_id', Auth::user()->id)->decrement('balance', $joiningfee);
                    PendingTransactions::where('id', $plan_upgrade->id)->update(['payment_status' => 'complete']) ;
                    $flag=true;
                }
            }
            if ($flag) {

            $order_data= self::saveShippingRequest(Auth::user()->id, $data['shipping_firstname'], $data['email'], $data['phone'], $data['shipping_country'], $data['shipping_state'], $data['shipping_city'], $data['shipping_address'], $data['shipping_zip'],1,1, $request->payment, $request->my_feed_back1, $request->PAYMENTREQUEST_0_ITEMAMT, $new_shipping_cost);
           
            if ($order_data == 0) {
                Session::flash('flash_notification', array('level' => 'warning', 'message' =>trans('all.some_products_are_out_of_stock')));
                return redirect("user/onlinestore");
            } else {
                    if($request->payment == 'bankwire'){
                    Session::flash('flash_notification', array('message'=> 'Your Shop Purchase Successful! Admin need to Aprove your bankwire transaction','level'=>'success'));
                    return redirect("user/onlinestore");
                  }
                 PendingTransactions::where('id', $plan_upgrade->id)->update(['payment_status' => 'finish']) ;
                 $flag=true;

            }
            $id = shippingaddress::where('user_id', Auth::user()->id)->max('id');
            
           
            
            return  redirect("user/orderconfirm/".Crypt::encrypt($id).'/'.$select_payment);
        } else {
               Session::flash('flash_notification', array('level' => 'warning', 'message' =>trans('all.some_error_occured')));
                return redirect("user/onlinestore");
        }
            // if ($flag) {


            //     if($request->payment == 'bankwire'){
            //         Session::flash('flash_notification', array('message'=> 'Your Shop Purchase Successful! Admin need to Aprove your bankwire transaction','level'=>'success'));
            //         return redirect()->back();
            //     }
            //     $title=trans('register.payment_complete');
            //       $sub_title=trans('register.payment_complete');
            //       $base=trans('register.payment_complete');
            //       $method=trans('register.payment_complete');
            //     $purchase_id=$plan_upgrade->id;
            //     return view('app.user.product.purchasecomplete', compact('title', 'sub_title', 'base', 'method', 'purchase_id'));
            // } 
            // else {
            //     Session::flash('flash_notification', array('message'=>"Shop Purchase Failed",'level'=>'error'));
            //     return redirect()->back();
            // }
        }
    }
     public function saveShippingRequest($id, $fname, $email, $contact, $country, $state, $city, $address, $pincode, $option = 1, $ic_number, $payment, $my_feed_back, $total_amount, $shipping_amount)
    {
              
        $tracking = DeliveryTrackingDetails::create([
        'status' =>'shipped',
        ]);
        if ($payment == 'bank_transfer') {
            $shipping_status = 'pending';
            $invoice_status = 'Pending';
        } else {
            $shipping_status = 'shipped';
            $invoice_status = 'Paid';
        }
        $address_details=shippingaddress::create([
                      'user_id'=>$id,
                      'payment'=>$payment,
                      'tracking_id' => $tracking->id,
                      'option_type' => $option,
                      'fname'=>$fname,
                      // 'lname'=>$lname,
                      'email'=>$email,
                      'contact'=>$contact,
                      'ic_number'=>$ic_number,
                      'country'=>$country,
                      'state'=>$state,
                      'city'=>$city,
                      'address'=>$address,
                      'pincode'=>$pincode,
                      'status'=>$shipping_status,
                      'my_feed_back'=>$my_feed_back,
                    ]);
        $product = product::join('productaddcart', 'product.id', '=', 'productaddcart.product_id')
                  ->join('category', 'category.id', '=', 'product.category_id')
                  ->select('productaddcart.*', 'product.*', 'category.status as cat_status')
                  ->where('productaddcart.order_status', '=', 'pending')
                  ->where('productaddcart.user_id', '=', Auth::user()->id)
                  ->whereNull('productaddcart.deleted_at')
                  ->get();
        
        $sum=0;
        $total_count=0;
        $total_pv=0;
        foreach ($product as $key => $value) {
            if ($value->cart_quantity <= $value->quantity && $value->cat_status == 'yes' && $value->status == 'yes') {
                $sum =$sum +($value->price*$value->cart_quantity);
                $total_count=$total_count + ($value->cart_quantity);
                $total_pv=$total_pv + ($value->pvprice*$value->cart_quantity);
            } else {
                productaddcart::where('user_id', Auth::user()->id)->where('product_id', '=', $value->product_id)->update(['order_status'=>'complete']);
                productaddcart::where('user_id', Auth::user()->id)->where('product_id', '=', $value->product_id)-> delete();
                return 0;
            }
        }
        $sum=$sum+$shipping_amount;
        $date = date('Ymd');
        // $date = date('Ym');
        $order_table = order::create([
        'user_id'=>Auth::user()->id,
        'total_amount'=>$sum,
        'total_count'=>$total_count,
        'total_pv'=>$total_pv,
        'shipping_id'=>$address_details->id,
        'status'=>$invoice_status,
        ]);
        Order::where('id', '=', $order_table->id)->update(['invoice_id'=>'INV-'.$date.'-'.$order_table->id]);
         // Order::where('id', '=', $order_table->id)->update(['invoice_id'=>$date.'/'.'00'.$order_table->id]);
   
   
        $order=$order_table->id;
        shippingaddress::where('id', $address_details->id)->update(['order_id'=>$order]);
        if($shipping_amount <> 0){

        $per_shipping_amount = $shipping_amount/$total_count;
        }
         $per_shipping_amount=0;
         // dd($product);
        foreach ($product as $key2 => $value) {

           $orderproduct= orderproduct::create([
            'order_id'=>$order,
            'product_id'=>$value->product_id,
            'user_id'=>Auth::user()->id,
            'count'=>$value->cart_quantity,
            'amount'=>($value->cart_quantity)*($value->price)+($value->cart_quantity)*$per_shipping_amount,
            'pv'=>($value->cart_quantity)*($value->pvprice),
            ]);
        }
       
        $list_orders = orderproduct::where('order_id', '=', $order)->get();
        foreach ($list_orders as $key => $list_order) {
            $total_product_count = product::where('id', '=', $list_order->product_id)->value('quantity');
            $pro_purchased_count = $list_order->count;
            if ($total_product_count >=  $pro_purchased_count) {
                $dec=$total_product_count - $pro_purchased_count;
                product::where('id', '=', $list_order->product_id)->update(['quantity'=>$dec]);
            } else {
                product::where('id', '=', $list_order->product_id)->update(['quantity'=>0]);
            }
        }
  
        productaddcart::where('user_id', Auth::user()->id)->where('order_status', '=', "pending")->update(['order_status'=>'complete']);
        $current_date=date('Y-m-d H:i:s');
        productaddcart::where('user_id', '=', Auth::user()->id)->update(['deleted_at'=>$current_date]);
                
        $app_settings = AppSettings::find(1);
        $user_details = User::where('id', Auth::user()->id)->first();
        $shippingaddress = shippingaddress::where('id', $address_details->id)->first();
        $product_details = orderproduct::join('product', 'product.id', '=', 'orderproduct.product_id')->where('orderproduct.order_id', $order)->select('product.name', 'orderproduct.amount', 'orderproduct.count', 'product.price')->get();
        $order_details = order::where('id', $order)->select('total_amount', 'total_count')->get();
        return 1;
    }

   
    public function sharePartner_Order()
    {
       $sharepartnerProducts = SharePartner::select('id','products','quantity')->get();
       $user_id =Auth::user()->id;


        foreach ($sharepartnerProducts as $key => $product) 
        {
            StockManagement::create(['user_id'=>$user_id,
                                 'product_id' =>$product->id,
                                 'in'         =>$product->quantity,
                                 'balance'    =>$product->quantity,

            ]);   
        }

    }


    public function sellSharePartnerProducts(Request $request)
    {
        $balance = $request->balanace - $request->out;

            StockManagement::updateorcreate(['user_id'=>$user_id],
                                 ['product_id' =>$product->id,
                                 'in'         =>$product->quantity,
                                 'balance'    =>$balance

            ]);   
       
    }


}
