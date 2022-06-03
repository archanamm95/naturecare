<?php
namespace App\Http\Controllers\admin\ControlPanel\Design;

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

class DesignControlPanelController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $title     = trans('controlpanel.design');
        $sub_title = trans('controlpanel.design');
        $base      = trans('controlpanel.design');
        $method    = trans('controlpanel.design');
        

        $selected_skin = option('app.theme_skin');

        return view('app.admin.control_panel.design.index', compact('title',  'sub_title', 'base', 'method', 'selected_skin'));
    }


    public function UpdateDesign(Request $request)
    {

        $input = $request->all();
        $rules = array(
            'theme_skin' => 'required',
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            (null !== $request->theme_skin ? Options::updateOptionByKey('app.theme_skin', $request->theme_skin) :  '' );


            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('all.successfully_updated_skin')));
            return redirect()->back();
        }
    }


    public function UpdateThemeFontSize(Request $request)
    {
        

        $input = $request->all();
        $rules = array(
            'theme_font_size' => 'required',
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            (null !== $request->theme_font_size ? Options::updateOptionByKey('app.theme_font_size', $request->theme_font_size) :  '' );


            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('all.successfully_updated_font_size')));
            return redirect()->back();
        }
    }
}
