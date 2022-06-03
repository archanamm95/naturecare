<?php
namespace App\Http\Controllers\admin\ControlPanel\cms_manager;

use App\Http\Controllers\Admin\AdminController;

use App\Settings;

use Illuminate\Http\Request;
use Input;
use Redirect;
use Response;
use Session;

use Validator;

class cmsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $title     = trans('controlpanel.cms_manager');
        $sub_title = trans('controlpanel.cms_manager');
        $base      = trans('controlpanel.cms_manager');
        $method    = trans('controlpanel.cms_manager');
        $terms=Settings::find(1);


        return view('app.admin.control_panel.cms_manager.index', compact('title', 'terms', 'sub_title', 'base', 'method'));
    }
    public function store(Request $request)
    {
          // dd($request->all());

          $update = Settings::find(1);

        if ($request->id == 1) {
            $update->content=$request->terms_and_conditions;
            $update->save();
            
            Session::flash('flash_notification', array('level'=>'success','message'=>trans('controlpanel.terms_and_conditions_updated_successfully')));
        } else {
            $update->cookie=$request->cookie_policy;
            $update->save();
            Session::flash('flash_notification', array('level'=>'success','message'=>trans('controlpanel.cookie_policy_updated_successfully')));
        }

        // return redirect()->back();
        
        return redirect('admin/control-panel/cms_manager'.'#cookie_policy');

    }
}
