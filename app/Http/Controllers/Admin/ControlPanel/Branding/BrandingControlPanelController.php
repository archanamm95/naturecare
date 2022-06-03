<?php
namespace App\Http\Controllers\admin\ControlPanel\Branding;

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
use App\User;
use App\Welcome;
use Auth;
use Illuminate\Http\Request;
use Input;
use Redirect;
use Response;
use Session;
use Larinfo;
use Validator;

class BrandingControlPanelController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $title     = trans('controlpanel.branding');
        $sub_title = trans('controlpanel.branding');
        $base      = trans('controlpanel.branding');
        $method    = trans('controlpanel.branding');
        

        

        return view('app.admin.control_panel.branding.index', compact('title', 'sub_title', 'base', 'method'));
    }


    public function UpdateBranding(Request $request)
    {

        $input = $request->all();
        $rules = array(
            'company_name' => 'required',
            'company_email' => 'required|email',
            'company_address' => 'required',
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            (null !== $request->company_name ? Options::updateOptionByKey('app.company_name', $request->company_name) :  '' );
            (null !== $request->company_email ? Options::updateOptionByKey('app.company_email', $request->company_email) :  '' );
            (null !== $request->company_address ? Options::updateOptionByKey('app.company_address', $request->company_address) :  '' );
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('all.successfully updated!')));
            return redirect()->back();
        }
    }

//     public function saveTheme(Request $request)
//     {

//         $app        = AppSettings::find(1);
//         $app->theme = $request->theme;
//         $app->save();
//         Session::flash('flash_notification', array('level' => 'success', 'message' => trans('settings.theme_change')));
//         return Redirect::action('Admin\SettingsController@themesettings');

//     }

//     public function getUploadForm()
//     {
//         return View::make('image/upload-form');
//     }

//     public function postUpload()
//     {
//         $file  = Input::file('image');
//         $input = array('image' => $file);
//         $rules = array(
//             'image' => 'image',
//         );
//         $validator = Validator::make($input, $rules);
//         if ($validator->fails()) {
//             return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);

//         } else {
//             $destinationPath = 'assets/images';
//             $filename        = $file->getClientOriginalName();
//             Input::file('image')->move($destinationPath, $filename);
//             return Response::json(['success' => true, 'file' => asset($destinationPath . $filename)]);
//         }

//     }

//     public function ranksetting()
//     {
//         $settings  = Ranksetting::all();
//         $title     = trans('settings.rank_settings');
//         $sub_title = trans('settings.rank_settings_panel');
//         $base      = trans('settings.settings');
//         $method    = trans('settings.rank_settings');
//         //$unread_count  = Mail::unreadMailCount(Auth::id());
//         //$unread_mail  = Mail::unreadMail(Auth::id());
//         $userss = User::getUserDetails(Auth::id());
//         $user   = $userss[0];
//         return view('app.admin.settings.ranksetting', compact('title', 'settings', 'user', 'sub_title', 'base', 'method'));
//     }

//     public function themesettings()
//     {

//         $title     = trans('settings.theme_settings');
//         $sub_title = trans('settings.theme_settings_panel');
//         $base      = trans('settings.settings');
//         $method    = trans('settings.theme_settings');
//         return view('app.admin.settings.themesettings', compact('title', 'settings', 'sub_title', 'base', 'method'));
//     }

//     public function appsettings()
//     {
//         $settings  = AppSettings::all();
//         $title     = trans('settings.application_settings');
//         $sub_title = trans('settings.app_settings_panel');
//         $base      = trans('settings.settings');
//         $method    = trans('settings.app_settings');
//         //$unread_count  = Mail::unreadMailCount(Auth::id());
//         //$unread_mail  = Mail::unreadMail(Auth::id());
//         $userss = User::getUserDetails(Auth::id());
//         $user   = $userss[0];
//         return view('app.admin.settings.appsettings', compact('title', 'settings', 'user', 'sub_title', 'base', 'method'));
//     }
//     public function updateappsettings(Request $request)
//     {
//         $app_settings             = AppSettings::find(1);
//         $data_name                = $request->name;
//         $app_settings->$data_name = $request->value;
//         $app_settings->save();
//         return Response::json(array('status' => 1));
//     }
//     public function upload()
//     {
//         if (Input::hasFile('file')) {
//             //upload an image to the /img/tmp directory and return the filepath.

