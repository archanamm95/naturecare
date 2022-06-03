<?php
namespace App\Http\Controllers\Admin\ControlPanel\Languages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use App\Models\ControlPanel\Options;
use App\Product;
use App\Category;
use Validator;
use Session;
use App\Welcome;
use App\PaymentNotification;
use App\User;
use App\BlockIP;
use App\SystemLanguages;
use Redirect;
use Input;

class LanguageController extends AdminController
{

    public function getLanguages()
    {

        $title     = trans('controlpanel.language_manager');
        $sub_title = trans('controlpanel.language_manager');
        $base      = trans('controlpanel.language_manager');
        $method    = trans('controlpanel.language_manager');
        $languages=SystemLanguages::all();

        return view('app.admin.control_panel.languages.language_manager', compact('title', 'user', 'sub_title', 'base', 'method', 'languages'));
    }

    public function postLanguages(Request $request)
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
            (null !== $request->key ? SystemLanguages::updateLanguageOptionByKey($request->key, $request->value) :  abort(404) );
            $selected_active=SystemLanguages::where('status', 'yes')->pluck('locale')->toArray();
            $cur_def_locale=SystemLanguages::where('default', 'yes')->first();
        // dd($selected_active);
            if (!in_array($cur_def_locale->locale, $selected_active)) {
                SystemLanguages::where('id', $cur_def_locale->id)->update(['status' => 'yes']);
            }

            $active=SystemLanguages::where('status', 'yes')->value('id');
            if ($active == null) {
                SystemLanguages::where('locale', 'en')->update(['status'=>'yes']);
                $cur_def=SystemLanguages::where('default', 'yes')->value('id');
                if ($cur_def <> null) {
                    SystemLanguages::where('id', $cur_def)->update(['default' => 'no']);
                }
                SystemLanguages::where('locale', 'en')->update(['default'=>'yes']);
            }


            return response()->json([
            'state' => 'success',
            'code' => 200
            ]);
        }
    }

    public function changeDefaultLang(Request $request)
    {
        $old_language=SystemLanguages::where('default', 'yes')->first();
        $langauge= SystemLanguages::find($request->key);
        if ($langauge->status == 'yes') {
            SystemLanguages::where('id', $old_language->id)->update(['default'=>'no']);
            $langauge->default = 'yes';
            $langauge->save();
            return response()->json([
                'state' => trans('controlpanel.default_language_changed_successfully'),
                'code' => 200
            ]);
        } else {
            return response()->json([
              'state' => trans('controlpanel.sorry_you_cannot_change_the_default_language'),
              'code' => 200
            ]);
        }
    }
}
