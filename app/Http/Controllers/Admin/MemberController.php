<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\User;
use Auth;
use Input;
use Illuminate\Http\Request;
use Response;
use Session;
use App\ProfileInfo;
use App\PendingTransactions;
use Validator;

class MemberController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title     = 'Member Management';
        $sub_title = 'Member Management';
        $base      = 'Settings';
        $method    = 'Member Management';
        $settings  = User::all();
        $userss    = User::getUserDetails(Auth::id());
        $user      = $userss[0];
        return view('app.admin.members.index', compact('title', 'settings', 'user', 'sub_title', 'base', 'method'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {

        $members = User::where('username', 'like', "%{$request->user_name}%")
            ->orWhere('name', 'like', "%{$request->name}%")
            ->orWhere('email', 'like', "%{$request->email}%")
            ->get();

        print_r($members);
        die();
    }
    public function saveprofile(Request $request)
    {
        
        // die(Session::get('prof_username'));

        if (!Session::has('prof_username')) {
            return redirect()->back();
        }
        $email=User::where('email', $request->email)->value('id');
        
        $id = User::where('username', Session::get('prof_username'))->value('id');

        $user = User::find($id);

        if ($email <> null && $request->email <> $user->email) {
            return redirect('admin/userprofiles/'.$user->username.'#update')->withErrors([trans('register.email_already_taken')]);
        }


        if (Input::hasFile('id_file')) {
            $destinationPath = public_path() . '/uploads/documents';
            $extension       = Input::file('id_file')->getClientOriginalExtension();
            $fileName        = rand(000011111, 99999999999) . '.' . $extension;
            Input::file('id_file')->move($destinationPath, $fileName);
            $file_name       = $fileName;
        }
        if (Input::hasFile('id_file_back')) {
            $destinationPath = public_path() . '/uploads/documents';
            $extension       = Input::file('id_file_back')->getClientOriginalExtension();
            $fileName        = rand(000011111, 99999999999) . '.' . $extension;
            Input::file('id_file_back')->move($destinationPath, $fileName);
            $file_back       = $fileName;
        }

        $id = User::where('username', Session::get('prof_username'))->value('id');

        $user = User::find($id);

        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;




        $user->save();
        // dd($user);
// Role::with('users')->whereName($name)->first();
        $related_profile_info = ProfileInfo::where('user_id', $id)->first();
// dd($related_profile_info);
        $related_profile_info->location    = $request->location;
        $related_profile_info->occuption   = $request->occuption;
        $related_profile_info->gender      = $request->gender;
        $related_profile_info->dateofbirth = date('d/m/Y', strtotime($request->day . "-" . $request->month . "-" . $request->year));
        $related_profile_info->address1    = $request->address1;
        $related_profile_info->address2    = $request->address2;
        $related_profile_info->gender      = $request->gender;
        $related_profile_info->city        = $request->city;
        $related_profile_info->country     = $request->country;
        $related_profile_info->state       = $request->state;
        $related_profile_info->zip         = $request->zip;
        $related_profile_info->mobile      = '+'.$request->phone_code.$request->phone;

        $related_profile_info->skype       = $request->skype;
        $related_profile_info->facebook    = $request->fb;
        $related_profile_info->twitter     = $request->twitter;

        $related_profile_info->account_number      = $request->account_number;
        $related_profile_info->account_holder_name = $request->account_holder_name;
        $related_profile_info->swift               = $request->swift;
        $related_profile_info->sort_code           = $request->sort_code;
        $related_profile_info->bank_code           = $request->bank_code;
        $related_profile_info->paypal              = $request->paypal;
        $related_profile_info->about               = $request->about_me;
        $related_profile_info->wechat              = $request->wechat;
        $related_profile_info->passport            = $request->passport;
        $related_profile_info->btc_wallet          = $request->btc_wallet;
        if(isset($file_name))
            $related_profile_info->id_file         = $file_name;
        if(isset($file_back))
        $related_profile_info->id_file_back        = $file_back;

        // if ($request->hasFile('profile_pic')) {
        //     $destinationPath = base_path() . "\public\appfiles\images\profileimages";
        //     $extension       = Input::file('profile_pic')->getClientOriginalExtension();
        //     $fileName        = rand(11111, 99999) . '.' . $extension;
        //     Input::file('profile_pic')->move($destinationPath, $fileName);
        //     $new_user->image = $fileName;

        //     $path2 = public_path() . '/appfiles/images/profileimages/thumbs/';
        //     Thumbnail::generate_profile_thumbnail($destinationPath . '/' . $fileName, $path2 . $fileName);
        //     $path3 = public_path() . '/appfiles/images/profileimages/small_thumbs/';
        //     Thumbnail::generate_profile_small_thumbnail($destinationPath . '/' . $fileName, $path3 . $fileName);

        // }

        if ($related_profile_info->save()) {
            Session::flash('flash_notification', array('message' => trans('register.profile_updated_successfully'), 'level' => 'success'));
            return redirect('admin/userprofiles/'.$user->username.'#update');
        } else {
            return redirect('admin/userprofiles/'.$user->username.'#update')->withErrors([trans('register.something_went_wrong')]);
        }
    }
}
