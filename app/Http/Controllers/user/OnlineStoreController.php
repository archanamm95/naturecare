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
use App\Transactions;
use App\Sponsortree;
use App\PurchaseHistory;
use App\Ranksetting;
use App\Sales;
use App\PointTable;
use App\DirectSposnor;
use App\RsHistory;
use App\LeadershipBonus;
use App\Tree_Table;
use App\UserDebit;
use App\Currency;
use App\Voucher;
use App\VoucherHistory;
use Auth;
use Session;
use Validator;
use App\ProfileModel;
use App\ProfileInfo;
use App\Product;
use App\Productaddcart;
use App\ShoppingCountry;
use App\ShoppingZone;
use App\Order;
use DB;
use Redirect;
use App\DeliveryTrackingDetails;
use App\Shippingaddress;
use App\Orderproduct;
use App\InvoiceTable;
use App\AppSettings;
use App\PaymentGatewayDetails;
use App\PendingTransactions;
use Crypt;
use App\Category;
use App\PaymentType;
use App\BillingAddress;
use App\Http\Controllers\user\UserAdminController;
use Srmklive\PayPal\Services\ExpressCheckout;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Account;
use Stripe\Token;
use Rave;
use CountryState;
use DataTables;
use Input;
use App\payout_gateway_details;

class OnlineStoreController extends UserAdminController
{
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected static $provider;



    public function __construct()
    {
        
        self::$provider = new ExpressCheckout;
    }
    // public function onlinestore($products_id = "")
    // {

    //     $title=trans('all.online_store');
    //     $sub_title=trans('all.online_store');
    //     $method=trans('all.online_store');
    //     $product=Product::select('product.*')
    //                 ->join('category', 'category.id', '=', 'product.category_id')
    //                 ->where('category.status', '=', 'yes')
    //                 ->where('product.status', '=', 'yes')
    //                 ->where('product.quantity', '>', 0)
    //                 ->where(function ($query) use ($products_id) {
    //                     $query->where('product.name', 'like', '%'.$products_id.'%');
    //                 })
    //                 ->get();
    //     $category = Category::where('status', '=', 'yes')->get();
    //     $cart= productaddcart::join('product', 'product.id', '=', 'productaddcart.product_id')
    //                 ->where('product.quantity', '>', 0)
    //                 ->where('productaddcart.user_id', '=', Auth::user()->id)
    //                 ->select('product.*', 'productaddcart.*')
    //                 ->get();
    //     $cart_amount = productaddcart::join('product', 'product.id', '=', 'productaddcart.product_id')
    //                 ->select(DB::raw('sum(productaddcart.cart_quantity*product.price) AS total_price'))
    //                 ->where('productaddcart.order_status', '=', 'pending')
    //                 ->where('productaddcart.user_id', '=', Auth::user()->id)
    //                 ->get();
    //     $cart_amount = $cart_amount[0]->total_price;
    //     $cart_count = productaddcart::join('product', 'product.id', '=', 'productaddcart.product_id')
    //                 ->where('product.quantity', '>', 0)
    //                 ->where('productaddcart.user_id', '=', Auth::user()->id)
    //                 ->sum('cart_quantity');
    //     $products = productaddcart::join('product', 'product.id', '=', 'productaddcart.product_id')
    //                             ->select('product.name', 'productaddcart.cart_quantity', 'productaddcart.id', 'product.image', 'product.price')
    //                             ->where('productaddcart.order_status', '=', 'pending')
    //                             ->where('productaddcart.user_id', '=', Auth::user()->id)
    //                             ->get();
    //     return view('app.user.online_store.onlinestore', compact('title', 'sub_title', 'method', 'product', 'cart', 'cart_amount', 'products', 'category', 'products_id', 'cart_count'));
    // }
    //online stroe by category

