<?php
namespace App\Http\Controllers\admin;

use App\AppSettings;
use App\AutoResponse;
use App\Emailsetting;
use App\Http\Controllers\Admin\AdminController;
use App\MenuSettings;
use App\PaymentNotification;
use App\PaymentType;
use App\Ranksetting;
use App\Emails;
use App\Settings;
use App\User;
use App\EmailTemplate;
use App\Welcome;
use App\Role;
use App\MyRole;
use Datatables;
use Auth;
use Illuminate\Http\Request;
use Validator;
use Input;
use Redirect;
use Response;
use Session;
use Mail;

use App\Jobs\SendEmail;

class SettingsController extends AdminController
{


         //subadmin

     public function viewalladmin(){

        $title     = trans('registration.view_all_admin');
        $sub_title = trans('registration.view_all_admin');
        $base      = trans('registration.view_all_admin');
        $method    = trans('registration.view_all_admin');

        return view('app.admin.settings.adminview', compact('title', 'sub_title', 'base', 'method'));

    }

    public function adminview()
    {

          $user_count=User::where('admin','=',1)->where('id','<>',1)->count();
          $users=User::where('register_by','=','adminregister')->where('id','<>',1)->select('id','name','username','email','user_type','created_at')->get();

          return Datatables::of($users)
                ->editColumn('created_at', '{{ date("d:M:Y H:i:s",strtotime($created_at)) }}')
                ->editColumn('user_type', '<?php  echo str_replace("_", " ", "$user_type") ;  ?>')
                ->addColumn('action','<a href="{{{ URL::to(\'admin/userprofiles/\' . $username . \'#update\') }}}" class="btn btn-info btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a href="{{{ URL::to(\'admin/deleteadmin/\' . $id ) }}}" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>')
                ->removeColumn('id')
                ->setTotalRecords($user_count)
                ->escapeColumns([])
                ->make();

    }
    public function deleteadmin($id){
     
        $deleteid=User::find($id);
        $deleteid->delete();

        Session::flash('flash_notification', array('level' => 'success', 'message' =>trans('admin.admin_deleted_successfully')));
        
        return redirect()->back();

    }
      public function postassign($id)
    {
    
        $title     = trans('registration.assign_roles');
        $sub_title = trans('registration.assign_roles');
        $base      = trans('registration.assign_roles');
        $method    = trans('registration.assign_roles'); 

        $my_roles  = MyRole::where('user_id',$id)->value('role_id');
       
        if(isset($my_roles))
        $menu_id = json_decode($my_roles, true);

        $roles      = Role::where('is_root','yes')->where('id','>',1)->get();
        $sub_roles   = Role::where('is_root','no')->get();


       
        $emp_id     = $id;
        $employee   = User::where('id',$id)->value('username'); 
    
        return view('app.admin.settings.postassignroles',compact('title','sub_title','base','method','roles','employee','emp_id','sub_roles','menu_id'));
    }
    public function saverole(Request $request)
    {
        $menus=array();
        $menu_id=$request->menu;
        if(!isset($menu_id)){
            Session::flash('flash_notification', array('level' => 'danger', 'message' => 'Please select Roles'));
            return Redirect::action('Admin\SettingsController@viewalladmin'); 
        }
        $limit=count($menu_id);
        for ($i=0; $i <$limit ; $i++) { 
        // $menus[]=Role::where('id','=',$menu_id[$i])->select('id','parent_id')->first()->toArray();;
        $menus[]=Role::where('id','=',$menu_id[$i])->value('id');
           // $x= json_encode($menus);
        }
     
        MyRole::where('user_id',$request->emp_id)->delete();
        $a= MyRole::create([
               'user_id' => $request->emp_id,
               'role_id' => json_encode($menus)
               ]);
     

        Session::flash('flash_notification', array('level' => 'success', 'message' => 'Roles assigned  successfully'));
        return Redirect::action('Admin\SettingsController@viewalladmin'); 

    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
  
    public function saveTheme(Request $request)
    {

        $app        = AppSettings::find(1);
        $app->theme = $request->theme;
        $app->save();
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('settings.theme_change')));
        return Redirect::action('Admin\SettingsController@themesettings');
    }

    public function getUploadForm()
    {
        return View::make('image/upload-form');
    }

    public function postUpload()
    {
        $file  = Input::file('image');
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
        } else {
            $destinationPath = 'assets/images';
            $filename        = $file->getClientOriginalName();
            Input::file('image')->move($destinationPath, $filename);
            return Response::json(['success' => true, 'file' => asset($destinationPath . $filename)]);
        }
    }

  

    public function themesettings()
    {

        $title     = trans('settings.theme_settings');
        $sub_title = trans('settings.theme_settings_panel');
        $base      = trans('settings.settings');
        $method    = trans('settings.theme_settings');
        return view('app.admin.settings.themesettings', compact('title', 'settings', 'sub_title', 'base', 'method'));
    }


    public function upload()
    {
        if (Input::hasFile('file')) {
            //upload an image to the /img/tmp directory and return the filepath.

            $file        = Input::file('file');
            $tmpFilePath = '/assets/images/';
            $tmpFileName = time() . '-' . $file->getClientOriginalName();
            $file        = $file->move(public_path() . $tmpFilePath, $tmpFileName);
            $path        = '/public' . $tmpFilePath . $tmpFileName;
            $app         = AppSettings::find(1);
            $app->logo   = $tmpFileName;
            $app->save();
            return response()->json(array('path' => $path), 200);
        } else {
            return response()->json(false, 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {

        $settings = Settings::find($request->pk);

        $data_name = $request->name;

        $settings->$data_name = $request->value;

        if ($settings->save()) {
            return Response::json(array('status' => 1));
        } else {
            return Response::json(array('status' => 0));
        }
    }

    public function getallranks()
    {
        $settings    = Ranksetting::all();
        $response    = [];
        $response[0] = "NA";
        foreach ($settings as $key => $value) {
            $response[$value->rank_code] = $value->rank_name;
        }
        return json_encode($response, false);
        // return Response::json($response);
    }
    // public function savelogo(){
    // }
    public function stores(Request $request)
    {

        $image = new Image();
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required',
        ]);
        $image->title       = $request->title;
        $image->description = $request->description;
        if ($request->hasFile('image')) {
            $file            = Input::file('image');
            $name            = time() . '-' . $file->getClientOriginalName();
            $image->filePath = $name;

            $file->move(public_path() . '/assets/images/', $name);
        }
        $image->save();
        return $this->create()->with('success', trans('settings.image_upload'));
    }



    public function email()
    {

        $title     = trans('ticket_config.email_settings');
        $sub_title = "Email Settings";
        $base      = "Email Settings";
        $method    = "Email Settings";

        $settings = Emailsetting::all();
       
        return view('app.admin.settings.emailsetting', compact('title', 'settings', 'sub_title', 'base', 'method'));
    }

    public function updateemailsetting(Request $request)
    {
        $settings = Emailsetting::find($request->pk);

        $data_name = $request->name;

        $settings->$data_name = $request->value;

        if ($settings->save()) {
            return Response::json(array('status' => 1));
        } else {
            return Response::json(array('status' => 0));
        }
    }

    public function welcome()
    {

        $settings = Welcome::all();
        // $title= trans('settings.rank_settings');
        $title     = trans('ticket_config.welcome_email');
        $sub_title = "Welcome Email";
        $base      = "Welcome Email";
        $method    = "Welcome Email";
        //$unread_count  = Mail::unreadMailCount(Auth::id());
        //$unread_mail  = Mail::unreadMail(Auth::id());
        //$userss = User::getUserDetails(Auth::id());
        //$user = $userss[0];
        return view('app.admin.settings.welcomesetting', compact('title', 'settings', 'sub_title', 'base', 'method'));
    }

    public function updatewelcome(Request $request)
    {
        $settings = Welcome::find($request->pk);

        $data_name = $request->name;

        $settings->$data_name = $request->value;

        if ($settings->save()) {
            return Response::json(array('status' => 1));
        } else {
            return Response::json(array('status' => 0));
        }
    }

    // public function changelogo()
    // {
    //     // $settings=Ranksetting::all();
    //     // //$title= trans('settings.rank_settings');
    //     // $title= "Change Logo";
    //     // $sub_title =  trans('settings.rank_settings_panel');
    //     // $base = trans('settings.settings');
    //     // $method =  trans('settings.rank_settings');
    //     // //$unread_count  = Mail::unreadMailCount(Auth::id());
    //     // //$unread_mail  = Mail::unreadMail(Auth::id());
    //     // $userss = User::getUserDetails(Auth::id());
    //     // $user = $userss[0];
    //     // return view('app.admin.settings.changelogo',compact('title','settings','user','sub_title','base','method'));
    //     Assets::addCSS(asset('assets/admin/css/profile.css'));
    //     Assets::addCSS(asset('assets/user/css/bootstrap-fileupload/bootstrap-fileupload.min.css'));

    //     Assets::addJS(asset('assets/user/js/bootstrap-fileupload/bootstrap-fileupload.min.js'));

    //     // $app=AppSettings::all();
    //        $app = AppSettings::find(1);
    //        $logo=$app->logo;

    //     $title= "Change logo";
    //     $sub_title =trans('settings.app_settings_panel');
    //     $base = trans('settings.settings');
    //     $method =  trans('settings.app_settings');
    //     $userss = User::getUserDetails(Auth::id());
    //     $user = $userss[0];
    //  return view('app/admin/logo',compact('title','settings','user','sub_title','base','method','logo'));

    // }

    public function getUploadLogo()
    {

        // $app=AppSettings::all();
        $app  = AppSettings::find(1);
        $logo = $app->logo;
        $logo_ico = $app->logo_ico;
        $id=$app->id;
        $settings  = AppSettings::all();
        $title     = trans('ticket_config.change_logo');
        $sub_title = trans('settings.app_settings_panel');
        $base      = trans('settings.settings');
        $method    = trans('settings.app_settings');
        $userss    = User::getUserDetails(Auth::id());
        $user      = $userss[0];
        return view('app.admin.settings.logo', compact('title', 'settings', 'user', 'sub_title', 'base', 'method', 'logo', 'logo_ico', 'id'));
    }
    
    public function updateImage(Request $request)
    {
        if (Input::hasFile('file') && Input::hasFile('file2')) {
        // upload an image to the /img/tmp directory and return the filepath.
            $file = Input::file('file');
            $tmpFilePath = '/assets/images/';
            $tmpFileName = time() . '-' . $file->getClientOriginalName();
            $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
            $path = '/public'.$tmpFilePath . $tmpFileName;
            $app = AppSettings::find(1);
            $app->logo = $tmpFileName;

            $app->save();

            $file = Input::file('file2');
            $tmpFilePath = '/assets/images/';
            $tmpFileName = time() . '-' . $file->getClientOriginalName();
            $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
            $path = '/public'.$tmpFilePath . $tmpFileName;
            $app = AppSettings::find(1);
            $app->logo_ico = $tmpFileName;

            $app->save();

        // Session::flash('flash_notification', array('level' => 'danger', 'message' => 'You dont have the permission to change the logo'));
            return Redirect::action('Admin\SettingsController@getUploadLogo');
        } elseif (Input::hasFile('file')) {
            $file = Input::file('file');
            $tmpFilePath = '/assets/images/';
            $tmpFileName = time() . '-' . $file->getClientOriginalName();
            $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
            $path = '/public'.$tmpFilePath . $tmpFileName;
            $app = AppSettings::find(1);
            $app->logo = $tmpFileName;

            $app->save();
            return Redirect::action('Admin\SettingsController@getUploadLogo');
        } elseif (Input::hasFile('file2')) {
            $file = Input::file('file2');
            $tmpFilePath = '/assets/images/';
            $tmpFileName = time() . '-' . $file->getClientOriginalName();
            $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
            $path = '/public'.$tmpFilePath . $tmpFileName;
            $app = AppSettings::find(1);
            $app->logo_ico = $tmpFileName;

            $app->save();
            return Redirect::action('Admin\SettingsController@getUploadLogo');
        } else {
            return Redirect::action('Admin\SettingsController@getUploadLogo');
        }
    }

    //  public function uploads() {

    //        if(Input::hasFile('file')) {

    //       //upload an image to the /img/tmp directory and return the filepath.
    //       $file = Input::file('file');
    //       $tmpFilePath = '/assets/images/';
    //       $tmpFileName = time() . '-' . $file->getClientOriginalName();
    //       $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
    //       $path = '/public'.$tmpFilePath . $tmpFileName;
    //       $app = AppSettings::find(1);
    //       $app->logo = $tmpFileName;

    //       $app->save();

    //       Session::flash('flash_notification',array('level'=>'success','message'=>'Logo changed Successfully'));
    //         return Redirect::action('Admin\SettingsController@getUploadLogo');
    //         }
    //         Session::flash('flash_notification',array('level'=>'danger','message'=>'No file selected'));
    //         return Redirect::action('Admin\SettingsController@getUploadLogo');
    //   }

    // public function savelogo(){

    //     if(Input::hasFile('file')) {

    //       //upload an image to the /img/tmp directory and return the filepath.
    //          $file = Input::file('file');
    //       $tmpFilePath = '/assets/images/';
    //       $tmpFileName = time() . '-' . $file->getClientOriginalName();
    //       $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
    //       $path = '/public'.$tmpFilePath . $tmpFileName;
    //       $app = AppSettings::find(1);
    //       $app->logo = $tmpFileName;
    //       $app->save();
    //     if($user->save()){
    //              Session::flash('flash_notification',array('level'=>'success','message'=>'Logo changed Successfully'));
    //              return Redirect::action('Admin\SettingsController@getUploadLogo');
    //          }else{
    //             Session::flash('flash_notification',array('level'=>'danger','message'=>'No file selected'));
    //             return Redirect::action('Admin\SettingsController@getUploadLogo');
    //   }
    //  }

    // }
    public function autoresponder()
    {

        $title     = trans('menu.Auto_Responder');
        $sub_title = "Text your message";
        //$unread_count  = Mail::unreadMailCount(Auth::id());
        //$unread_mail  = Mail::unreadMail(Auth::id());
        $base = 'Email';

        $method = 'Auto Responder';
        $users  = User::getUserDetails(Auth::id());
        $user   = $users[0];
        $res    = AutoResponse::all();
        // dd($res);die();
        return view('app.admin.autoresponder.autoresponse', compact('title', 'user', 'sub_title', 'base', 'method', 'res'));
    }
    public function save(Request $request)
    {
        $response          = new AutoResponse();
        $response->subject = $request->subject;
        $response->content = $request->content;
        $response->date    = $request->date;
        $response->save();

        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('settings.response_created')));
        return Redirect::action('Admin\SettingsController@autoresponder');
    }
    public function updateresponse(Request $request)
    {
        AutoResponse::where('id', $request->id)->update(array('subject' => $request->subject, 'content' => $request->content, 'date' => $request->date));
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('settings.response_updated')));
        return Redirect::action('Admin\SettingsController@autoresponder', array('id' => $request->id));
    }
    public function editresponse($id)
    {
        $response = AutoResponse::where('id', $id)->get();

        $title     = 'Auto Responder';
        $sub_title = "Text your message";
        //$unread_count  = Mail::unreadMailCount(Auth::id());
        //$unread_mail  = Mail::unreadMail(Auth::id());
        $base = 'Email';

        $method = 'Auto Responder';
        $users  = User::getUserDetails(Auth::id());
        $user   = $users[0];

        return view('app.admin.autoresponder.aredit', compact('title', 'user', 'sub_title', 'base', 'method', 'response'));
    }
    public function deleteresponse($id)
    {

        $title     = 'Auto Responder';
        $sub_title = "Text your message";
        $base      = 'Email';
        $method    = 'Auto Responder';
        $users     = User::getUserDetails(Auth::id());
        $user      = $users[0];
        $response  = AutoResponse::where('id', $id)->get();

        return view('app.admin.autoresponder.ardelete', compact('title', 'user', 'sub_title', 'base', 'method', 'response'));
    }
    public function deleteconfirms(Request $request)
    {

        $res = AutoResponse::where('id', $request->cid)->delete();
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('settings.response_details')));
        return Redirect::action('Admin\SettingsController@autoresponder');
    }

    //   public function voucherlist()
    // {

    //     $title = 'Voucher Create';
    //     return view('app.admin.voucher.index',compact('title'));

    // }

    public function paymentgateway()
    {

        $title        = "Payment Gateway Settings";
        $sub_title    = "Payment Gateway Settings";
        $base         = "Payment Gateway Settings";
        $method       = "Payment Gateway Settings";
        $payment_type = PaymentType::all();
        return view('app.admin.settings.payment', compact('title', 'payment_type', 'sub_title', 'base', 'method'));
    }
    public function paymentstatus(Request $request)
    {

        $title  = "Payment Gateway Settings";
        $status = $request->decision;
        $id     = $request->id;

        PaymentType::where('id', $id)
            ->update(['status' => $status]);

        echo "ok";
    }

    public function payoutnotification()
    {

        $title     = trans("payout.notification.settings");
        $sub_title = trans("payout.notification.settings");
        $base      = trans("payout.notification.settings");
        $method      = trans("payout.notification.settings");
        $settings  = PaymentNotification::all();

        return view('app.admin.settings.payoutnotification', compact('title', 'sub_title', 'base', 'method', 'settings', 'sub_title', 'base', 'method'));
    }
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

    public function menusettings()
    {

        $title     = "Block Options";
        $sub_title = "Block Options";
        $base      = "Block Options";
        $method    = "Block Options";
        $menu_name = MenuSettings::all();
        return view('app.admin.settings.menusettings', compact('title', 'menu_name', 'sub_title', 'base', 'method'));
    }
    public function menuupdate(Request $request)
    {

        $title  = "Block Options";
        $status = $request->decision;
        $id     = $request->id;
//dd($status);
        MenuSettings::where('id', $id)
            ->update(['status' => $status]);

        echo "ok";
    }
    public function notificationpayout()
    {
        $settings  = Settings::all();
        $title     = trans('payout.payout_notification_settings');
        $sub_title = trans('payout.payout_notification_settings');
        $base      = trans('payout.payout_notification_settings');
        $method    = trans('payout.payout_notification_settings');
        //$unread_count  = Mail::unreadMailCount(Auth::id());
        //$unread_mail  = Mail::unreadMail(Auth::id());
        $userss = User::getUserDetails(Auth::id());
        $user   = $userss[0];
        return view('app.admin.settings.payoutsettingsnotification', compact('title', 'settings', 'user', 'sub_title', 'base', 'method'));
    }

    public function payout_access_settings(Request $request)
    {
        $status=$request->decision;
        $id=$request->id;
        $user = Settings::findOrFail($request->id);

        if ($user->payout_notification == '1') {
            Settings::where('id', $id)->update(['payout_notification' => '0']);
        } else {
            Settings::where('id', $id)->update(['payout_notification' => '1']);
            
            
            /**
             * Returning app_settings to get company name
             * @var [collection]
             */
            $app_settings = AppSettings::find(1);
            
            
            //  $user=User::where('id', '<>', '1')->get();
            // foreach ($user as $newuser) {
            //     $setting=PaymentNotification::find(1);
            //     Mail::send(
            //         'emails.pay',
            //         ['email'         => $setting->from,
            //         'company_name'   => $app_settings->company_name,
            //         'firstname'      => $newuser->name,
            //         'name'           => $newuser->lastname,
            //         'login_username' => $newuser->username,
            //         'content'=>'Now you can payout successfully',
            //         ],
            //         function ($m) use ($newuser, $setting) {
            //             $m->to($newuser->email, $newuser->name)->subject('Ready to Payout')->from($setting->from, "Admin");
            //         }
            //     );
            // }
        }
        echo "ok";
    }
    public function sendMail()
    {  

        $title     = trans('registration.send_mail');
        $sub_title = trans('registration.send_mail');
        $base      = trans('registration.send_mail');
        $method    = trans('registration.send_mail');

     
        $users = User::select('id','username')->where('id','>',1)->get();
        $emailTemplates = EmailTemplate::select('id','title')->get();
        $emailTemplate = EmailTemplate::select('id','title')->get();

        return view('app.admin.settings.sendMail',compact('title','sub_title','base','method','users','emailTemplates','emailTemplate'));

    }           
    public function sendMailToBulkUser(Request $request)
    {   
        if(isset($request->select_all)){
            $request->to = 'all';
            $validator = Validator::make($request->all(), [
                'mail'       => 'required|exists:email_templates,id',
            ]);
        }
        else{            
            $validator = Validator::make($request->all(), [
                'to'         => 'required',
                'mail'       => 'required|exists:email_templates,id',
            ]);
        }
        if ($validator->fails()) {
        return response()->json(['data' => "Invalid details"]);
        }

        $email = Emails::find(1);
        $all_users_comma  = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $request->to);
        $all_users = explode(',', $all_users_comma);
        // foreach ($all_users as $key => $value) {
        //     $to_UserData = EmailTemplate::where('id',$request->mail)->first();
        //     if($value == "all"){
        //         $users = User::where('admin',0)->get();
        //         foreach ($users as $key => $user) {
        //             SendEmail::dispatch($to_UserData, $user->email,  $user->name, 'mailtemplate')
        //                         ->delay(now()->addSeconds(5));
        //         }
                
        //     }else{
        //         $user    = User::where('username',$value)->first();
        //         SendEmail::dispatch($to_UserData, $user->email,  $user->name, 'mailtemplate')
        //                             ->delay(now()->addSeconds(5));
                // Mail::send('emails.mailtemplate',
                //   [ 'company_name'   => $app_settings->company_name,
                //     'email'          => $to_UserData->email_content,
                //   ], function ($m) use ($email,$UserData,$to_UserData) {
                //      $m->to($UserData->email, $UserData->firstname)->subject($to_UserData->title)->from($email->from_email, $email->from_name);
                //  });
        //     }
        // }
        // Session::flash('flash_notification',array('message'=>"Mail Send Successfully",'level'=>'success'));
        return redirect()->back();
    }  
}