//             $file        = Input::file('file');
//             $tmpFilePath = '/assets/images/';
//             $tmpFileName = time() . '-' . $file->getClientOriginalName();
//             $file        = $file->move(public_path() . $tmpFilePath, $tmpFileName);
//             $path        = '/public' . $tmpFilePath . $tmpFileName;
//             $app         = AppSettings::find(1);
//             $app->logo   = $tmpFileName;
//             $app->save();
//             return response()->json(array('path' => $path), 200);

//         } else {
//             return response()->json(false, 200);
//         }
//     }

//     // /**
//     //  * Update the specified resource in storage.
//     //  *
//     //  * @param  Request  $request
//     //  * @param  int  $id
//     //  * @return Response
//     //  */
//     // public function update(Request $request)
//     // {

//     //     $settings = Settings::find($request->pk);

//     //     $data_name = $request->name;

//     //     $settings->$data_name = $request->value;

//     //     if ($settings->save()) {
//     //         return Response::json(array('status' => 1));
//     //     } else {
//     //         return Response::json(array('status' => 0));
//     //     }

//     // }

//     public function getallranks()
//     {
//         $settings    = Ranksetting::all();
//         $response    = [];
//         $response[0] = "NA";
//         foreach ($settings as $key => $value) {
//             $response[$value->rank_code] = $value->rank_name;
//         }
//         return json_encode($response, false);
//         // return Response::json($response);
//     }
//     // public function savelogo(){
//     // }
//     public function stores(Request $request)
//     {

//         $image = new Image();
//         $this->validate($request, [
//             'title' => 'required',
//             'image' => 'required',
//         ]);
//         $image->title       = $request->title;
//         $image->description = $request->description;
//         if ($request->hasFile('image')) {
//             $file            = Input::file('image');
//             $name            = time() . '-' . $file->getClientOriginalName();
//             $image->filePath = $name;

//             $file->move(public_path() . '/assets/images/', $name);
//         }
//         $image->save();
//         return $this->cretmpFilePathate()->with('success', trans('settings.image_upload'));
//     }

//     public function updateranksetting(Request $request)
//     {
//         $settings  = Ranksetting::find($request->pk);
//         $data_name = $request->name;
//         if ($request->name == "quali_rank_id") {
//             $request->value = Ranksetting::where('rank_code', $request->value)->pluck('id');
//         }

//         $settings->$data_name = $request->value;
//         $settings->save();
//         return Response::json(array('status' => 1));
//     }

//     public function email()
//     {

//         $title     = trans('ticket_config.email_settings');
//         $sub_title = "Email Settings";
//         $base      = "Email Settings";
//         $method    = "Email Settings";

//         $settings = Emailsetting::all();
       
//         return view('app.admin.settings.emailsetting', compact('title', 'settings', 'sub_title', 'base', 'method'));

//     }

//     public function updateemailsetting(Request $request)
//     {
//         $settings = Emailsetting::find($request->pk);

//         $data_name = $request->name;

//         $settings->$data_name = $request->value;

//         if ($settings->save()) {
//             return Response::json(array('status' => 1));
//         } else {
//             return Response::json(array('status' => 0));
//         }

//     }

//     public function welcome()
//     {

//         $settings = Welcome::all();
//         // $title= trans('settings.rank_settings');
//         $title     = trans('ticket_config.welcome_email');
//         $sub_title = "Welcome Email";
//         $base      = "Welcome Email";
//         $method    = "Welcome Email";
//         //$unread_count  = Mail::unreadMailCount(Auth::id());
//         //$unread_mail  = Mail::unreadMail(Auth::id());
//         //$userss = User::getUserDetails(Auth::id());
//         //$user = $userss[0];
//         return view('app.admin.settings.welcomesetting', compact('title', 'settings', 'sub_title', 'base', 'method'));
//     }

