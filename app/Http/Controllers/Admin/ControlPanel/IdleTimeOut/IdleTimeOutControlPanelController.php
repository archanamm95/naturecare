<?php
namespace App\Http\Controllers\admin\ControlPanel\IdleTimeOut;

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

class IdleTimeOutControlPanelController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $title     = trans('controlpanel.idle_timeout');
        $sub_title = trans('controlpanel.idle_timeout');
        $base      = trans('controlpanel.idle_timeout');
        $method    = trans('controlpanel.idle_timeout');
        

        $idle_timeout_delay = option('app.idle_timeout_delay');
        $idle_timeout = option('app.idle_timeout');
        
       

        return view('app.admin.control_panel.idle_timeout.index', compact('title', 'user', 'sub_title', 'base', 'method', 'idle_timeout_delay', 'idle_timeout'));
    }


    public function UpdateIdleTimeOut(Request $request)
    {

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
            if ($request->key == 'idle_timeout') {
                (null !== $request->key ? Options::updateOptionByKey('app.idle_timeout', $request->value) :  '' );
            } else {
                (null !== $request->key ? Options::updateOptionByKey('app.idle_timeout_delay', $request->value) :  '' );
            }
                
            return response()->json([
            'state' => 'success',
            'code' => 200
            ]);
        }
    }
}
