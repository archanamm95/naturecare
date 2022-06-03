<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Shippingaddress extends Model
{
    use SoftDeletes;
    protected $table = 'shoppingaddress';
    protected $fillable = ['fname','lname','email','contact','ninumber','country','state','city','address','pincode','user_id','payment','tracking_id','order_id','option_type','ic_number','status','shipping_company','admin_feed_back','my_feed_back','address2'];


    public static function saveShippingRequest($id, $fname, $email, $contact, $country, $state, $city, $address, $pincode, $option = 1, $ic_number, $payment, $my_feed_back, $total_amount, $shipping_amount)
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
         $address_details=Shippingaddress::create([
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
        $product = Product::join('productaddcart', 'product.id', '=', 'productaddcart.product_id')
                 ->join('category', 'category.id', '=', 'product.category_id')
                 ->select('productaddcart.*', 'product.*', 'category.status as cat_status')
                 ->where('productaddcart.order_status', '=', 'pending')
                 ->where('productaddcart.user_id', '=', $id)
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
                Productaddcart::where('user_id', $id)->where('product_id', '=', $value->product_id)->update(['order_status'=>'complete']);
                Productaddcart::where('user_id', $id)->where('product_id', '=', $value->product_id)-> delete();
                return 0;
            }
        }
        $sum=$sum+$shipping_amount;
        $date = date('Ymd');
        $order_table = Order::create([
        'user_id'=>$id,
        'total_amount'=>$sum,
        'total_count'=>$total_count,
        'total_pv'=>$total_pv,
        'shipping_id'=>$address_details->id,
        'status'=>$invoice_status,
        ]);
        Order::where('id', '=', $order_table->id)->update(['invoice_id'=>'INV-'.$date.'-'.$order_table->id]);
   
        $order=$order_table->id;
        Shippingaddress::where('id', $address_details->id)->update(['order_id'=>$order]);
        $per_shipping_amount = $shipping_amount/$total_count;
        foreach ($product as $key2 => $value) {
            Orderproduct::create([
            'order_id'=>$order,
            'product_id'=>$value->product_id,
            'user_id'=>$id,
            'count'=>$value->cart_quantity,
            'amount'=>($value->cart_quantity)*($value->price)+($value->cart_quantity)*$per_shipping_amount,
            'pv'=>($value->cart_quantity)*($value->pvprice),
            ]);
        }
    // $count = InvoiceTable::whereDate('created_at', '=', date('Y-m-d'))->count();
     
    // InvoiceTable::create([
    //     'user_id'=>$id,
    //     'order_id'=>$order,
    //     'invoice_id'=>'INV-'.$date.'-'.$order,
    //     'status'=>$invoice_status,
    // ]);
        $list_orders = Orderproduct::where('order_id', '=', $order)->get();
        foreach ($list_orders as $key => $list_order) {
            $total_product_count = Product::where('id', '=', $list_order->product_id)->value('quantity');
            $pro_purchased_count = $list_order->count;
            if ($total_product_count >=  $pro_purchased_count) {
                $dec=$total_product_count - $pro_purchased_count;
                Product::where('id', '=', $list_order->product_id)->update(['quantity'=>$dec]);
            } else {
                Product::where('id', '=', $list_order->product_id)->update(['quantity'=>0]);
            }
        }
  
     
        Productaddcart::where('user_id', $id)->where('order_status', '=', "pending")->update(['order_status'=>'complete']);
        $current_date=date('Y-m-d H:i:s');
        Productaddcart::where('user_id', '=', $id)->update(['deleted_at'=>$current_date]);
                
        $app_settings = AppSettings::find(1);
        $user_details = User::where('id', $id)->first();
        $shippingaddress = Shippingaddress::where('id', $address_details->id)->first();
        $product_details = Orderproduct::join('product', 'product.id', '=', 'orderproduct.product_id')->where('orderproduct.order_id', $order)->select('product.name', 'orderproduct.amount', 'orderproduct.count', 'product.price')->get();
        $order_details = Order::where('id', $order)->select('total_amount', 'total_count')->get();
   
       
        return 1;
    }
}