//     public function updatewelcome(Request $request)
//     {
//         $settings = Welcome::find($request->pk);

//         $data_name = $request->name;

//         $settings->$data_name = $request->value;

//         if ($settings->save()) {
//             return Response::json(array('status' => 1));
//         } else {
//             return Response::json(array('status' => 0));
//         }

//     }

//     // public function changelogo()
//     // {
//     //     // $settings=Ranksetting::all();
//     //     // //$title= trans('settings.rank_settings');
//     //     // $title= "Change Logo";
//     //     // $sub_title =  trans('settings.rank_settings_panel');
//     //     // $base = trans('settings.settings');
//     //     // $method =  trans('settings.rank_settings');
//     //     // //$unread_count  = Mail::unreadMailCount(Auth::id());
//     //     // //$unread_mail  = Mail::unreadMail(Auth::id());
//     //     // $userss = User::getUserDetails(Auth::id());
//     //     // $user = $userss[0];
//     //     // return view('app.admin.settings.changelogo',compact('title','settings','user','sub_title','base','method'));
//     //     Assets::addCSS(asset('assets/admin/css/profile.css'));
//     //     Assets::addCSS(asset('assets/user/css/bootstrap-fileupload/bootstrap-fileupload.min.css'));

//     //     Assets::addJS(asset('assets/user/js/bootstrap-fileupload/bootstrap-fileupload.min.js'));

//     //     // $app=AppSettings::all();
//     //        $app = AppSettings::find(1);
//     //        $logo=$app->logo;

//     //     $title= "Change logo";
//     //     $sub_title =trans('settings.app_settings_panel');
//     //     $base = trans('settings.settings');
//     //     $method =  trans('settings.app_settings');
//     //     $userss = User::getUserDetails(Auth::id());
//     //     $user = $userss[0];
//     //  return view('app/admin/logo',compact('title','settings','user','sub_title','base','method','logo'));

//     // }

//     public function getUploadLogo()
//     {

//         // $app=AppSettings::all();
//         $app  = AppSettings::find(1);
//         $logo = $app->logo;
//         $logo_ico = $app->logo_ico;

//         $settings  = AppSettings::all();
//         $title     = trans('ticket_config.change_logo');
//         $sub_title = trans('settings.app_settings_panel');
//         $base      = trans('settings.settings');
//         $method    = trans('settings.app_settings');
//         $userss    = User::getUserDetails(Auth::id());
//         $user      = $userss[0];
//         return view('app.admin.settings.logo', compact('title', 'settings', 'user', 'sub_title', 'base', 'method', 'logo','logo_ico'));
//     }
//     public function updateChangeLogo(Request $request)
//     {
//         $settings = AppSettings::find($request->pk);

//         $data_name = $request->name;

//         $settings->$data_name = $request->value;

//         if ($settings->save()) {
//             return Response::json(array('status' => 1));
//         } else {
//             return Response::json(array('status' => 0));
//         }

//     }
//     public function updateImage(Request $request)
//     {
//         if(Input::hasFile('file') && Input::hasFile('file2') ) {

//         // upload an image to the /img/tmp directory and return the filepath.
//         $file = Input::file('file');
//         $tmpFilePath = '/assets/images/';
//         $tmpFileName = time() . '-' . $file->getClientOriginalName();
//         $file = $file->move(ptmpFilePathublic_path() . $tmpFilePath, $tmpFileName);
//         $path = '/public'.$tmpFilePath . $tmpFileName;
//         $app = AppSettings::find(1);
//         $app->logo = $tmpFileName;

//         $app->save();

//         $file = Input::file('file2');
//         $tmpFilePath = '/assets/images/';
//         $tmpFileName = time() . '-' . $file->getClientOriginalName();
//         $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
//         $path = '/public'.$tmpFilePath . $tmpFileName;
//         $app = AppSettings::find(1);
//         $app->logo_ico = $tmpFileName;

//         $app->save();

