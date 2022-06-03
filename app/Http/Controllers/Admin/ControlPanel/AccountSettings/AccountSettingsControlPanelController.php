<?php
namespace App\Http\Controllers\Admin\ControlPanel\AccountSettings;

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
use App\EmailTemplates;
use Auth;
use Illuminate\Http\Request;
use Input;
use Redirect;
use Response;
use Session;
use Larinfo;
use Validator;

class AccountSettingsControlPanelController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $title     = trans('controlpanel.account_settings');
        $sub_title = trans('controlpanel.account_settings');
        $base      = trans('controlpanel.account_settings');
        $method    = trans('controlpanel.account_settings');
        
        $user_registration = option('app.user_registration');
        $email_verification = option('app.email_verification');
        $email = EmailTemplates::all();
        

        return view('app.admin.control_panel.account_settings.index', compact('title', 'sub_title', 'base', 'method', 'user_registration', 'email_verification', 'email'));
    }


    public function update(Request $request)
    {

// dd($request->all());
        // print_r($request->all());
        // die();
        $input = $request->all();
        $rules = array(
            'key' => 'required',
            'value' => 'required',
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json([
                'state' => 'error',
                'code' => 200
            ]);
        } else {
            if ($request->key == 'user_registration') {
                    (null !== $request->key ? Options::updateOptionByKey('app.user_registration', $request->value) :  '' );
            } else {
                (null !== $request->key ? Options::updateOptionByKey('app.email_verification', $request->value) :  '' );
            }
                
            return response()->json([
            'state' => 'success',
            'code' => 200
            ]);
        }
    }
    public function store(Request $request)
    {

        $update= EmailTemplates::where('type', $request->type)->update([
        'subject' => $request->subject,
        'body'    => $request->body,
        'notify'  =>$request->notify,
        'status' =>$request->mailstatus,
        ]);
         
        Session::flash('flash_notification', array('level'=>'success','message'=>trans('controlpanel.email_updated_successfully')));
 

        return redirect()->back();
    }

    public function changeMailStatus(Request $request)
    {
 
        $mail=EmailTemplates::find($request->key);
        $mail->status = $request->value;
        $mail->save();
        return response()->json([
            'state' => 'success',
            'code' => 200
        ]);
    }
}