    public function purchasefor(Request $request){
        if($request->id!=''){
            $user_id = explode(':', $request->id);
            $user=User::where('username', $user_id[0])-> first();
            if($user != ''){
            $userid=$user->id;
            return response()->json([
            'data' => $user,
            'message' => 'User Verified'
            ]);
        } else{
           return response()->json([
            'data' => '',
            'message' => 'User Not Exist'
            ]); 
        }
    }
        $title    = trans('products.online_purchase');
        $sub_title= trans('products.online_purchase');
        $method   = trans('admin.Online_Store');
        return view('app.user.online_store.purchase_for',compact('title','sub_title','method'));
    }
     public function onlinestore($products_id=""){

        $title    = trans('admin.Online_Store');
        $sub_title= trans('admin.Online_Store');
        $method   = trans('admin.Online_Store');
        $product=Product::where(function ($query) use ($products_id) {                       
                        $query->where('name', 'like', '%'.$products_id.'%');   
                         })
                        ->get();
        $category = Category::where('status','=','yes')->get();
        $cart= Productaddcart::join('product','product.id','=','productaddcart.product_id')
                        ->where('productaddcart.user_id','=',Auth::user()->id)
                        ->select('product.*','productaddcart.*')
                        ->get();
        $cart_amount = productaddcart::join('product','product.id','=','productaddcart.product_id')
                        ->select(DB::raw('sum(productaddcart.cart_quantity*product.price) AS total_price'))
                        ->where('productaddcart.order_status','=','pending')
                        ->where('productaddcart.user_id','=',Auth::user()->id)
                        ->get();
        $cart_amount = $cart_amount[0]->total_price; 
        $cart_count = Productaddcart::where('user_id',Auth::user()->id)->where('order_status','pending')->sum('cart_quantity');
        $products = Productaddcart::join('product','product.id','=','productaddcart.product_id')
                                    ->select('product.name','productaddcart.cart_quantity','productaddcart.id','product.image','product.price')
                                    ->where('productaddcart.order_status','=','pending')
                                    ->where('productaddcart.user_id','=',Auth::user()->id)
                                    ->get();
        $payment_gateway=PaymentGatewayDetails::find(1);
        $payment_type=PaymentType::where('status', 'yes')->where('id','!=',6)->get();
        $userData = User::join('profile_infos','profile_infos.user_id','users.id')->where('users.id',Auth::user()->id)->select('name','email','mobile')->first();                           
        return view('app.user.online_store.onlinestore',compact('title','sub_title','method','product','cart','cart_amount','products','category','products_id','cart_count','payment_gateway','payment_type','userData'));
    }
    public function onlinestores($id, $category)
    {
        $title=$category;
        $sub_title=trans('all.online_store');
        $method=trans('all.online_store');
        $product=Product::select('product.*')
                         ->join('category', 'category.id', '=', 'product.category_id')
                        ->where('category.status', '=', 'yes')
                        ->where('product.status', '=', 'yes')
                         ->where(function ($query) use ($id) {
                            if ($id != "") {
                                $query->where('category.id', '=', $id);
                            }
                         })
                        ->where('product.quantity', '>', 0)
                        ->get();
        $cart= productaddcart::join('product', 'product.id', '=', 'productaddcart.product_id')
                        ->where('product.quantity', '>', 0)
                        ->where('productaddcart.user_id', '=', Auth::user()->id)
                        ->select('product.*', 'productaddcart.*')
                        ->get();
        $cart_amount = productaddcart::join('product', 'product.id', '=', 'productaddcart.product_id')
                        ->select(DB::raw('sum(productaddcart.cart_quantity*product.price) AS total_price'), 'product.id')
                        ->where('productaddcart.order_status', '=', 'pending')
                        ->where('productaddcart.user_id', '=', Auth::user()->id)
                        ->get();
               
        $cart_amount = $cart_amount[0]->total_price;
        $cart_count = productaddcart::join('product', 'product.id', '=', 'productaddcart.product_id')
                        ->where('product.quantity', '>', 0)
                        ->where('productaddcart.user_id', '=', Auth::user()->id)
                        ->sum('cart_quantity');
        $category = Category::where('status', '=', 'yes')->get();
        $products = productaddcart::join('product', 'product.id', '=', 'productaddcart.product_id')
                                    ->select('product.name', 'productaddcart.cart_quantity', 'productaddcart.id', 'product.image', 'product.price')
                                    ->where('productaddcart.order_status', '=', 'pending')
                                    ->where('productaddcart.user_id', '=', Auth::user()->id)
                                    ->get();
        $products_id ="";
        return view('app.user.online_store.onlinestore', compact('title', 'sub_title', 'method', 'product', 'cart', 'cart_amount', 'products', 'category', 'products_id', 'cart_count'));
    }
//add to cart
    public function add_to_cart(Request $request)
    {
        $product=product::where('id', $request->product_id)
                        ->whereNull('deleted_at')
                        ->select('id', 'name', 'image', 'price', 'quantity', 'description', 'status')
                        -> first();
        $productaddcart = productaddcart::firstOrNew(['product_id' => $request->product_id,'user_id'=>Auth::user()->id]);
        if ($productaddcart->cart_quantity +1 <= $product->quantity) {
            $productaddcart->cart_quantity =$productaddcart->cart_quantity + 1;
            $productaddcart->save();
            $reponse = productaddcart::join('product', 'product.id', '=', 'productaddcart.product_id')
                        ->select('product.name', 'product.image', 'product.status', 'product.price', 'productaddcart.*')
                        ->where('productaddcart.user_id', '=', Auth::user()->id)
                        ->get();
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('all.product_added_successfully')));
        } else {
            Session::flash('flash_notification', array('level' => 'warning', 'message' => trans('all.insufficient_product_quantity')));
        }
        return redirect()->back();
    }