//         // Session::flash('flash_notification', array('level' => 'danger', 'message' => 'You dont have the permission to change the logo'));
//         return Redirect::action('Admin\SettingsController@getUploadLogo');

//         }elseif(Input::hasFile('file')){
//            $file = Input::file('file');
//          $tmpFilePath = '/assets/images/';
//          $tmpFileName = time() . '-' . $file->getClientOriginalName();
//          $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
//          $path = '/public'.$tmpFilePath . $tmpFileName;
//          $app = AppSettings::find(1);
//          $app->logo = $tmpFileName;

//          $app->save();
//          return Redirect::action('Admin\SettingsController@getUploadLogo');

//         }
//         elseif(Input::hasFile('file2'))
//         {
//             $file = Input::file('file2');
//          $tmpFilePath = '/assets/images/';
//          $tmpFileName = time() . '-' . $file->getClientOriginalName();
//          $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
//          $path = '/public'.$tmpFilePath . $tmpFileName;
//          $app = AppSettings::find(1);
//          $app->logo_ico = $tmpFileName;

//          $app->save();
//          return Redirect::action('Admin\SettingsController@getUploadLogo');

//         }
//         else
//         {
//            return Redirect::action('Admin\SettingsController@getUploadLogo');
//         }
//     }

//     //  public function uploads() {

//     //        if(Input::hasFile('file')) {

//     //       //upload an image to the /img/tmp directory and return the filepath.
//     //       $file = Input::file('file');
//     //       $tmpFilePath = '/assets/images/';
//     //       $tmpFileName = time() . '-' . $file->getClientOriginalName();
//     //       $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
//     //       $path = '/public'.$tmpFilePath . $tmpFileName;
//     //       $app = AppSettings::find(1);
//     //       $app->logo = $tmpFileName;

//     //       $app->save();

//     //       Session::flash('flash_notification',array('level'=>'success','message'=>'Logo changed Successfully'));
//     //         return Redirect::action('Admin\SettingsController@getUploadLogo');
//     //         }
//     //         Session::flash('flash_notification',array('level'=>'danger','message'=>'No file selected'));
//     //         return Redirect::action('Admin\SettingsController@getUploadLogo');
//     //   }

//     // public function savelogo(){

//     //     if(Input::hasFile('file')) {

//     //       //upload an image to the /img/tmp directory and return the filepath.
//     //          $file = Input::file('file');
//     //       $tmpFilePath = '/assets/images/';
//     //       $tmpFileName = time() . '-' . $file->getClientOriginalName();
//     //       $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
//     //       $path = '/public'.$tmpFilePath . $tmpFileName;
//     //       $app = AppSettings::find(1);
//     //       $app->logo = $tmpFileName;
//     //       $app->save();
//     //     if($user->save()){
//     //              Session::flash('flash_notification',array('level'=>'success','message'=>'Logo changed Successfully'));
//     //              return Redirect::action('Admin\SettingsController@getUploadLogo');
//     //          }else{
//     //             Session::flash('flash_notification',array('level'=>'danger','message'=>'No file selected'));
//     //             return Redirect::action('Admin\SettingsController@getUploadLogo');
//     //   }
//     //  }

//     // }
//     public function autoresponder()
//     {

//         $title     = trans('menu.Auto_Responder');
//         $sub_title = "Text your message";
//         //$unread_count  = Mail::unreadMailCount(Auth::id());
//         //$unread_mail  = Mail::unreadMail(Auth::id());
//         $base = 'Email';

//         $method = 'Auto Responder';
//         $users  = User::getUserDetails(Auth::id());
//         $user   = $users[0];
//         $res    = AutoResponse::all();
//         // dd($res);die();
//         return view('app.admin.autoresponder.autoresponse', compact('title', 'user', 'sub_title', 'base', 'method', 'res'));
//     }
//     public function save(Request $request)
//     {
//         $response          = new AutoResponse();
//         $response->subject = $request->subject;
//         $response->content = $request->content;
//         $response->date    = $request->date;
//         $response->save();

//         Session::flash('flash_notification', array('level' => 'success', 'message' => trans('settings.response_created')));
//         return Redirect::action('Admin\SettingsController@autoresponder');

