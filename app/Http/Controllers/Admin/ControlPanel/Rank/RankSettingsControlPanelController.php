<?php
namespace App\Http\Controllers\admin\ControlPanel\Rank;

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

class RankSettingsControlPanelController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $title     = trans('controlpanel.rank_settings');
        $sub_title = trans('controlpanel.rank_settings');
        $base      = trans('controlpanel.rank_settings');
        $method    = trans('controlpanel.rank_settings');
        
        $settings  = Ranksetting::where('id','!=',1)->get();


        return view('app.admin.control_panel.rank.index', compact('title', 'sub_title', 'base', 'method', 'settings'));
    }


    public function update(Request $request)
    {

       
        foreach ($request->all() as $cloumn_name => $value_array) {
            if (is_array($value_array)) {
                foreach ($value_array as $key => $value) {
                    Ranksetting::updateRankSettings($cloumn_name, $key, $value);
                }
            }
        }

       

        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('all.successfully_updated_rank!')));
        return redirect()->back();
    }
}
