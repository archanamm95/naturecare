<?php
namespace App\Http\Controllers\admin\ControlPanel\Voucher;

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
use App\Currency;

class VoucherControlPanelController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $title     = trans('controlpanel.voucher');
        $sub_title = trans('controlpanel.voucher');
        $base      = trans('controlpanel.voucher');
        $method    = trans('controlpanel.voucher');
        
        $limit     = Settings::where('id', 1)->value('voucher_daily_limit');
        $voucher_user_request = option('app.voucher_user_request');
         $voucher_admin_approval = option('app.voucher_admin_approval');

         // dd($voucher_admin_approval);
        return view('app.admin.control_panel.voucher_manager.index', compact('title', 'sub_title', 'base', 'method', 'limit', 'voucher_user_request', 'voucher_admin_approval'));
    }


  /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveDailyLimit(Request $request)
    {
      
        $input = $request->all();
        $rules = array(
            'voucher_daily_limit' => 'required',
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            Settings::where('id', 1)->update([
                'voucher_daily_limit' => $request->voucher_daily_limit
            ]);

            Options::updateOptionByKey('app.voucher_user_request', $request->voucher_user_request);
            Options::updateOptionByKey('app.voucher_admin_approval', $request->voucher_admin_approval);
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('all.successfully_updated!')));
            return redirect()->back();
        }
    }
}
