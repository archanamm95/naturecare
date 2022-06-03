<?php
namespace App\Http\Controllers\admin\ControlPanel\Bonus;

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
use App\LeadershipBonus;
use App\MatchingBonus;
use App\User;
use App\Welcome;
use Auth;
use Illuminate\Http\Request;
use Input;
use Redirect;
use Response;
use Session;
use Validator;

class BonusControlPanelController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $title     = trans('controlpanel.bonus_manager');
        $sub_title = trans('controlpanel.bonus_manager');
        $base      = trans('controlpanel.bonus_manager');
        $method    = trans('controlpanel.bonus_manager');
        
        $settings  = LeadershipBonus::join('packages', 'packages.id', '=', 'leader_ship.package_id')
            ->select('leader_ship.*', 'packages.package')
            ->get();

        $matching_bonus = MatchingBonus::join('packages', 'packages.id', '=', 'matching_bonus.package_id')->select('matching_bonus.*', 'packages.package')->get();
     
        return view('app.admin.control_panel.bonus.index', compact('title', 'user', 'sub_title', 'base', 'method', 'settings', 'matching_bonus'));
    }


    public function view_edit($id)
    {

        $title     = trans('controlpanel.leadership_edit');
        $sub_title = trans('controlpanel.leadership_edit');
        $base      = trans('controlpanel.leadership_edit');
        $method    = trans('controlpanel.leadership_edit');
        
        $leadership  = LeadershipBonus::join('packages', 'packages.id', '=', 'leader_ship.package_id')
            ->select('leader_ship.*', 'packages.package')->find($id);
            // dd($package);
        return view('app.admin.control_panel.bonus.view_edit', compact('title', 'user', 'sub_title', 'base', 'method', 'leadership'));


        $input = $request->all();
        $rules = array(
            'theme_skin' => 'required',
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            (null !== $request->theme_skin ? Options::updateOptionByKey('app.theme_skin', $request->theme_skin) :  '' );


            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('all.successfully updated skin!')));
            return redirect()->back();
        }
    }


    public function update(Request $request, $id)
    {


        $input = $request->all();
        $rules = array(
            'level_1' => 'required',
            'level_2' => 'required',
            'level_3' => 'required',
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            // (null !== $request->package ? Packages::where('app.theme_font_size',$request->theme_font_size) :  '' );
            $leadership = LeadershipBonus::find($id);


            $leadership->level_1 = $request->level_1;
            $leadership->level_2 = $request->level_2;
            $leadership->level_3 = $request->level_3;
           

            if ($leadership->save()) {
                Session::flash('flash_notification', array('level' => 'success', 'message' => trans('all.successfully_updated_leadership_bonus!')));
                    return redirect('admin/control-panel/bonus-settings');
            } else {
                Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('all.could_not_update_leadership_bonus!')));
                    return redirect('admin/control-panel/bonus-settings');
            }
        }
    }

    public function matchingbonus_view_edit($id)
    {

        $title     = trans('controlpanel.matching_bonus_edit');
        $sub_title = trans('controlpanel.matching_bonus_edit');
        $base      = trans('controlpanel.matching_bonus_edit');
        $method    = trans('controlpanel.matching_bonus_edit');
        
        $matching  = MatchingBonus::join('packages', 'packages.id', '=', 'matching_bonus.package_id')->select('matching_bonus.*', 'packages.package')->find($id);
            // dd($package);
        return view('app.admin.control_panel.bonus.matchingbonus_view_edit', compact('title', 'user', 'sub_title', 'base', 'method', 'matching'));


        $input = $request->all();
        $rules = array(
            'theme_skin' => 'required',
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            (null !== $request->theme_skin ? Options::updateOptionByKey('app.theme_skin', $request->theme_skin) :  '' );


            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('all.successfully updated skin!')));
            return redirect()->back();
        }
    }

    public function matchingbonus_update(Request $request, $id)
    {

        $input = $request->all();
        $rules = array(
         'pv' => 'required',
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            // (null !== $request->package ? Packages::where('app.theme_font_size',$request->theme_font_size) :  '' );
            $matching = MatchingBonus::find($id);
            $matching->pv = $request->pv;
           

            if ($matching->save()) {
                Session::flash('flash_notification', array('level' => 'success', 'message' => trans('all.successfully_updated_matching_bonus!')));
                    return redirect('admin/control-panel/bonus-settings');
            } else {
                Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('all.could_not_update_matching_bonus!')));
                    return redirect('admin/control-panel/bonus-settings');
            }
        }
    }
}
