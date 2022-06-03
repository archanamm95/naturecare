<?php
namespace App\Http\Controllers\Admin\ControlPanel\SystemSettings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use App\Models\ControlPanel\Options;
use App\EmailTemplate;
use App\Product;
use App\Category;
use Validator;
use Session;
use App\Welcome;
use App\PaymentNotification;
use App\User;
use App\BlockIP;
use App\Emailsetting;
use App\BackupSettings;
use Redirect;
use Input;

class SettingsController extends AdminController
{
    public function index()
    {
        $title     = trans('controlpanel.control_panel');
        $sub_title = trans('controlpanel.overview');
        $base      = trans('controlpanel.control_panel');
        $method    = trans('controlpanel.control_panel_overview');

        return view('app.admin.control_panel.system_settings.index', compact('title', 'user', 'sub_title', 'base', 'method'));
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $rules = array(
        'system_redirect_login' => 'required',
        'system_redirect' => 'required',
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            (null !== $request->system_redirect_login ? Options::updateOptionByKey('app.system_redirect_login', $request->system_redirect_login) :  '' );
            (null !== $request->system_redirect ? Options::updateOptionByKey('app.system_redirect', $request->system_redirect) :  '' );

            (null !== $request->gtag_value ? Options::updateOptionByKey('app.gtag_value', $request->gtag_value) :  '' );
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('all.successfully_updated_system_settings!')));
            return redirect()->back();
        }
    }
    protected function findOption($key)
    {
        return Options::firstOrNew(['key' => $key]);
    }

    public function db_manager()
    {
        $title     = trans('controlpanel.control_panel');
        $sub_title = trans('controlpanel.overview');
        $base      = trans('controlpanel.control_panel');
        $method    = trans('controlpanel.control_panel_overview');
        $radio = option('app.database_manager');

        return view('app.admin.control_panel.system_settings.db_backup', compact('title', 'user', 'sub_title', 'base', 'method', 'radio'));
    }

  
    public function db_management(Request $request)
    {

        $input = $request->all();
        $rules = array(
          'radioValue' => 'required',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
             return response()->json([
                'state' => 'error',
                'code' => 200
             ]);
        } else {
            (null !== $request->radioValue ? Options::updateOptionByKey('app.database_manager', $request->radioValue) :  '' );


            return response()->json([
            'state' => 'success',
            'code' => 200
            ]);
        }
    }
    public function email_manager()
    {
    //dd(12234);
        $settings    = Welcome::all();
        $set         = PaymentNotification::all();
        $title       = trans('controlpanel.control_panel');
        $sub_title   = trans('controlpanel.overview');
        $base        = trans('controlpanel.control_panel');
        $method      = trans('controlpanel.control_panel_overview');
        $radio       = option('app.database_manager');
        $email_setting=Emailsetting::find(1);

        return view('app.admin.control_panel.system_settings.mail', compact('title', 'settings', 'set',  'sub_title', 'base', 'method', 'radio', 'email_setting'));
    }
    public function updatewelcome(Request $request)
    {
        $settings           = Welcome::find(1);
        $settings->to_email =$request->from;
        $settings->subject  =$request->subject;
        $settings->body     =$request->description;
        $settings->save();
        Session::flash('flash_notification', array('level'=>'success','message'=>trans('settings.details_updated')));
        return redirect()->back();
    }
    public function payout_email(Request $request)
    {
      //dd($request->all());
        $set               = PaymentNotification::find(1);
        $set->from         =$request->from;
        $set->subject      =$request->subject;
        $set->mail_content =$request->description;
        $set->save();
        Session::flash('flash_notification', array('level'=>'success','message'=>trans('settings.details_updated')));
        return redirect()->back();
    }
     /*public function payoutnotification()
    {

        $title     = trans("payout.notification.settings");
        $sub_title = trans("payout.notification.settings");
        $base      = trans("payout.notification.settings");
        $method      = trans("payout.notification.settings");
        $settings  = PaymentNotification::all();
        dd($settings);
        //dd($settings);

        return view('app.admin.control_panel.system_settings.mail', compact('title','sub_title','base','method', 'set', 'sub_title', 'base', 'method'));

    }*/
    // public function payoutupdate(Request $request)
    // {

    //     $package = PaymentNotification::find($request->pk);

    //     $variable = $request->name;

    //     $package->$variable = $request->value;

    //     if ($package->save()) {
    //         return Response::json(array('status' => 1));
    //     } else {
    //         return Response::json(array('status' => 0));
    //     }

    // }

    public function blacklist()
    {

        $title     = trans('controlpanel.blacklist-manager');
        $sub_title = trans('controlpanel.blacklist-manager');
        $base      = trans('controlpanel.blacklist-manager');
        $method    = trans('controlpanel.blacklist-manager');
        $blacklists =  User::where('black_list', 1)->get();
        
        return view('app.admin.control_panel.system_settings.blacklist', compact('title', 'user', 'sub_title', 'base', 'method', 'blacklists'));
    }

    public function updateblacklist(Request $request)
    {
        if (!isset($request->key_user_hidden)) {
            Session::flash('flash_notification', array('level' => 'error', 'message' => trans('controlpanel.please_enter_the_username')));
            return Redirect::back();
        } else {
            $blacklist =  User::where('username', $request->key_user_hidden)->value('black_list');
            if ($blacklist == 1) {
                Session::flash('flash_notification', array('level' => 'error', 'message' =>trans('controlpanel.user_already_blacklisted')));
                return Redirect::back();
            } else {
                User::where('username', $request->key_user_hidden)->update(['black_list'=>'1']);
                Session::flash('flash_notification', array('level' => 'success', 'message' => trans('controlpanel.successfully_blacklisted_the_user')));
                return Redirect::back();
            }
        }
    }

    public function blocklist_delete($id)
    {
        $blocklist = User::where('id', '=', $id)->update(['black_list'=>0]);
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('controlpanel.block_user_deleted_successfully')));
        return redirect()->back();
    }
  
    public function ban_ip()
    {

        $title     = trans('controlpanel.ban_ip');
        $sub_title = trans('controlpanel.ban_ip');
        $base      = trans('controlpanel.ban_ip');
        $method    = trans('controlpanel.ban_ip');

        $block_ips = BlockIP::get();

        
        return view('app.admin.control_panel.system_settings.ban_ip', compact('title', 'user', 'sub_title', 'base', 'method', 'block_ips'));
    }
    public function updateban_ip(Request $request)
    {
        if (!isset($request->ip)) {
            Session::flash('flash_notification', array('level' => 'error', 'message' => trans('controlpanel.please_enter_the_ip_address_to_block')));
            return Redirect::back();
        } else {
          // $ipAddresses = $request->getClientIps();
            BlockIP::create([
            'ip'  => $request->ip,
            ]);
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('controlpanel.ip_blocked_successfully')));
            return Redirect::back();
        }
    }
    public function ban_ip_delete($id)
    {
        $block_ip = BlockIP::find($id);
        $block_ip->delete();
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('controlpanel.blocked_ip_deleted_successfully')));
        return redirect()->back();
    }

    public function helpdeskManager()
    {

        $title     = trans('controlpanel.helpdesk_manager');
        $sub_title = trans('controlpanel.helpdesk_manager');
        $base      = trans('controlpanel.helpdesk_manager');
        $method    = trans('controlpanel.helpdesk_manager');

        return view('app.admin.control_panel.help_desk.help_desk_manager', compact('title', 'sub_title', 'base', 'method'));
    }

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
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('controlpanel.category_deleted')));
        return redirect()->back();
    }

    public function addProduct(Request $request)
    {

      // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'description'   => 'required',
            'quantity'      => 'required|numeric',
            'category'      => 'required',
            'status'      => 'required',
            'price'         => 'required|numeric',
            'savefile' => 'mimes:png,jpeg,jpg',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $create_product = new Product();
            $create_product->name = $request->name;
            $create_product->description = $request->description;
            $create_product->quantity = $request->quantity;
            $create_product->price = $request->price;
            $create_product->status = $request->status;
            $create_product->category_id = $request->category;
            $file = Input::file('savefile');
            $destinationPath = storage_path("files/logo");
            $filename = time() . '.' . $file->getClientOriginalName();
            $upload_success = $file->move($destinationPath, $filename);
            $create_product->image = $filename;
            $create_product->save();
            Session::flash('flash_notification', array('message'=>trans('controlpanel.product_deleted_successfully'),'level'=>'success'));
            return redirect()->back();
        }
    }

    public function deleteProduct($id)
    {

        $product = Product::find($id)->delete();
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('controlpanel.product_deleted_successfully')));
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
            Session::flash('flash_notification', array('message'=>trans('controlpanel.product_updated_successfully'),'level'=>'success'));
            return redirect('admin/control-panel/ecommerce-manager');
        }
    }
    public function smtp_settings(Request $request)
    {

        $email_settings=Emailsetting::find(1);
        $email_settings->host=$request->host;
        $email_settings->port=$request->port;
        $email_settings->username=$request->username;
        $email_settings->password=$request->password;
        $email_settings->from_name=$request->from_name;
        $email_settings->from_email=$request->from_email;
        $email_settings->save();
        Session::flash('flash_notification', array('level'=>'success','message'=>trans('settings.details_updated')));
        return redirect()->back();
    }

    public function backupManager()
    {

        $title     = trans('controlpanel.backup_manager');
        $sub_title = trans('controlpanel.backup_manager');
        $base      = trans('controlpanel.backup_manager');
        $method    = trans('controlpanel.backup_manager');

        $backup_setting = BackupSettings::find(1);
      
         return view('app.admin.control_panel.system_settings.backup_settings', compact('title', 'sub_title', 'base', 'method', 'product', 'category', 'backup_setting'));
    }

    public function postbackupManager(Request $request)
    {
     
        $backup_setting = BackupSettings::find(1);
        $backup_setting->client_id =$request->client_id;
        $backup_setting->client_secret =$request->client_secret;
        $backup_setting->refresh_token =$request->refresh_token;
        $backup_setting->folder_id=$request->folder_id;
        $backup_setting->save();
        Session::flash('flash_notification', array('level'=>'success','message'=>trans('settings.google_drive_details_updated')));
        return redirect()->back();
    }
    //Mail Template
    public function emailTemplates(){
        $title     = trans('settings.email_template');
        $sub_title = trans('settings.email_template');
        $base      = trans('settings.settings');
        $method    = trans('settings.email_template');
        $template_data = EmailTemplate::all();
        $temp_data = EmailTemplate::paginate(10);
     
        return view('app.admin.control_panel.system_settings.email-templates', compact('title', 'sub_title', 'base', 'method','template_data','temp_data'));
    }
    public function emailTemplateEdit($columnName){
        $data = EmailTemplate::find($columnName);

        $template_body = $data->email_content;
        $template_title = $data->title;
        $description = $data->description;
        return response()->json(['template_body' => $template_body,'template_title'=>$template_title,'description'=>$description]);
    }
    public function emailTemplateSave(Request $request){
        $data = EmailTemplate::find($request->id);
        $data->email_content = $request->note_id;
        $data->description     = $request->description;
        $data->save();
        return response()->json(['data' => "success"]);

    }
    public function emailTemplateDelete(Request $request){
        $data = EmailTemplate::find($request->id);
        $data->delete();
        return response()->json(['data' => "success"]);

    }

    public function emailTemplateAdd(Request $request){

        $count = EmailTemplate::count()+1;
        $data = EmailTemplate::create(['title'=>$request->title,
                                       'email_content'=>$request->note_id,
                                       'description' => $request->description,
                                      ]);
        return response()->json(['data' => "success"]);

    }
}
