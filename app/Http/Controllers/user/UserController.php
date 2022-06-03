<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\ProfileInfo;
use App\Sponsortree;
use DB;
use Session;


use App\Http\Controllers\user\UserAdminController;

class UserController extends UserAdminController
{
    
    public function suggestlist(Request $request)
    {
        if ($request->input != '/'  &&  $request->input != '.') {
                  $users['results'] = User::join('sponsortree', 'sponsortree.user_id', '=', 'users.id')->where('sponsortree.sponsor', '=', Auth::user()->id)->where('username', 'like', "%".trim($request->input)."%")->select('users.id', 'username as value', 'email as info')->get();
        } else {
            $users['results'] = User::join('sponsortree', 'sponsortree.user_id', '=', 'users.id')->where('sponsortree.sponsor', '=', Auth::user()->id)->select('users.id', 'username as value', 'email as info')->get();
        }

         echo json_encode($users);
    }
    public function leads()
    {



        $title     = "Leads";
        $sub_title = "Leads";
        $base      = "Leads";
        $method    = "Leads";
        $top_recruiters = SponsorTree::where('sponsor', '=', Auth::user()->id)
        ->select(DB::raw('COUNT(sponsor) as count'))
        ->get();
        dd($top_recruiters);
        $top_recruiters = ProfileInfo::select(array('users.id', 'users.name', 'users.username', 'country','image','profile','cover', 'users.email', 'users.created_at',
                  DB::raw('COUNT(sponsortree.sponsor) as count')))
           ->join('users', 'users.id', '=', 'profile_infos.user_id')
           ->join('sponsortree', 'sponsortree.sponsor', '=', 'profile_infos.user_id')
           ->where('sponsortree.type', '<>', 'vaccant')
           ->where('sponsortree.sponsor', '<>', 0)
           ->where('sponsortree.sponsor', '=', Auth::user()->id)
           ->where('sponsortree.created_at', '>=', date('2018-12-01 00:00:00'))
           ->groupBy('sponsortree.sponsor')
           ->orderBy('count', 'desc')
           ->limit('10')
           ->get();

        // $top_recruiters =Sponsortree::where('sponsortree.sponsor','=',Auth::user()->id)->get();

           dd($top_recruiters);


           dd($top_recruiters);
         return view('app.user.users.leads', compact('title', 'sub_title', 'base', 'method', 'top_recruiters'));
    }
    public function impersonate()
    {
        
        Session::forget('impersonate');
        Auth::loginUsingId(1);
        return redirect('admin/users');
    }
}
