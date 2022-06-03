<?php
namespace App\Http\Controllers\admin\ControlPanel\Menu;

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
use Route;

class MenuControlPanelController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $title     = trans('controlpanel.menu_manager');
        $sub_title = trans('controlpanel.menu_manager');
        $base      = trans('controlpanel.menu_manager');
        $method    = trans('controlpanel.menu_manager');
        
        $routes = Route::getRoutes();
        // foreach ($routes as $route) {
        //     * @var \Illuminate\Routing\Route $route
        //     echo $route->uri. PHP_EOL;
        // }
        $primary_menu_items_json = option('app.primary_menu_items');
        // dd($selected_skin);

        return view('app.admin.control_panel.menu_manager.index', compact('title', 'user', 'sub_title', 'base', 'method', 'primary_menu_items_json', 'routes'));
    }


    public function UpdateMenu(Request $request)
    {


        


        $input = $request->all();
        $rules = array(
            'primary_menu_items' => 'required',
        );
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            (null !== $request->primary_menu_items ? Options::updateOptionByKey('app.primary_menu_items', $request->primary_menu_items) :  '' );


            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('all.successfully_updated_menu!')));
            return redirect()->back();
        }
    }
}