//     }
//     public function updateresponse(Request $request)
//     {
//         AutoResponse::where('id', $request->id)->update(array('subject' => $request->subject, 'content' => $request->content, 'date' => $request->date));
//         Session::flash('flash_notification', array('level' => 'success', 'message' => trans('settings.response_updated')));
//         return Redirect::action('Admin\SettingsController@autoresponder', array('id' => $request->id));

//     }
//     public function editresponse($id)
//     {
//         $response = AutoResponse::where('id', $id)->get();

//         $title     = 'Auto Responder';
//         $sub_title = "Text your message";
//         //$unread_count  = Mail::unreadMailCount(Auth::id());
//         //$unread_mail  = Mail::unreadMail(Auth::id());
//         $base = 'Email';

//         $method = 'Auto Responder';
//         $users  = User::getUserDetails(Auth::id());
//         $user   = $users[0];

//         return view('app.admin.autoresponder.aredit', compact('title', 'user', 'sub_title', 'base', 'method', 'response'));
//     }
//     public function deleteresponse($id)
//     {

//         $title     = 'Auto Responder';
//         $sub_title = "Text your message";
//         $base      = 'Email';
//         $method    = 'Auto Responder';
//         $users     = User::getUserDetails(Auth::id());
//         $user      = $users[0];
//         $response  = AutoResponse::where('id', $id)->get();

//         return view('app.admin.autoresponder.ardelete', compact('title', 'user', 'sub_title', 'base', 'method', 'response'));
//     }
//     public function deleteconfirms(Request $request)
//     {

//         $res = AutoResponse::where('id', $request->cid)->delete();
//         Session::flash('flash_notification', array('level' => 'success', 'message' => trans('settings.response_details')));
//         return Redirect::action('Admin\SettingsController@autoresponder');
//     }

//     //   public function voucherlist()
//     // {

//     //     $title = 'Voucher Create';
//     //     return view('app.admin.voucher.index',compact('title'));

//     // }

//     public function paymentgateway()
//     {

//         $title        = "Payment Gateway Settings";
//         $sub_title    = "Payment Gateway Settings";
//         $base         = "Payment Gateway Settings";
//         $method       = "Payment Gateway Settings";
//         $payment_type = PaymentType::all();
//         return view('app.admin.settings.payment', compact('title', 'payment_type', 'sub_title', 'base', 'method'));

//     }
//     public function paymentstatus(Request $request)
//     {

//         $title  = "Payment Gateway Settings";
//         $status = $request->decision;
//         $id     = $request->id;

//         PaymentType::where('id', $id)
//             ->update(['status' => $status]);

//         echo "ok";

//     }

//     public function payoutnotification()
//     {

//         $title     = trans("payout.notification.settings");
//         $sub_title = trans("payout.notification.settings");
//         $base      = trans("payout.notification.settings");
//         $method      = trans("payout.notification.settings");
//         $settings  = PaymentNotification::all();

//         return view('app.admin.settings.payoutnotification', compact('title','sub_title','base','method', 'settings', 'sub_title', 'base', 'method'));

//     }
//     public function payoutupdate(Request $request)
//     {

//         $package = PaymentNotification::find($request->pk);

//         $variable = $request->name;

//         $package->$variable = $request->value;

//         if ($package->save()) {
//             return Response::json(array('status' => 1));
//         } else {
//             return Response::json(array('status' => 0));
//         }

//     }

//     public function menusettings()
//     {

//         $title     = "Block Options";
//         $sub_title = "Block Options";
//         $base      = "Block Options";
//         $method    = "Block Options";
//         $menu_name = MenuSettings::all();
//         return view('app.admin.settings.menusettings', compact('title', 'menu_name', 'sub_title', 'base', 'method'));

//     }
//     public function menuupdate(Request $request)
//     {

//         $title  = "Block Options";
//         $status = $request->decision;
//         $id     = $request->id;
// //dd($status);
//         MenuSettings::where('id', $id)
//             ->update(['status' => $status]);

//         echo "ok";

//     }
}
