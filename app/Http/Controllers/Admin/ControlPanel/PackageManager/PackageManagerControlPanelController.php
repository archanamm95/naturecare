<?php
namespace App\Http\Controllers\admin\ControlPanel\PackageManager;

use App\AppSettings;
use App\Models\ControlPanel\Options;
use App\AutoResponse;
use App\Emailsetting;
use App\Http\Controllers\Admin\AdminController;
use App\MenuSettings;
use App\PaymentNotification;
use App\PaymentType;
use App\Ranksetting;
use App\Settings;
use App\Packages;
use App\User;
use App\Welcome;
use App\Product;
use App\StockManagement;
use Auth;
use Illuminate\Http\Request;
use Input;
use Redirect;
use Response;
use Session;
use Validator;
use App\SharePartner;

class PackageManagerControlPanelController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $title     = trans('controlpanel.package_manager');
        $sub_title = trans('controlpanel.package_manager');
        $base      = trans('controlpanel.package_manager');
        $method    = trans('controlpanel.package_manager');
        
        $packages  = Packages::all();
        return view('app.admin.control_panel.package_manager.index', compact('title', 'sub_title', 'base', 'method', 'packages'));
    }


    public function view_edit($id)
    {

        $title     = trans('controlpanel.package_edit');
        $sub_title = trans('controlpanel.package_edit');
        $base      = trans('controlpanel.package_edit');
        $method    = trans('controlpanel.package_edit');
        
        $package  = Packages::find($id);
        return view('app.admin.control_panel.package_manager.view_edit', compact('title', 'sub_title', 'base', 'method', 'package'));
    }


    public function update(Request $request, $id)
    {
  
        $input = $request->all();
        $rules = array(
            'package' => 'required',
            // 'amount' => 'required',
            'pv' => 'required',
            'product_count' => 'required',
            // 'daily_limit' => 'required',
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            // (null !== $request->package ? Packages::where('app.theme_font_size',$request->theme_font_size) :  '' );
            $package = Packages::find($id);


            $package->package = $request->package;
            // $package->amount = $request->amount;
            $package->pv = $request->pv;
            $package->product_count = $request->product_count;
            // $package->daily_limit = $request->daily_limit;

            if ($package->save()) {
                Session::flash('flash_notification', array('level' => 'success', 'message' => trans('all.successfully_updated_package!')));
                    return redirect('admin/control-panel/package-manager');
            } else {
                Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('all.could_not_update_package_details!')));
                    return redirect('admin/control-panel/package-manager');
            }
        }
    }

    public function product()
    {

        $title     = trans('controlpanel.product_manager');
        $sub_title = trans('controlpanel.product_manager');
        $base      = trans('controlpanel.product_manager');
        $method    = trans('controlpanel.product_manager');
        
        $products  = Product::all();
        return view('app.admin.control_panel.package_manager.product', compact('title', 'sub_title', 'base', 'method', 'products'));
    }
    public function product_view_edit($id)
    {

        $title     = trans('controlpanel.product_edit');
        $sub_title = trans('controlpanel.product_edit');
        $base      = trans('controlpanel.product_edit');
        $method    = trans('controlpanel.product_edit');
        
        $package  = Product::find($id);
        return view('app.admin.control_panel.package_manager.product_view_edit', compact('title', 'sub_title', 'base', 'method', 'package'));
    }
    public function productupdate(Request $request, $id)
    {
        $input = $request->all();
        $rules = array(
            'name' => 'required',
            'bv' => 'required',
            'category_id' => 'required',
            'price' => 'required', 
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            if (Input::hasFile('image')) {
                $destinationPath = public_path() . '/uploads/documents';
                $extension       = Input::file('image')->getClientOriginalExtension();
                $fileName        = rand(000011111, 99999999999) . '.' . $extension;
                Input::file('image')->move($destinationPath, $fileName);
                $image           = $fileName;
            }
            $package = Product::find($id);

            $old_quantity = $package->quantity;
            $package->name = $request->name;
            $package->bv = $request->bv;
            $package->category_id = $request->category_id;
            $package->price = $request->price;
            if($request->quantity > 0){
              $package->quantity = $request->quantity+ $package->quantity;

              StockManagement::create(['user_id'       => Auth::user()->id,
                                       'product_id'    => $id,
                                       'in'            => $request->quantity,
                                       'out'           => 0,
                                       'balance'       => $package->quantity,
                                   ]);
            }
            $package->sku = $request->sku;
            if(isset($image) && !empty($image)) 
                $package->image = $image;

            if ($package->save()) {
                Session::flash('flash_notification', array('level' => 'success', 'message' => trans('all.successfully_updated_product')));
                    return redirect('admin/control-panel/product-manager');
            } else {
                Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('all.could_not_update_product_details')));
                    return redirect('admin/control-panel/product-manager');
            }
        }
    }


    public function sharePartner()
    {
        $title     = "Share Partner Package";
        $sub_title = "Share Partner Package";
        $base      = "Share Partner Package";
        $method    = "Share Partner Package";

        $product = sharePartner::select('id','Products','quantity')->get();

        return view('app.admin.control_panel.share_partner.index',compact('title', 'sub_title', 'base', 'method','product'));
    }

    public function updateSharePackage(Request $request)
    {
        foreach ($request->quantity as $key => $value) {
            sharePartner::where('id',$key)->update(['quantity'=> $value]);
        }
        
        Session::flash('flash_notification', array('level' => 'success', 'message' => 'Successfully updated'));
        return redirect()->back();
      
    }
}
