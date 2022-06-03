<?php

namespace App\Http\Controllers\Admin;

use App\Commission;
use App\Http\Controllers\Admin\AdminController;
use App\PackageHistory;
use App\Packages;
use App\PointTable;
use App\Product;
use App\Products;
use App\PurchaseHistory;
use App\Sponsortree;
use App\Tree_Table;
use App\User;
use App\Orderproduct;
use App\Category;
use App\Order;
use App\AppSettings;
use App\Shippingaddress;
use Auth;
use DB;
use Illuminate\Http\Request;
use Response;
use Session;
use Input;
use DataTables;

// use App\Http\Controllers\Admin\DB;

use Validator;

class OnlineStoreController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title     = trans('products.online_store');
        $sub_title = trans('products.online_store');
        $base      = trans('products.online_store');
        $method    = trans('products.online_store');
        
        $orders = Order::select('order.invoice_id as invoice', 'users.username', 'shoppingaddress.country as shipping_country', 'order.total_amount', 'shoppingaddress.status', 'order.created_at')
         ->join('users', 'users.id', '=', 'order.user_id')
         ->join('shoppingaddress', 'shoppingaddress.order_id', '=', 'order.id')
         ->orderBy('order.created_at', 'desc')
         ->get(5);
         
         $oders_count = Order::count();
         $total_sale  = Order::sum('total_amount');
         $weekly_sale_count = Order::whereDate('created_at', '>=', date('Y-m-d H:i:s', strtotime('-7 days')))->count();
         $monthly_sale_count = Order::whereDate('created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 month')))->count();
         $yearly_sale_count = Order::whereDate('created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 year')))->count();

         $pending_orders = Order::where('status', '=', 'Pending')->count();
         $total_products=Product::all();
         $count_product=count($total_products);

   


        return view('app.admin.online_store.dashboard_online_store', compact('title', 'sub_title', 'base', 'method', 'orders', 'oders_count', 'total_sale', 'weekly_sale_count', 'yearly_sale_count', 'monthly_sale_count', 'pending_orders', 'count_product'));
    }

    public function getCategoryJson()
    {


        $graph=array();
        $category=Category::select('id', 'category_name')->get();
      
        $i=0;
        foreach ($category as $key => $value) {
            $count = Orderproduct::join('product', 'product.id', '=', 'orderproduct.product_id')
             ->join('category', 'category.id', '=', 'product.category_id')
             -> where('category.id', '=', $value->id)
             ->sum('orderproduct.count');
            $graph[$i]['value']= $count;
            $graph[$i]['name']=$value->category_name;
            $i++;
        }
       
        return response()->json($graph);
    }

    public function getSaleJson()
    {
          


          $duration = strtotime('-365 days');
          $graph = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as    value'))
          ->whereDate('created_at', '>=', date('Y-m-d H:i:s', $duration))
          ->orderBy('date', 'asc')
          ->groupBy('date')
          // ->take(15)
          ->get();
          return response()->json($graph);
    }

    public function salesdet()
    {

        $title     = trans('products.sales');
        $sub_title =  trans('products.sales');
        $base      = trans('products.sales');
        $method    = trans('products.sales');
      
                
        return view('app.admin.online_store.sales', compact('title', 'base', 'method', 'sub_title', 'users'));
    }


    public function salesrecord()
    {

   
        $users = Order::join('orderproduct', 'orderproduct.order_id', '=', 'order.id')
                ->join('product', 'orderproduct.product_id', '=', 'product.id')
                ->join('users', 'users.id', '=', 'order.user_id')
                ->join('shoppingaddress', 'shoppingaddress.id', '=', 'order.shipping_id')
                ->select('order.id', 'order.invoice_id', 'users.username', 'shoppingaddress.option_type', 'shoppingaddress.fname', 'shoppingaddress.lname', 'shoppingaddress.address', 'shoppingaddress.city', 'shoppingaddress.state', 'shoppingaddress.pincode', 'shoppingaddress.email', 'shoppingaddress.country', 'shoppingaddress.contact', 'order.total_count', 'order.total_amount', 'orderproduct.created_at')
                ->groupBy('order.id')
                ->orderby('order.id', 'asc')
                ->get();

        $count_users=count($users);

            return DataTables::of($users)
             ->editColumn('invoice', '<a href="{{{ URL::to(\'admin/invoice/\' . $id  ) }}}" class="btn btn-primary" title="Invoice"><i class="icon-file-eye2" aria-hidden="true"></i></a>')
            ->removeColumn('id')
            ->setTotalRecords($count_users)
            ->escapeColumns([])
            ->make();
    }

    public function viewmore($id)
    {
// dd($id);
        $title=trans('products.view_order');
        $base=trans('products.view_order');
        $method=trans('products.view_order');
        $sub_title=trans('products.view_order');
        $company=AppSettings::find(1);
        $user=shippingaddress::where('id', '=', $id)->first();
        $invoice_ids=$user->order_id;
        $invoice=order::where('id', $invoice_ids)->value('invoice_id');
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


      
        
        return view('app.admin.online_store.invoice', compact('title', 'sub_title', 'method', 'user', 'country', 'fname', 'total', 'lname', 'state', 'contact', 'email', 'address', 'city', 'date', 'company', 'company_name', 'company_address', 'email_address', 'invoice_ids', 'payment', 'products', 'total_amount', 'invoice', 'admin_user'));
    }
}