//update cart
    public function updateCart(Request $request)
    {
        $product_id = productaddcart::find($request->requestid)->product_id;
        $quantity = product::find($product_id)->quantity;
        if ($quantity >= $request->cart_quantity) {
            $product=productaddcart::where('id', $request->requestid)->update(['cart_quantity'=>$request->cart_quantity]);
            Session::flash('flash_notification', array('level'=>'success','message'=>trans('all.cart_updated')));
        } else {
            Session::flash('flash_notification', array('level' => 'warning', 'message' => trans('all.insufficient_product_quantity')));
        }
        return  redirect()->back();
    }
    //View cart
    public function viewCart()
    {
        $title=trans('all.cart_contents');
        $sub_title=trans('all.cart_contents');
        $method=trans('all.cart_contents');
        $data= productaddcart::join('product', 'product.id', '=', 'productaddcart.product_id')
                        ->select('product.name', 'product.image', 'product.status', 'product.price', 'productaddcart.cart_quantity', 'productaddcart.product_id', 'productaddcart.id')
                        ->where('productaddcart.order_status', '=', 'pending')
                        ->where('productaddcart.user_id', '=', Auth::user()->id)
                        ->get();
        $total_price=productaddcart::join('product', 'product.id', '=', 'productaddcart.product_id')
                        ->select(DB::raw('sum(productaddcart.cart_quantity*product.price) AS total_price'))
                        ->where('productaddcart.order_status', '=', 'pending')
                        ->where('productaddcart.user_id', '=', Auth::user()->id)
                        ->first();
                       
        return view('app.user.online_store.cart_view', compact('title', 'sub_title', 'method', 'data', 'total_price'));
    }
    //clear cart
    public function clearCart()
    {
        $product=productaddcart::where('user_id', Auth::user()->id)->delete();
        return  redirect()->back();
    }
    //check out
    public function shipping()
    {
     
      // dd(111111);
        $title = trans('all.shipping_address');
        $sub_title = trans('all.shipping_address');
        $method = trans('all.shipping_address');
        $title = trans('all.order_confirmation');
        $Country = ShoppingCountry::get();
        $state = ShoppingCountry::where('shopping_country.iso_code_2', "MY")
             ->join('shopping_zone', 'shopping_country.country_id', '=', 'shopping_zone.country_id')
             ->get();
        $product = productaddcart::join('product', 'product.id', '=', 'productaddcart.product_id')
            ->select(DB::raw('sum(productaddcart.cart_quantity*product.price) AS total_price'), DB::raw('sum(productaddcart.cart_quantity) AS quantity'), 'cart_quantity', 'product.name')
            ->where('productaddcart.order_status', '=', 'pending')
            ->where('productaddcart.user_id', '=', Auth::user()->id)
            ->first();
        $price = $product->total_price;
        $quantity = $product->quantity;
        if ($price <0) {
            return redirect("user/onlinestore");
        }
        $data= productaddcart::join('product', 'product.id', '=', 'productaddcart.product_id')
                        ->select('product.name', 'product.image', 'product.status', 'product.price', 'productaddcart.cart_quantity', 'productaddcart.product_id', 'productaddcart.id')
                        ->where('productaddcart.order_status', '=', 'pending')
                        ->where('productaddcart.user_id', '=', Auth::user()->id)
                        ->get();
        $balace_ewallet = Balance::where('user_id', '=', Auth::user()->id)->value('balance');
        // $option = $request->option;
        $profile_info = ProfileInfo::where('user_id', '=', Auth::user()->id)->select('country', 'state', 'city', 'zip', 'address1', 'address2', 'mobile')->first();
        $default_details = User::where('id', '=', Auth::user()->id)->first();
         
        $countries = CountryState::getCountries();
        $country   = array_get($countries, $profile_info->country);
        $sponsor_id=Sponsortree::where('user_id','=',Auth::user()->id)->value('sponsor');
        $sponsor=User::where('id',$sponsor_id)->value('username');
        $rp=Balance::where('user_id',$sponsor_id)->value('register_point');
     


     
        $states = CountryState::getStates($profile_info->country);
        $user_state  = array_get($states, $profile_info->state);
     
        // $country = $default_details->country;
        // $user_state = $default_details->state;
        $state=$user_state;
        $street = $profile_info->city;
        $zip = $profile_info->zip;
        $address1 = $profile_info->address1;
        $address2 = $profile_info->address2;
        $full_name = $default_details->name;
        $def_email = $default_details->email;
        $def_mob = $profile_info->mobile;
        // if (is_numeric($country)) {
        //     $country = ShoppingCountry::where('country_id',$country)->value('name');
        // }
        // else{
        //     $country = $country;
        // }
        // if (is_numeric($user_state)) {
        //     $state = ShoppingZone::where('zone_id','=',$user_state)->select('name','shipping_cost')->first();
        // }
        // else{
        //   $state = ShoppingZone::where('name','=',$user_state)->select('name','shipping_cost')->first();
        // }
        $payment_type = PaymentType::where('status', 'yes')->where('id','!=',6)->get();
        // $countries = ShoppingCountry::all();
        $countries = CountryState::getCountries();
        $statess = ShoppingZone::where('country_id', '=', 129)->get();
        $payment_gateway=PaymentGatewayDetails::find(1);
        $BillingAddress = BillingAddress::where('user_id',Auth::user()->id)->first();
        $states = CountryState::getStates('MY');
        $shoppingCountry = Shippingaddress::where('user_id',Auth::user()->id)->value('country');
        $shopstates = CountryState::getStates($shoppingCountry);
        $joiningfee  = $price*$quantity;
        $balance =  Balance::where('user_id', Auth::user()->id)->value('balance');
        $userData = User::join('profile_infos','profile_infos.user_id','users.id')->where('users.id',Auth::user()->id)->select('name','email','mobile')->first();               

        // $shipping_state_cost =$state->shipping_cost;
        return view('app.user.online_store.shippingaddress', compact('title', 'sub_title', 'method', 'Country', 'state', 'quantity', 'balace_ewallet', 'option', 'country', 'user_state', 'street', 'zip', 'countries', 'address1', 'address2', 'statess', 'full_name', 'def_email', 'def_mob', 'price', 'payment_type', 'data', 'payment_gateway','userData','joiningfee','BillingAddress','states','shopstates','shoppingCountry','sponsor','rp','balance'));
       // }
       // else{
        // Session::flash('flash_notification',array('level'=>'danger','message'=>'Please Select an Option'));
       //   return redirect()->back()->withErrors('Please Select an Option');
       // }
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
        // dd($orderproduct);
      // $count = InvoiceTable::whereDate('created_at', '=', date('Y-m-d'))->count();
     
      // InvoiceTable::create([
      //     'user_id'=>Auth::user()->id,
      //     'order_id'=>$order,
      //     'invoice_id'=>'INV-'.$date.'-'.$order,
      //     'status'=>$invoice_status,
      // ]);
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
     // dd($order_details);
   
       
        return 1;
    }
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
                return Redirect::action('user\OnlineStoreController@onlinestore')->withErrors(trans('all.insufficient_quantity'));
            }
        }

            
       
        $product_quantity=$product[0]->cart_quantity;
        $product_price=$product[0]->price;
                         
            $data = array();
        if ($request->chkPassport == "on") {
            $data['fname']=$request->fname1;
            $data['phone'] = $request->contact1;
            $data['email'] = $request->email1;
            $data['country'] = $request->country2;
            $data['state'] = $request->state1;
            $data['city'] = $request->city1;
            $data['address'] = $request->address1;
            $data['zip'] = $request->pincode1;

        } else {
            $data['fname']=$request->fname2;
            $data['phone'] = $request->contact2;
            $data['email'] = $request->email2;
            $data['country'] = $request->country2;
            $data['state'] = $request->state1;
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
        $data['shipping_state'] = 'test' ;
        $data['chkPassport']=$request->chkPassport;
        $data['payment'] = $request->payment;
        $data['lname2'] = $request->lname2;
        $data['total_amount_req'] = $request->total_amount;
        $data['quantity'] = $request->quantity;
        $data['shippingcost'] = $request->shippingcost;
        $data['amount'] = $request->amount;
        $data['payment_method'] = $request->payment_method;
        $data['currency'] = $request->currency;
        $data['card_number'] = $request->card_number;
        $data['cvv'] = $request->cvv;
        $data['year'] = $request->year;
        $data['ewalletusername'] = $request->ewalletusername;
        $data['ewallet_password'] = $request->ewallet_password;
          
 

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
            // return Redirect::action('user\OnlineStoreController@onlinestore')->withErrors($validator);
            return redirect()->back()->withErrors($validator);
        }

        $total_price=productaddcart::join('product', 'product.id', '=', 'productaddcart.product_id')
                      ->select(DB::raw('sum(productaddcart.cart_quantity*product.price) AS total_price'))
                      ->where('productaddcart.order_status', '=', 'pending')
                      ->where('productaddcart.user_id', '=', Auth::user()->id)
                      ->first();
     
        $select_payment=$request->payment;
        $total_price = $total_price->total_price;
        $request->ic_number = 1;
        $request->option =1;
        $request->my_feed_back1 = 'order placed';

        $data['purchase_price'] = $total_price;
         $data['new_shipping_cost'] = $new_shipping_cost;
      

        if ($request->payment == "ewallet") {
            if ($request->ewalletusername == null ||$request->ewallet_password == null) {
                return redirect()->back()->withErrors([trans('all.the_ewallet_username_and_password_required')]);
            }
        }

        if ($request->payment == "rave") {
            if ($total_price > 1000) {
                return redirect()->back()->withErrors([trans('all.the_amount_should_be_between_1_and_1000_for_rave_payment')]);
            }
        }

    ///shilpa
        $payment_gateway=PaymentGatewayDetails::find(1);
        $orderid = mt_rand();
        $auth_sponsor=Sponsortree::where('user_id', Auth::user()->id)->value('sponsor');
        $purchase=PendingTransactions::create([
               'order_id' =>$orderid,
               'user_id' =>Auth::user()->id,
               'username' =>Auth::user()->username,
               'email' =>Auth::user()->email,
               'sponsor' => $auth_sponsor,
               'request_data' =>json_encode($data),
               'payment_method'=>$request->payment,
               'payment_type' =>'store_purchase',
               'amount' => $total_price,
              ]);
     
        $flag= false;

        if ($request->payment == "cheque") {
              $flag=true;
        }

        if ($request->payment == "ewallet") {
            $ewallet_user=User::where('username', $request->ewalletusername)->first();
            if ($ewallet_user == null) {
                return redirect()->back()->withErrors([trans('all.the_user_doesnt_exist')]);
            } else {
                if ($request->ewallet_password == $ewallet_user->transaction_pass) {
                    $balance=Balance::where('user_id', $ewallet_user->id)->value('balance');
                    if ($ewallet_user->id == 1) {
                        PendingTransactions::where('id', $purchase->id)->update(['payment_status' => 'finish']) ;
                        $flag=true;
                    }
                    if ($balance>=$total_price && $ewallet_user->id > 1) {
                        Balance::where('user_id', $ewallet_user->id)->decrement('balance', $total_price);
                        Commission::create([
                        'user_id'=>$ewallet_user->id,
                        'from_id'=>1,
                        'total_amount'=>$total_price*-1,
                        'payable_amount'=>$total_price*-1,
                        'payment_type'=>'store_purchase',
                        'note'           => 'store purchase',
                        ]);
                  
                   
                        $flag=true;
                    } else {
                        return redirect()->back()->withErrors([trans('all.insufficient_balance')]);
                    }
                } else {
                    return redirect()->back()->withErrors([trans('all.transaction_password_is_incorrect')]);
                }
            }
        }
          
        if ($request->payment == "paypal") {
            Session::put('paypal_id', $purchase->id);

            $data = [];
            $data['items'] = [
                [
                    'name' => Config('APP_NAME'),
                    'price' => $total_price,
                    'qty' => 1
                ]
            ];
           
            $data['invoice_id'] = time();
            $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
            $data['return_url'] = url('/user/paypal/storesuccess', $purchase->id);
            $data['cancel_url'] = url('/user/onlinestore');

            $total = 0;
            foreach ($data['items'] as $item) {
                $total += $item['price']*$item['qty'];
            }

            $data['total'] = $total;

            $response = self::$provider->setExpressCheckout($data);
           
             PendingTransactions::where('id', $purchase->id)
                                        ->update(['payment_data' => json_encode($response),'paypal_express_data' => json_encode($data)]);
         
            return redirect($response['paypal_link']);
        }


        if ($request->payment == 'stripe') {
            Stripe::setApiKey($payment_gateway->stripe_secret_key);
            $customer=Customer::create([
                        'email' =>Auth::user()->email,
                        'source' =>request('stripeToken')
                        ]);

            $id = $customer->id;
            $Charge=Charge::create([
                        'customer' =>$id,
                        'amount' => $total_price * 100,
                        'currency' => 'usd'
                        ]);
               
            if ($Charge->status == "succeeded") {
                PendingTransactions::where('id', $purchase->id)->update(['payment_data' =>json_encode($customer),'payment_response_data' =>json_encode($Charge)]) ;
                
                $flag=true;
            } else {
                Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('all.error_in_payment')));
                 return redirect()->back()->withErrors([trans('all.payment_failure')]);
            }
        }


        if ($request->payment == 'bitaps') {
              $title=trans('all.bitaps_payment');
              $sub_title=trans('all.bitaps_payment');
              $base=trans('all.bitaps_payment');
              $method=trans('all.bitaps_payment');

            
              $url ='https://api.bitaps.com/btc/v1//create/payment/address' ;
              $payment_details = $this->url_get_contents($url, [
                                              'forwarding_address'=>$payment_gateway->btc_address,
                                              'callback_link'=>url('bitaps/storepurchase'),
                                              'confirmations'=>3
                                          ]);

                $conversion = $this->url_get_contents('https://api.bitaps.com/market/v1/ticker/btcusd', false);

                $package_amount = $total_price/$conversion->data->last;

               PendingTransactions::where('id', $purchase->id)->update(['payment_code'=>$payment_details->payment_code,'invoice'=>$payment_details->invoice,'payment_address'=>$payment_details->address,'payment_data'=>json_encode($payment_details)]);
                 $trans_id=$purchase->id;

              return view('app.user.online_store.storebitaps', compact('title', 'sub_title', 'base', 'method', 'payment_details', 'data', 'package_amount', 'setting', 'trans_id'));
        }
               
        if ($request->payment == 'rave') {
            $rave_call= Rave::initialize(url('user/ravestorepur'));
            $pay_data=json_decode($rave_call, true);

            PendingTransactions::where('id', $purchase->id)->update(['rave_ref_id' =>$pay_data['txref'],'payment_data' => json_encode($rave_call)]);
            die();
        }


        if ($request->payment == 'skrill') {
            echo '  <form id="skrill" action="https://pay.skrill.com" method="post" > 
                     <input type="hidden" name="pay_to_email" value="'.$payment_gateway->skrill_mer_email.'">
                    <input type="hidden" name="return_url" value="'.url('user/skrill/storesuccess', $purchase->id).'" >
                    <input type="hidden" name="status_url" value="'.url('user/skrill-storestatus', $purchase->id).'">
                    <input type="hidden" name="language" value="EN">
                    <input type="hidden" name="amount" value="'.$total_price.'">
                    <input type="hidden" name="currency" value="USD">

                    <input type="hidden" name="pay_from_email" value="'.Auth::user()->email.'">
                    <input type="hidden" name="firstname" value="'.Auth::user()->name.'">
                    <input type="hidden" name="lastname" value="'.Auth::user()->lastname.'">

                    <input type="hidden" name="rec_amount" value="'.$total_price.'">
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
                    <input type=hidden name=success_url value="'.url('user/paymentnotify/storesuccess/'.$purchase->id, $orderid).'" />
                    <input type=hidden name=cancelled_url value="'.url('user/paymentnotify/storecanceled/'.$purchase->id, $orderid).'" />
                    <input type=hidden name=deferred_url value="'.url('user/paymentnotify/storesuccess/'.$purchase->id, $orderid).'" />
                    <input type=hidden name=ipn_url value="'.url('user/paymentnotify/storeipn').'" />
                    <input type=hidden name=currency value="GHS" />
                    <input type=hidden name=total value="16" /> 
                </form>';

            echo '  <script type="text/javascript">';
            echo "  document.forms['ipaygh'].submit()  ";
            echo '  </script>';

            die();
        }


                
        if ($request->payment == 'voucher') {
                  $voucher_total = $total_price;
            foreach ($request->voucher as $key => $vouchervalue) {
 // echo "1<br>";
 //                       echo "voucher".$vouchervalue."<br>";
                        
                $voucher = Voucher::where('voucher_code', $vouchervalue)->first();
                $voucher_total= $voucher_total-$voucher->balance_amount ;
                         
                if ($voucher_total <=0) {
                         $flag = true;
                }
            }
                  // dd("Asd");

            if ($flag) {
                $package_amount = $total_price;
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
            }
        }


        if ($request->payment == 'voucher') {
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
                        'used_for'=> "store_purchase",
                        'used_amount'=>$amount,
                        ]) ;
            }
        }

        if ($request->payment == 'bankwire') {

                $validator = Validator::make($request->all(), [
                   // 'bank_file'        => 'required|mimes:pdf,doc,docx,jpeg,png,jpg'
                    'bank_file'        => 'required'
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
                    return Redirect::to('user/shop');
                }
                 $flag = true;
            }
            if ($request->payment == "register_point") {
             
                $balance=Balance::where('user_id', $auth_sponsor)->value('register_point');
                if ($auth_sponsor == 1) {

                    PendingTransactions::where('id', $purchase->id)->update(['payment_status' => 'complete']) ;
                    $flag=true;
                }else{
                	foreach ($product as $key => $value) {
                	if ($balance>=$total_price && $auth_sponsor > 1) {
                    RegisterPoint::create([
                        'user_id'       =>  $auth_sponsor,
                        'product_id'    =>  $value->product_id,
                        'order_id'      =>  $orderid,
                        'bv'            =>  $value->bv,
                        'count'         =>  1,
                        'total_amount'  =>  $total_price,
                        'type'          =>  'debit',
                    ]);
                    Balance::where('user_id', $auth_sponsor)->decrement('register_point', $total_price);
              
                    PendingTransactions::where('id', $purchase->id)->update(['payment_status' => 'complete']) ;
                    $flag=true;
	                }else{
	                	Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('all.error_in_payment')));
	                 return redirect()->back()->withErrors([trans('all.payment_failure')]);
	                }
                }
              }
            }
            if($request->payment == 'senangpay')
            {
                $senag_data=payout_gateway_details::select('merchant_id','secret_key')->where('id',1)->first();
                $merchant_id=$senag_data->merchant_id;
                $secretkey=$senag_data->secret_key;
                $joiningfee=$total_price;
                $orderidd=$orderid;
                
                return view('auth.senangpayPaymentPage',compact('joiningfee','orderidd','merchant_id','secretkey'));
            }
           
        if ($flag) {
            $order_data= self::saveShippingRequest(Auth::user()->id, $data['fname'], $data['email'], $data['phone'], $data['shipping_country'], $data['shipping_state'], $data['city'], $data['address'], $data['zip'], $request->option, $request->ic_number, $request->payment, $request->my_feed_back1, $request->PAYMENTREQUEST_0_ITEMAMT, $new_shipping_cost);
           
            if ($order_data == 0) {
                Session::flash('flash_notification', array('level' => 'warning', 'message' =>trans('all.some_products_are_out_of_stock')));
                return redirect("user/onlinestore");
            } else {
                PendingTransactions::where('id', $purchase->id)->update(['payment_status' => 'finish']) ;
                $flag=true;

            }
            $id = shippingaddress::where('user_id', Auth::user()->id)->max('id');
            // dd($product);
            // foreach ($product as $key => $value) {
            //     $total_bv=$value->bv * $value->cart_quantity;
            //     $total_amount=$value->price * $value->cart_quantity;
            //  PurchaseHistory::create([
            //     'user_id'=>Auth::user()->id,
            //     'purchase_user_id'=>Auth::user()->id,
            //     'package_id'=>0,
            //     'bv'=>$value->bv,
            //     'total_count'=>$value->cart_quantity,
            //     'total_bv'=>$total_bv,
            //     'order_id'=>$orderid,
            //     'billing_address_id'=>Auth::user()->id,
            //     'shipping_address_id'=>Auth::user()->id,
            //     'pv'=>$value->bv,
            //     'count'=>$value->cart_quantity,
            //     'total_amount'=>$total_amount,
            //     'pay_by'=>$request->payment,
            //     'shipping_country'=>'MY',
            //     'sales_status'=>'yes',
            //     'purchase_type'=>'store_purchase',
            //      'type'=>'product',
            //     'invoice_id'=>'',
            //     'payment_date'=>'',


            // ]);  
            // }
            
            return  redirect("user/orderconfirm/".Crypt::encrypt($id).'/'.$select_payment);
        } else {
               Session::flash('flash_notification', array('level' => 'warning', 'message' =>trans('all.some_error_occured')));
                return redirect("user/onlinestore");
        }
    }

    public function orderconfirm($idencrypt, $payment)
    {
       
        $title=trans('all.order_confirmation');
        $sub_title=trans('all.order_confirmation');
        $method=trans('all.order_confirmation');
        $company=AppSettings::find(1);
        $user=shippingaddress::where('id', '=', Crypt::decrypt($idencrypt))->first();
        $invoice_ids=$user->order_id;
        $invoice=order::where('id', $invoice_ids)->value('invoice_id');
        $products = order::where('order.id', '=', $invoice_ids)
                      ->join('orderproduct', 'orderproduct.order_id', '=', 'order.id')
                      ->join('product', 'product.id', '=', 'orderproduct.product_id')
                      ->select('order.*', 'orderproduct.*', 'product.*')
                      ->whereNull('orderproduct.deleted_at')
                      ->get();
                  
        $total_amount =order::where('order.id', '=', $invoice_ids)
                      ->sum('order.total_amount');
        $invoice =order::where('order.id', '=', $invoice_ids)->value('invoice_id');
        $email=$user->email;
        $country  = $user->country;
        $fname  = $user->fname;
        $lname  = $user->lname;
        $state  = $user->state;
        $contact  = $user->contact;
        $email  = $user->email;
        $address  = $user->address;
        $city  = $user->city;
        $payment= $user->payment;
        $date=$user->created_at;
        $company_name=$company->company_name;
        $company_address=$company->company_address; 
        $email_address=$company->email_address;
        $max_id=order::where('user_id', Auth::user()->id)->max('id');
        $total = order::where('user_id', Auth::user()->id)
                     ->where('id', $max_id)->get();

        $admin_user=User::join('profile_infos', 'users.id', '=', 'profile_infos.user_id')->select('users.*', 'profile_infos.*')->where('users.id', 1)->get();
                          

        // Session::flash('flash_notification', array('level' => 'primary', 'message' =>"Your order has been placed successfully"));

        
        return view('app.user.online_store.invoice', compact('title', 'sub_title', 'method', 'user', 'country', 'fname', 'total', 'lname', 'state', 'contact', 'email', 'address', 'city', 'date', 'company', 'company_name', 'company_address', 'email_address', 'invoice_ids', 'payment', 'products', 'total_amount', 'invoice', 'admin_user'));
    }
 
