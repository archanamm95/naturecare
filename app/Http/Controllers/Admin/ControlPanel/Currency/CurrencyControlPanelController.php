<?php
namespace App\Http\Controllers\admin\ControlPanel\Currency;

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

class CurrencyControlPanelController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $title     = trans('controlpanel.currency');
        $sub_title = trans('controlpanel.currency');
        $base      = trans('controlpanel.currency');
        $method    = trans('controlpanel.currency');

        $settings = Currency::all();
        $userss = User::getUserDetails(Auth::id());
        $user   = $userss[0];
        

        return view('app.admin.control_panel.currency_manager.index', compact('title', 'sub_title', 'base', 'method', 'settings', 'user'));
    }


  /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'code'          => 'required',
            'symbol'        => 'required',
            'format'        => '',
            'exchange_rate' => '',
            'active'        => '',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            Currency::create([
                'name'          => $request->name,
                'code'          => $request->code,
                'symbol'        => $request->symbol,
                'format'        => $request->format,
                'exchange_rate' => $request->exchange_rate,
                'active'        => $request->active,
            ]);
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('controlpanel.currency_added_successfully')));
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        $package = Currency::find($request->pk);

        $variable = $request->name;

        $package->$variable = $request->value;

        if ($package->save()) {
            return Response::json(array('status' => 1));
        } else {
            return Response::json(array('status' => 0));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currency = Currency::find($id);
        $currency->active="0";
        $currency->save();

        $currency->delete();

        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('controlpanel.currency_deleted_successfully')));

        return redirect()->back();
    }
}
