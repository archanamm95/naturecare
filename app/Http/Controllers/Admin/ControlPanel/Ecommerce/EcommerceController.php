<?php
namespace App\Http\Controllers\Admin\ControlPanel\Ecommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use App\Models\ControlPanel\Options;
use App\Product;
use App\Category;
use Validator;
use Session;
use App\Welcome;
use App\PaymentNotification;
use App\User;
use App\BlockIP;
use Redirect;
use Input;

class EcommerceController extends AdminController
{


    //Ecommerce

    public function ecommerceManager()
    {

        $title     = trans('controlpanel.ecommerce_manager');
        $sub_title = trans('controlpanel.ecommerce_manager');
        $base      = trans('controlpanel.ecommerce_manager');
        $method    = trans('controlpanel.ecommerce_manager');

        $category = Category::all();
        $products = Product::all();

        // dd($products);

          return view('app.admin.control_panel.Ecommerce.index', compact('title', 'user', 'sub_title', 'base', 'method', 'category', 'products'));
    }

    public function category(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors();
        }
        Category::create(['category_name'=> $request->name,
                      'status'       => $request->status ]);
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('controlpanel.category_added')));
        return redirect()->back();
    }

    public function categoryEdit($id)
    {
         
        $title     = trans('controlpanel.category_edit');
        $sub_title = trans('controlpanel.category_edit');
        $base      = trans('controlpanel.category_edit');
        $method    = trans('controlpanel.category_edit');

        $category = Category::find($id);
        
    
        return view('app.admin.control_panel.Ecommerce.category_view_edit', compact('title', 'user', 'sub_title', 'base', 'method', 'category'));
    }

    public function categoryEditPost(Request $request)
    {
   
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors();
        }
        Category::where('id', '=', $request->id)->update(['category_name'=> $request->name,
                      'status'       => $request->status ]);
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('controlpanel.category_updated')));
        return redirect('admin/control-panel/ecommerce-manager');
    }

    public function categoryDelete($id)
    {
   
    
        Category::find($id)->delete();
        Session::flash('flash_notification', array('level' => 'success', 'message' => 'Category deleted'));
        return redirect()->back();
    }

    public function addProduct(Request $request)
    {

      // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'sku'   => 'required',
            'bv'      => 'required|numeric',
            'price'      => 'required',
            'member_price'      => 'required',
            'stock'         => 'required|numeric',
            'savefile' => 'mimes:png,jpeg,jpg',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $create_product = new Product();
            $create_product->name = $request->name;
            $create_product->sku = $request->sku;
            $create_product->bv = $request->bv;
            $create_product->price = $request->price;
            $create_product->category_id = $request->member_price;
            $create_product->quantity = $request->stock;
            $file = Input::file('savefile');
            // $destinationPath = storage_path("files/logo");
            $destinationPath =public_path() . '/uploads/documents';
                
            $filename = time() . '.' . $file->getClientOriginalName();
            $upload_success = $file->move($destinationPath, $filename);
            $create_product->image = $filename;
            $create_product->save();
            Session::flash('flash_notification', array('message'=>"Product Added Successfully ",'level'=>'success'));
            return redirect()->back();
        }
    }

    public function deleteProduct($id)
    {

        $product = Product::find($id)->delete();
        Session::flash('flash_notification', array('level' => 'success', 'message' => 'Product Deleted Successfully'));
        return redirect()->back();
    }

    public function EditProduct($id)
    {
         
        $title     = trans('controlpanel.product_edit');
        $sub_title = trans('controlpanel.product_edit');
        $base      = trans('controlpanel.product_edit');
        $method    = trans('controlpanel.product_edit');

        $product = Product::find($id);
        $category = Category::where('status', '=', 'yes')->get();
        
    
        return view('app.admin.control_panel.Ecommerce.product_view_edit', compact('title', 'user', 'sub_title', 'base', 'method', 'product', 'category'));
    }

    public function EditProductPost(Request $request)
    {

     // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'description'   => 'required',
            'quantity'      => 'required|numeric',
            'category'      => 'required',
            'status'      => 'required',
            'price'         => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $edit_product = Product::find($request->id);
            $edit_product->name = $request->name;
            $edit_product->description = $request->description;
            $edit_product->quantity = $request->quantity;
            $edit_product->price = $request->price;
            $edit_product->status = $request->status;
            $edit_product->category_id = $request->category;
            $edit_product->save();
            Session::flash('flash_notification', array('message'=>"Product Updated Successfully ",'level'=>'success'));
            return redirect('admin/control-panel/ecommerce-manager');
        }
    }
}