//sales
    public function sales()
    {
        $title=trans('all.my_order');
        $sub_title=trans('all.my_order');
        $method=trans('all.my_order');
        // $cart = order::where('order.user_id',Auth::user()->id)
        //                ->get();

          

       
        return view('app.user.online_store.sales', compact('title', 'sub_title', 'method', 'cart', 'shipping_cost'));
    }

    public function salesdata()
    {
        $title="My Order";
        $sub_title="My Order";
        $method="My Order";
        // $cart = order::where('order.user_id',Auth::user()->id)
        //                ->get();

          $cart = order::select('id', 'invoice_id', 'created_at', 'total_amount', 'status')
                       ->where('user_id', '=', Auth::user()->id)
                       ->orderBy('created_at', 'DESC')->get();

        $cart_count = count($cart);
        return DataTables::of($cart)

  
        ->editColumn('invoice', '<a href="{{{ URL::to(\'user/invoice/\' . $id  ) }}}" class="btn btn-primary" title="Invoice"><i class="icon-file-eye2" aria-hidden="true"></i></a>')

        ->removeColumn('id')

        ->setTotalRecords($cart_count)
        ->escapeColumns([])
        ->make();
    }
    public function viewmore($id)
    {
    // dd($id);
        $title=trans('all.view_order');
        $base=trans('all.view_order');
        $method=trans('all.view_order');
        $sub_title=trans('all.view_order');
        $company=AppSettings::find(1);
        $user=shippingaddress::findorfail($id);
        $invoice_ids=$user->order_id;
        // $invoice=order::where('id',$invoice_ids)->value('invoice_id');
        // dd($user);
        $products = order::where('order.id', '=', $invoice_ids)
                         ->join('orderproduct', 'orderproduct.order_id', '=', 'order.id')
                         ->join('product', 'product.id', '=', 'orderproduct.product_id')
                         ->select('order.*', 'orderproduct.*', 'product.*')
                         ->whereNull('orderproduct.deleted_at')
                         ->get();
                         // dd($products);
                       
         $total_amount =order::where('order.id', '=', $invoice_ids)
                         ->sum('order.total_amount');
           $invoice =order::where('order.id', '=', $invoice_ids)->value('invoice_id');
        $email=$user->email;
        $country  = $user->country;
        $fname  = $user->fname;
        $lname  = $user->lname;
        $state  = $user->state;
        $contact  = $user->contact;
        $email  = $user->email;
        $address  = $user->address;
        $city  = $user->city;
        $payment= $user->payment;
        $date=$user->created_at;
        $company_name=$company->company_name;
        $company_address=$company->company_address;
        $email_address=$company->email_address;
        $max_id=order::where('user_id', Auth::user()->id)->max('id');
        $total = order::where('user_id', Auth::user()->id)
                        ->where('id', $max_id)->get();
        $admin_user=User::join('profile_infos', 'users.id', '=', 'profile_infos.user_id')->select('users.*', 'profile_infos.*')->where('users.id', 1)->get();
        
      
        
        return view('app.user.online_store.invoice', compact('title', 'sub_title', 'method', 'user', 'country', 'fname', 'total', 'lname', 'state', 'contact', 'email', 'address', 'city', 'date', 'company', 'company_name', 'company_address', 'email_address', 'invoice_ids', 'payment', 'products', 'total_amount', 'invoice', 'admin_user'));
    }
    public function deletecart($id)
    {
        $product=productaddcart::where('id', $id)->delete();
       
        Session::flash('flash_notification', array('level'=>'warning','message'=>trans('all.product_removed_from_cart')));
        return  redirect()->back();
    }

    public function paypalstoresuccess(Request $request, $id)
    {
        $response = self::$provider->getExpressCheckoutDetails($request->token);
        $item = PendingTransactions::find($id);
        $item->payment_response_data = json_encode($response);
        $item->save();
      
        $express_data=json_decode($item->paypal_express_data, true);
        $response = self::$provider->doExpressCheckoutPayment($express_data, $request->token, $request->PayerID);
     
        if ($response['ACK'] == 'Success') {
            $data=json_decode($item->request_data, true);
            $order_data= self::saveShippingRequest($item->user_id, $data['fname'], $data['email'], $data['phone'], $data['shipping_country'], $data['shipping_state'], $data['city'], $data['address'], $data['zip'], 1, 1, $data['payment'], 'order placed', 0, $data['new_shipping_cost']);

            if ($order_data == 0) {
                Session::flash('flash_notification', array('level' => 'warning', 'message' =>trans('all.some_products_are_out_of_stock')));
                return redirect("user/onlinestore");
            } else {
                PendingTransactions::where('id', $id)->update(['payment_status' => 'finish']) ;
            }
            
            $id = shippingaddress::where('user_id', $item->user_id)->max('id');
                
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('all.payment_successfull')));
            return  redirect("user/orderconfirm/".Crypt::encrypt($id).'/'.'paypal');
        } else {
            Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('all.error_in_payment')));
            return Redirect::to('user/onlinestore');
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

    public function ravestorepur(Request $request)
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
                $data=json_decode($rave_det->request_data, true);
                $order_data= self::saveShippingRequest($rave_det->user_id, $data['fname'], $data['email'], $data['phone'], $data['shipping_country'], $data['shipping_state'], $data['city'], $data['address'], $data['zip'], 1, 1, $data['payment'], 'order placed', 0, $data['new_shipping_cost']);
                if ($order_data == 0) {
                    Session::flash('flash_notification', array('level' => 'warning', 'message' =>trans('all.some_products_are_out_of_stock')));
                    return redirect("user/onlinestore");
                } else {
                    PendingTransactions::where('id', $rave_det->id)->update(['payment_status' => 'finish']) ;
                }
            
                 $id = shippingaddress::where('user_id', $rave_det->user_id)->max('id');
                
                Session::flash('flash_notification', array('level' => 'success', 'message' => trans('all.payment_successfull')));
                return  redirect("user/orderconfirm/".Crypt::encrypt($id).'/'.'rave');
            } else {
                Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('all.error_in_payment')));
                return Redirect::to('user/onlinestore');
            }
        } else {
            return redirect('register')->withErrors([trans('all.error_in_payment_process_please_try_again')]);
             return Redirect::to('user/onlinestore');
        }
    }

    public function skrillstoresuccess(Request $request, $id)
    {
         
        $item = PendingTransactions::find($id);
        $item->payment_response_data = json_encode($request->all());
        $data=json_decode($item->request_data, true);
        $order_data= self::saveShippingRequest($item->user_id, $data['fname'], $data['email'], $data['phone'], $data['shipping_country'], $data['shipping_state'], $data['city'], $data['address'], $data['zip'], 1, 1, $data['payment'], 'order placed', 0, $data['new_shipping_cost']);
        if ($order_data == 0) {
            Session::flash('flash_notification', array('level' => 'warning', 'message' =>trans('all.some_products_are_out_of_stock')));
            return redirect("user/onlinestore");
        } else {
                PendingTransactions::where('id', $id)->update(['payment_status' => 'finish']) ;
        }
            
          $id = shippingaddress::where('user_id', $item->user_id)->max('id');
            
          Session::flash('flash_notification', array('level' => 'success', 'message' => trans('all.payment_successfull')));
          return  redirect("user/orderconfirm/".Crypt::encrypt($id).'/'.'skrill');
    }


    public function ipayghstoresuccess(Request $request, $id)
    {

        $item = PendingTransactions::find($id);
        $item->payment_response_data = json_encode($request->all());
        $data=json_decode($item->request_data, true);
        $order_data= self::saveShippingRequest($item->user_id, $data['fname'], $data['email'], $data['phone'], $data['shipping_country'], $data['shipping_state'], $data['city'], $data['address'], $data['zip'], 1, 1, $data['payment'], 'order placed', 0, $data['new_shipping_cost']);
        if ($order_data == 0) {
            Session::flash('flash_notification', array('level' => 'warning', 'message' =>trans('all.some_products_are_out_of_stock')));
            return redirect("user/onlinestore");
        } else {
              PendingTransactions::where('id', $id)->update(['payment_status' => 'finish']) ;
        }
            
            $id = shippingaddress::where('user_id', $item->user_id)->max('id');
            
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('all.payment_successfull')));
            return  redirect("user/orderconfirm/".Crypt::encrypt($id).'/'.'ipaygh');
    }

    public function ipayghstorecanceled(Request $request)
    {

        return redirect('user/onlinestore')->withErrors([trans('all.error_in_payment_process_please_try_again')]);
        return redirect("user/onlinestore");
    }

    public function ipayghstoreipn(Request $request)
    {

        dd($request->all());
    }
}
