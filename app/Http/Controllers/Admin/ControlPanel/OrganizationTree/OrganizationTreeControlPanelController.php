<?php
namespace App\Http\Controllers\admin\ControlPanel\OrganizationTree;

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

class OrganizationTreeControlPanelController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $title     = trans('controlpanel.organization_tree_options');
        $sub_title = trans('controlpanel.organization_tree_options');
        $base      = trans('controlpanel.organization_tree_options');
        $method    = trans('controlpanel.organization_tree_options');
        
        $tree_images_option = option('app.tree_images_option');
        // dd($tree_images_option);
        $tree_grid_option = option('app.tree_grid_option');
        $tree_map_option = option('app.tree_map_option');
        $tree_zooming_option = option('app.tree_zooming_option');
        $tree_pan_option = option('app.tree_pan_option');
        $tree_more_details_option = option('app.tree_more_details_option');
       
        $tree_images_show_option = option('app.tree_images_show_option');
        $tree_grid_show_option = option('app.tree_grid_show_option');
        $tree_map_show_option = option('app.tree_map_show_option');
        $tree_zooming_show_option = option('app.tree_zooming_show_option');
        $tree_pan_show_option = option('app.tree_pan_show_option');
        $tree_more_details_show_option = option('app.tree_more_details_show_option');

       



        return view('app.admin.control_panel.organization_tree.index', compact('title', 'sub_title', 'base', 'method', 'tree_images_option', 'tree_grid_option', 'tree_map_option', 'tree_zooming_option', 'tree_pan_option', 'tree_more_details_option', 'tree_images_show_option', 'tree_images_show_option', 'tree_grid_show_option', 'tree_map_show_option', 'tree_zooming_show_option', 'tree_pan_show_option', 'tree_more_details_show_option'));
    }


    public function update(Request $request)
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
            (null !== $request->key ? Options::updateOptionByKey('app.'.$request->key, $request->value) :  abort(404) );

            return response()->json([
            'state' => 'success',
            'code' => 200
            ]);
        }
    }
}
