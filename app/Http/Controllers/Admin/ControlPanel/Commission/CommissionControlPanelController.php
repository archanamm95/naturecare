<?php
namespace App\Http\Controllers\admin\ControlPanel\Commission;

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
use App\Packages;
use App\BinaryCommissionSettings;
use App\LevelCommissionSettings;
use App\LevelSettingsTable;
use App\CashbackSettings;
use App\SponsorCommission;
use App\MatchingBonus;
use Auth;
use Illuminate\Http\Request;
use Input;
use Redirect;
use Response;
use Session;
use Larinfo;
use Validator;

class CommissionControlPanelController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
   

    public function index()
    {

        $title             = trans('controlpanel.commission_settings');
        $sub_title         = trans('controlpanel.commission_settings');
        $base              = trans('controlpanel.commission_settings');
        $method            = trans('controlpanel.commission_settings');
        $binary_commission = BinaryCommissionSettings::find(1);
        $leadershipbonus   = Settings::find(1);
        // dd($leadershipbonus);
        $sponsor_commission= SponsorCommission::find(1);

        $type=$binary_commission->type;
        $packages=Packages::all();
        $pack_det=json_decode($binary_commission->pair_commission);
        $percent_det=json_decode($binary_commission->pair_commission_percent);
        $binary_cap=$binary_commission->binary_cap;
      
        $cashback_bonus=CashbackSettings::orderBy('id','desc')->get();
        // dd($cashback_bonus);
        $level_commission=LevelCommissionSettings::find(1);
        $level_settings=LevelSettingsTable::join('packages', 'packages.id', '=', 'level_settings.package')->select('level_settings.*', 'packages.package')->get();
        $criteria=$level_commission->criteria;

        $spon_criteria=$sponsor_commission->criteria;

        $matching_bonus=MatchingBonus::find(1);
        $matching_criteria=$matching_bonus->criteria;

        return view('app.admin.control_panel.commission.index', compact('title', 'sub_title', 'base', 'method', 'packages', 'binary_commission', 'type', 'pack_det', 'percent_det', 'binary_cap', 'level_commission', 'level_settings', 'criteria', 'spon_criteria', 'sponsor_commission', 'matching_bonus', 'matching_criteria','leadershipbonus','cashback_bonus'));
    }




    public function binaryupdate(Request $request)
    {
   // dd($request->all());


        LevelCommissionSettings::where('id',1)->update(['level_1' =>$request->first_level,'level_2' =>$request->second_level,'level_3' =>$request->third_level,'criteria_l1' =>$request->first_level_criteria,'criteria_l2' =>$request->second_level_criteria,'criteria_l3' =>$request->third_level_criteria,'criteria2_l3' =>$request->third_level_criteria2]);

   // dd(1);
        // if ($request->type == 'fixed') {
        //     if ($request->pair_value == null || (in_array(null, $request->pair_commission))) {
        //          Session::flash('flash_notification', array('level' => 'error', 'message' => trans('all.please_enter_each_pair_commission!')));
        //          return redirect()->back();
        //     }
        // }

        // if (isset($request->check)) {
        //     if ($request->check == 'true') {
        //         if ($request->ceiling == null) {
        //             Session::flash('flash_notification', array('level' => 'error', 'message' => trans('all.please_enter_ceiling!')));
        //             return redirect()->back();
        //         }
        //     }
        // }

        // if ($request->type == 'percentage') {
        //     if ((in_array(null, $request->percent_commission))) {
        //         Session::flash('flash_notification', array('level' => 'error', 'message' => trans('all.please_enter_each_percent_commission')));
        //         return redirect()->back();
        //     }
        // }

        // $binary_commission=BinaryCommissionSettings::find(1);
        // $binary_commission->period=$request->period;
        // $binary_commission->type=$request->type;
        // $binary_commission->pair_value=$request->pair_value;
        // $binary_commission->pair_commission=json_encode($request->pair_commission);
        // $binary_commission->pair_commission_percent=json_encode($request->percent_commission);
        // if (isset($request->check)) {
        //     if ($request->check == 'true') {
        //          $binary_commission->binary_cap='yes';
        //     } else {
        //         $binary_commission->binary_cap='no';
        //     }
        // }

       
        // $binary_commission->pack_2=$request->pack_2;
        // $binary_commission->monthly_maintenance=$request->monthly_maintenance;
        // $binary_commission->pack_3=$request->pack_3;
        // $binary_commission->pack_4=$request->pack_4;
        // $binary_commission->save();
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('all.level_details_updated_successfully!')));
        // return redirect()->back();
         return redirect('admin/control-panel/commission-settings'.'#steps-commission-tab1');
    }
    //   public function level_criteria_update(Request $request)
    // {
   
    //     LevelCommissionSettings::where('id',1)->update(['criteria_l1' =>$request->first_level_criteria,'criteria_l2' =>$request->second_level_criteria,'criteria_l3' =>$request->third_level_criteria,'criteria2_l3' =>$request->third_level_criteria2]);

       
    //     Session::flash('flash_notification', array('level' => 'success', 'message' => trans('all.level_details_criteria_updated_successfully!')));
       
    //      return redirect('admin/control-panel/commission-settings'.'#steps-commission-tab1');
    // }
    public function levelcommissionupdate(Request $request)
    {
     

        // if ($request->criteria == "yes") {
        //     if ((in_array(null, $request->levelpack1)) || (in_array(null, $request->levelpack2)) || (in_array(null, $request->levelpack3))) {
        //         Session::flash('flash_notification', array('level' => 'error', 'message' => trans('all.please_enter_each_level_commission!')));
        //         return redirect()->back();
        //     }
        // }

        // if ($request->criteria == "no") {
        //     if ($request->levelno1 == null || $request->levelno2 == null || $request->levelno3 == null) {
        //         Session::flash('flash_notification', array('level' => 'error', 'message' => "Enter Bonus"));
        //         return redirect()->back();
        //     }
        // }

        // $packages=Packages::pluck('id');
        // foreach ($packages as $key => $package) {
        //     LevelSettingsTable::where('package', $package)->update(['commission_level1' =>$request->levelpack1[$key]]);
        //     LevelSettingsTable::where('package', $package)->update(['commission_level2' =>$request->levelpack2[$key]]);
        //     LevelSettingsTable::where('package', $package)->update(['commission_level3' =>$request->levelpack3[$key]]);
        // }

        $level_commission=Settings::find(1);
        // $level_commission->type=$request->type;
        // $level_commission->criteria=$request->criteria;
        $level_commission->service_charge=$request->levelno1;
        // $level_commission->nlevel_2=$request->levelno2;
        // $level_commission->nlevel_3=$request->levelno3;
        $level_commission->save();
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('Leadership bonus Updated successfully.')));
        // return redirect()->back()->withInput(['tab' => 'steps-commission-tab2']);
        return redirect('admin/control-panel/commission-settings'.'#steps-commission-tab2');
    }

    public function sponsorcommissionupdate(Request $request)
    {
       // dd($request->all());
        // if ($request->sponcriteria == "yes") {
        //     if ((in_array(null, $request->sponsor_comm))) {
        //         Session::flash('flash_notification', array('level' => 'error', 'message' => trans('all.please_enter_each_sponsor_commission!')));
        //         return redirect()->back();
        //     }
        // }

        // if ($request->sponcriteria == "no") {
        //     if ($request->sponsor_commission == null) {
        //         Session::flash('flash_notification', array('level' => 'error', 'message' => trans('all.please_enter_sponsor_commission!')));
        //         return redirect()->back();
        //     }
        // }

        // $spon_comm=SponsorCommission::find(1);
        // $spon_comm->type=$request->type;
        // $spon_comm->criteria=$request->sponcriteria;
        // $spon_comm->sponsor_commission=$request->sponsor_commission;
        // $spon_comm->save();
        // $packages=Packages::pluck('id');
        // foreach ($packages as $key => $package) {
        //     LevelSettingsTable::where('package', $package)->update(['sponsor_comm' =>$request->sponsor_comm[$key]]);
        // }
        $sponsor_commission=Settings::find(1);
        // $level_commission->type=$request->type;
        // $level_commission->criteria=$request->criteria;
        // dd($request->sponsor_commission);
        $sponsor_commission->sponsor_Commisions=$request->sponsor_commission;
        // $level_commission->nlevel_2=$request->levelno2;
        // $level_commission->nlevel_3=$request->levelno3;
        $sponsor_commission->save();
        Session::flash('flash_notification', array('level' => 'success', 'message' => "Referral Bonus Updated Successfully"));
        // return redirect()->back();
        return redirect('admin/control-panel/commission-settings'.'#steps-commission-tab3');
    }
    public function salescommissionupdate(Request $request)
    {
       // dd($request->all());
        
        $sales_commission=Settings::find(1);
        
        // $sales_commission->bonus_1=$request->bonus_1; //commented by archana
        // $sales_commission->bonus_2=$request->bonus_2; //commented by archana
        $sales_commission->min_p_sales=$request->personal_sale_amount; //added by archana
        $sales_commission->p_sales_per=$request->sale_percentage; //added by archana


       
        $sales_commission->save();
        Session::flash('flash_notification', array('level' => 'success', 'message' => "Sales Bonus Updated Successfully"));
        // return redirect()->back();
        return redirect('admin/control-panel/commission-settings'.'#steps-commission-tab5');
    }
    
    public function ifluencercommissionupdate(Request $request)
    {
       // dd($request->all());
        
        $influencer_commission=Settings::find(1);
        
        $influencer_commission->influencer_level=$request->ifluencer_level1;
        $influencer_commission->influencer_manager=$request->influencermanager_bonus;
       
        $influencer_commission->save();
        Session::flash('flash_notification', array('level' => 'success', 'message' => "Influencer Bonus Updated Successfully"));
        return redirect('admin/control-panel/commission-settings'.'#steps-commission-tab10');
        // return redirect()->back();
    }
      public function cashbackcommissionupdate(Request $request)
    {
       // dd($request->all());
         $cashback_count=CashbackSettings::count('id');
         // dd($cashback_count);
         for ($i=1; $i <= $cashback_count; $i++) { 
             $sale='sale_count'.$i;
             $cash='cash_back'.$i;
             CashbackSettings::where('id',$i)->update(['sale_count' =>$request->$sale,'cash_back' =>$request->$cash]);
         }
        
        Session::flash('flash_notification', array('level' => 'success', 'message' => "CashBack Bonus Updated Successfully"));
        // return redirect()->back();
        return redirect('admin/control-panel/commission-settings'.'#steps-commission-tab6');
    }
    public function matchingbonusupdate(Request $request)
    {
      
        // if ($request->matchcriteria == "yes") {
        //     if ((in_array(null, $request->matchpack1)) || (in_array(null, $request->matchpack2)) || (in_array(null, $request->matchpack3))) {
        //         Session::flash('flash_notification', array('level' => 'error', 'message' => trans('all.please_enter_each_level_package_matching_bonus!')));
        //         return redirect()->back();
        //     }
        // }

        if ($request->matchcriteria == "no") {
            if ($request->matchno1 == null || $request->matchno1 == null || $request->matchno1 == null) {
                Session::flash('flash_notification', array('level' => 'error', 'message' => "Enter Bonus"));
                return redirect()->back();
            }
        }

        // $packages=Packages::pluck('id');
        // foreach ($packages as $key => $package) {
        //     LevelSettingsTable::where('package', $package)->update(['matching_level1' =>$request->matchpack1[$key]]);
        //     LevelSettingsTable::where('package', $package)->update(['matching_level2' =>$request->matchpack2[$key]]);
        //     LevelSettingsTable::where('package', $package)->update(['matching_level3' =>$request->matchpack3[$key]]);
        // }

        $matching_bonus=MatchingBonus::find(1);
        // $matching_bonus->type=$request->type;
        // $matching_bonus->criteria=$request->matchcriteria;
        $matching_bonus->matching_level1=$request->matchno1;
        // $matching_bonus->matching_level2=$request->matchno2;
        // $matching_bonus->matching_level3=$request->matchno3;
        $matching_bonus->save();
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('all.details_saved_successfully!')));
        return redirect()->back();
    }
}
