<?php
namespace App\Http\Controllers\admin\ControlPanel\Performance;

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
use Artisan;

class PerformanceControlPanelController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $title     = trans('controlpanel.performance');
        $sub_title = trans('controlpanel.performance');
        $base      = trans('controlpanel.performance');
        $method    = trans('controlpanel.performance');
        
        return view('app.admin.control_panel.performance.index', compact('title', 'user', 'sub_title', 'base', 'method', 'selected_skin'));
    }

    
    public function clearCacheAll(Request $request)
    {

            $exitCode = Artisan::call('cache:clear');
            $exitCode = Artisan::call('view:clear');
            $exitCode = Artisan::call('config:clear');
            $exitCode = Artisan::call('config:cache');

            sleep(10);
            
            // $exitCode = Artisan::call('route:clear');
            // $exitCode = Artisan::call('route:cache');
            // ISSUE SOLVED BY SETTING composer.json 750
            return Response::json([
                'code' => 200
            ], 200);
    }
    
    public function clearCacheApplication(Request $request)
    {
            $exitCode = Artisan::call('cache:clear');
            sleep(5);
            return Response::json([
                'code' => 200
            ], 200);
    }

    public function clearCacheConfig(Request $request)
    {
            $exitCode = Artisan::call('config:clear');
            sleep(5);
            return Response::json([
                'code' => 200
            ], 200);
    }

    public function clearCacheViews(Request $request)
    {
            $exitCode = Artisan::call('view:clear');
            sleep(5);
            return Response::json([
                'code' => 200
            ], 200);
    }

    public function clearCacheRoutes(Request $request)
    {
            $exitCode = Artisan::call('route:clear');
            sleep(5);
            return Response::json([
                'code' => 200
            ], 200);
    }

    public function cacheConfig(Request $request)
    {
            $exitCode = Artisan::call('config:cache');
            sleep(5);
            return Response::json([
                'code' => 200
            ], 200);
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


            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('all.successfully_updated_skin!')));
            return redirect()->back();
        }
    }
}
