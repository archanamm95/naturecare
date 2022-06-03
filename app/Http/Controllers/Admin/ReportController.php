<?php

namespace App\Http\Controllers\admin;

use App\CarryForwardHistory;
use App\Commission;
use App\Country;
use App\Http\Controllers\Admin\AdminController;
use App\Mail;
use App\Packages;
use App\Sponsortree;
use App\PairingHistory;
use App\Balance;
use App\Payout;
use App\PurchaseHistory;
use App\UserInactiveHistory;
use App\PendingCommission;
use App\AppSettings;
use App\StockManagement;
use App\RegisterPoint;
use App\User;
use App\Product;
use Session;
use Assets;
use Auth;
use DB;
use Illuminate\Http\Request;
use Validator;
use CountryState;

class ReportController extends AdminController
{
    
    public function addTrackId($id,$trackId){

        $pur_data = PurchaseHistory::find($id);

        if(isset($pur_data)){
            $pur_data->order_status = $trackId;
            $pur_data->save();
            return response()->json(['valid' => true,'status'=>'success']);
        }
             return response()->json(['valid' => false]);
    }

    public function joiningreport()
    {
        $title     = trans('report.joining_report');
        $sub_title = trans('report.joining_report');
        $countries = CountryState::getCountries();
        $base      = trans('report.report');
        $method    = trans('report.joining_report');
        $userss    = User::getUserDetails(Auth::id());
        $user      = $userss[0];
        return view('app.admin.report.joiningreport', compact('title', 'countries', 'user', 'sub_title', 'base', 'method'));
    }

    public function joiningreportview(Request $request)
    {
        // dd($request->all());
          $company=AppSettings::find(1);

        if ($request->type == 'normal') {
            $validator = Validator::make($request->all(), [
            'start'   => 'required|date',
            'end'     => 'required|date',
            'country' => '',
            'sponsor' => 'exists:users,username',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            $title      = trans('report.joining_report');
            $sub_title  = trans('report.joining_report_view');
            $base       = trans('report.report');
            $method     = trans('report.joining_report_view');
            $reportdata = User::join('profile_infos', 'profile_infos.user_id', '=', 'users.id')
                ->select('users.username', 'users.name', 'users.keyid', 'users.lastname', 'users.email', 'profile_infos.mobile', 'profile_infos.passport', 'users.created_at')
                ->where('users.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
                ->where('users.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
                ->where('users.user_type','!=','Customer')
                ->orderBy('users.created_at','ASC')->get();
      
            $start_date=$request->start;
            $end_date=$request->end;
        }
        if ($request->type == 'sponsor') {
             $validator = Validator::make($request->all(), [
            'key_user_hidden' => 'exists:users,username',
             ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors("No such sponsor");
            }

            $sponsor_id = User::userNameToId($request->key_user_hidden);

            $title     = trans('report.joining_report');
            $base      = trans('report.report');
            $method    = trans('report.joining_report_by_sponsor');
            $sub_title = trans('report.joining_report_by_sponsor');
            //$reportdata=User::select('username','name','lastname','email','mobile','created_at')->where(t->end)))->get();
            $reportdata  = DB::table('users')->join('sponsortree', 'sponsortree.user_id', '=', 'users.id')->join('profile_infos', 'sponsortree.user_id', '=', 'profile_infos.user_id')->where('sponsortree.sponsor', '=', $sponsor_id)->where('users.user_type','!=','Customer')->orderBy('users.created_at','ASC')->get();
      // dd($reportdata);
            // for ($i = 0; $i < $count_users; $i++) {
            //     $reportdata[$i]->country = User::countryIdToName($reportdata[$i]->country);
            // }
      
            $start_date='na';
            $end_date='na';
        }

        if ($request->type == 'country') {
             $validator = Validator::make($request->all(), [
            'country' => 'required',
             ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

           //echo   $request->country;die();
            $title       = trans('report.joining_report');
            $base        = trans('report.report');
            $method      = trans('report.joining_report_by_country');
            $sub_title   = trans('report.joining_report_by_country');
            $reportdata  = User::join('profile_infos', 'profile_infos.user_id', '=', 'users.id')->select('users.username', 'users.name', 'users.keyid', 'users.lastname', 'users.email', 'profile_infos.mobile', 'profile_infos.passport', 'users.created_at', 'profile_infos.country')->where('profile_infos.country', '=', $request->country)->where('users.user_type','!=','Customer')->orderBy('users.created_at','ASC')->get();
           // for ($i = 0; $i < $count_users; $i++) {
           //     $reportdata[$i]->country = User::countryIdToName($reportdata[$i]->country);
           // }

         
            $start_date='na';
            $end_date='na';
        }

        $count_users = count($reportdata);


        return view('app.admin.report.joiningreportview', compact('title', 'reportdata', 'sub_title', 'base', 'method', 'company', 'start_date', 'end_date'));
    }

    public function joiningreportbysponsorview(Request $request)
    {

        // $validator = Validator::make($request->all(), [
        //     'key_user_hidden' => 'exists:users,username',
        // ]);
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors("No such sponsor");
        // }

        $sponsor_id = User::userNameToId($request->key_user_hidden);

        $title     = trans('report.joining_report');
        $base      = trans('report.report');
        $method    = trans('report.joining_report_by_sponsor');
        $sub_title = trans('report.joining_report_by_sponsor');
        //$reportdata=User::select('username','name','lastname','email','mobile','created_at')->where(t->end)))->get();
        $reportdata  = DB::table('users')->join('sponsortree', 'sponsortree.user_id', '=', 'users.id')->where('sponsortree.sponsor', '=', $sponsor_id)->where('users.user_type','!=','Customer')->get();
        $count_users = count($reportdata);
        // for ($i = 0; $i < $count_users; $i++) {
        //     $reportdata[$i]->country = User::countryIdToName($reportdata[$i]->country);
        // }
        $company=AppSettings::find(1);
        $start_date='na';
        $end_date='na';
        return view('app.admin.report.joiningreportview', compact('title', 'countries', 'reportdata', 'base', 'method', 'sub_title', 'company', 'start_date', 'end_date'));
    }

    public function joiningreportbycountryview(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'country' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator);
        // }

        //echo   $request->country;die();
        $title       = trans('report.joining_report');
        $base        = trans('report.report');
        $method      = trans('report.joining_report_by_country');
        $sub_title   = trans('report.joining_report_by_country');
        $reportdata  = User::join('profile_infos', 'profile_infos.user_id', '=', 'users.id')->select('users.username', 'users.name', 'users.lastname', 'users.email', 'profile_infos.mobile', 'users.created_at', 'profile_infos.country')->where('profile_infos.country', '=', $request->country)->where('users.user_type','!=','Customer')->get();
        $count_users = count($reportdata);
        // for ($i = 0; $i < $count_users; $i++) {
        //     $reportdata[$i]->country = User::countryIdToName($reportdata[$i]->country);
        // }

          $company=AppSettings::find(1);
        $start_date='na';
        $end_date='na';
        return view('app.admin.report.joiningreportview', compact('title', 'countries', 'reportdata', 'base', 'method', 'sub_title', 'company', 'start_date', 'end_date'));
    }

    public function fundcredit()
    {
        $title        = trans('report.fund_credit');
        $sub_title    = trans('report.fund_credit');
        $unread_count = Mail::unreadMailCount(Auth::id());
        $unread_mail  = Mail::unreadMail(Auth::id());
        $base         = trans('report.fund_credit');
        $method       = trans('report.fund_credit');
        $userss       = User::getUserDetails(Auth::id());
        $user         = $userss[0];
        return view('app.admin.report.fundcredit', compact('title', 'unread_count', 'unread_mail', 'user', 'sub_title', 'base', 'method'));
    }

    public function fundcreditview(Request $request)
    {

        // Assets::AddCSS(asset('assets/globals/css/print.css'));
        
         // dd($request->all());

         if ($request->username != null || $request->autocompleteusers != null) {
                 $validator = Validator::make($request->all(), [
            'start'    => 'required|date',
            'end'      => 'required|date|',
            'username' => 'exists:users',
                 ]);
        } else {
            $validator = Validator::make($request->all(), [
            'start'    => 'required|date',
            'end'      => 'required|date|',
          
         ]);
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $title      = trans('report.fund_credit');
        $sub_title  = trans('report.fund_credit');
        $base       = trans('report.fund_credit');
        $method     = trans('report.fund_credit');

        $user_id = User::where('username', $request->username)->pluck('id');

        $reportdata = Commission::where('commission.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))->where('commission.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->join('users', 'users.id', '=', 'commission.user_id')
            ->join('users as fromuser','fromuser.id','=','commission.from_id')
            ->select('commission.created_at', 'users.username', 'users.name', 'users.lastname', 'users.email', 'commission.payable_amount as amount', 'commission.payment_type','fromuser.username as fromuser')
            ->where('commission.payment_type', '=', 'fund_credit')
             ->where(function ($query) use ($request, $user_id) {
                if (count($user_id) != 0) {
                    $query->where('commission.user_id', '=', $user_id);
                }
            })

            ->get();
        
        $payable_amount = Commission::where('commission.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))->where('commission.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->join('users', 'users.id', '=', 'commission.user_id')
            ->where('commission.payment_type', '=', 'fund_credit')
            ->where(function ($query) use ($request, $user_id) {
               
                if (count($user_id) != 0) {
                    $query->where('commission.user_id', '=', $user_id);
                }
            })
           
            ->sum('payable_amount');
        $company=AppSettings::find(1);
        $start_date=$request->start;
        $end_date=$request->end;

        return view('app.admin.report.fundcreditview', compact('title', 'reportdata', 'sub_title', 'payable_amount', 'base', 'method', 'company', 'start_date', 'end_date'));
    }

    public function ewalletreport()
    {
        $title     = trans('report.members_income_report');
        $sub_title = trans('report.income_report');
        $base      = trans('report.report');
        $method    = trans('report.income_report');

        $userss   = User::getUserDetails(Auth::id());
        $user     = $userss[0];
        $users    = User::where('id', '>', 1)->get();
        $packages = Packages::all();
        $bonus_type = Commission::select('payment_type')->where('payment_type', 'NOT LIKE', '%credited%')->groupBY('payment_type')->get();
        return view('app.admin.report.ewalletreport', compact('title', 'user', 'users', 'sub_title', 'base', 'method', 'packages', 'bonus_type'));
    }   
    public function pendingreport()
    {
        // dd(1);
        $title     = trans('report.pending-commission-report');
        $sub_title = trans('report.pending-commission-report');
        $base      = trans('report.report');
        $method    = trans('report.pending-commission-report');

        $userss   = User::getUserDetails(Auth::id());
        $user     = $userss[0];
        $users    = User::where('id', '>', 1)->get();
        $packages = Packages::all();
        $bonus_type = PendingCommission::select('payment_type')->groupBY('payment_type')->get();
        return view('app.admin.report.pendingreport', compact('title', 'user', 'users', 'sub_title', 'base', 'method', 'packages', 'bonus_type'));
    }   
     public function pendingreportview(Request $request)
    {
        // dd(2);
        // dd($request->all());
        if ($request->username != null || $request->autocompleteusers != null) {
                 $validator = Validator::make($request->all(), [
            'start'    => 'required|date',
            'end'      => 'required|date|',
            'username' => 'exists:users',
                 ]);
        } else {
            $validator = Validator::make($request->all(), [
            'start'    => 'required|date',
            'end'      => 'required|date|',
            // 'username' => 'sometimes|exists:users',
                  ]);
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $user_id = User::where('username', $request->username)->pluck('id');
    // dd($user_id);
        $title     = trans('report.pending-commission-report');
        $sub_title = trans('report.pending-commission-report');
        $base      = trans('report.report');
        $method    = trans('report.pending-commission-report');

        $reportdata = PendingCommission::where('pending_commissions.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))->where('pending_commissions.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->join('users', 'users.id', '=', 'pending_commissions.user_id')
            ->join('users as from', 'from.id', '=', 'pending_commissions.from_id')
            ->join('profile_infos', 'profile_infos.user_id', '=', 'pending_commissions.user_id')
            ->join('packages', 'packages.id', '=', 'profile_infos.package')
            ->select('users.id','users.username', 'packages.package as position', 'users.lastname', 'users.name', 'pending_commissions.created_at', 'pending_commissions.total_amount', 'pending_commissions.payment_type','from.name as fromname','from.lastname as fromlastname','users.weekly_payout')
            ->where('pending_commissions.payment_status','no')
            ->where('pending_commissions.user_id','>',1)
            ->where(function ($query) use ($request, $user_id) {
                if ($request->bonus_type != 'all') {
                    $query->where('pending_commissions.payment_type', '=', $request->bonus_type);
                }
                if (count($user_id) != 0) {
                    $query->where('pending_commissions.user_id', '=', $user_id);
                }
            })
            ->orderBy('pending_commissions.created_at','ASC')
            ->get();
        // foreach ($reportdata as $key => $value) {
        //     if($value->weekly_payout == 'no'){
        //         $status = PurchaseHistory::where('created_at', '>', date('Y-m-1 00:00:00'))
        //                             ->select('user_id',DB::raw('SUM(total_bv) as total_bv'))
        //                             ->where('user_id',$value->id)
        //                             ->where('type','product')->where('pay_by','!=','register_point')
        //                             ->having(DB::raw('SUM(total_bv)'), '>', 100)
        //                             ->groupBY('user_id')->get();
        //         if(count($status) == 0)
        //             $value->weekly_payout = 'non';
        //     }
        // }
            // dd($reportdata);

        $totalamount = PendingCommission::where('pending_commissions.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('pending_commissions.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('pending_commissions.payment_status', '=', 'no')
            ->where('pending_commissions.user_id','>',1)
            ->where(function ($query) use ($request, $user_id) {
                if ($request->bonus_type != 'all') {
                    $query->where('pending_commissions.payment_type', '=', $request->bonus_type);
                }
                //$user_id = User::where('username', $request->username)->pluck('id');
                if (count($user_id) != 0) {
                    $query->where('pending_commissions.user_id', '=', $user_id);
                }
            })
            ->join('users', 'users.id', '=', 'pending_commissions.user_id')
            ->sum('total_amount');
            // dd($totalamount);

        $company=AppSettings::find(1);
        $start_date=$request->start;
        $end_date=$request->end;

        return view('app.admin.report.pendingreportview', compact('title', 'reportdata', 'totalamount', 'sub_title', 'base', 'method', 'company', 'start_date', 'end_date'));
    }
    public function poolBonus()
    {
        $title     = trans('report.leadership_pool_bonus');
        $sub_title = trans('report.leadership_pool_bonus');
        $base      = trans('report.leadership_pool_bonus');
        $method    = trans('report.leadership_pool_bonus');

        return view('app.admin.report.poolreport', compact('title', 'sub_title', 'base', 'method'));
    }
    public function poolBonustview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start'    => 'required|date',
            'end'      => 'required|date|',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $user_id = User::where('username', $request->username)->pluck('id');
        $title     = trans('report.leadership_pool_bonus');
        $sub_title = trans('report.leadership_pool_bonus');
        $base      = trans('report.leadership_pool_bonus');
        $method    = trans('report.leadership_pool_bonus');

        $reportdata = Commission::where('commission.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))->where('commission.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->join('users', 'users.id', '=', 'commission.user_id')
            ->join('pool_history', 'pool_history.id', '=', 'commission.service_charge')
            ->join('rank_setting', 'rank_setting.id', '=', 'commission.note')
            ->where('commission.payment_type',  'leadership_pool_bonus')
            ->select('users.username','users.lastname', 'users.name', 'commission.created_at', 'commission.total_amount', 'commission.payment_type','pool_history.*','rank_setting.rank_name','rank_setting.pool_share')
            ->where(function ($query) use ($user_id) {
                if (count($user_id) != 0) {
                    $query->where('commission.user_id', '=', $user_id);
                }
            })
            ->get();
            // dd($reportdata);
        $totalamount = Commission::where('commission.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('commission.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('commission.payment_status', '=', 'yes')
            ->where('commission.payment_type',  'leadership_pool_bonus')
            ->where(function ($query) use ($user_id) {
                if (count($user_id) != 0) {
                    $query->where('commission.user_id', '=', $user_id);
                }
            })
            ->join('users', 'users.id', '=', 'commission.user_id')
            ->sum('total_amount');

        $company=AppSettings::find(1);
        $start_date=$request->start;
        $end_date=$request->end;

        return view('app.admin.report.poolreportview', compact('title', 'reportdata', 'totalamount', 'sub_title', 'base', 'method', 'company', 'start_date', 'end_date'));
    }
    public function ewalletreportview(Request $request)
    {
        // dd($request->all());
        if ($request->username != null || $request->autocompleteusers != null) {
                 $validator = Validator::make($request->all(), [
            'start'    => 'required|date',
            'end'      => 'required|date|',
            'username' => 'exists:users',
                 ]);
        } else {
            $validator = Validator::make($request->all(), [
            'start'    => 'required|date',
            'end'      => 'required|date|',
            // 'username' => 'sometimes|exists:users',
                  ]);
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $user_id = User::where('username', $request->username)->pluck('id');
    // dd($user_id);
        $title     = trans('report.members_income_report');
        $sub_title = trans('report.income_report');
        $base      = trans('report.report');
        $method    = trans('report.income_report');

        $reportdata = Commission::where('commission.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))->where('commission.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->join('users', 'users.id', '=', 'commission.user_id')
            ->join('users as from', 'from.id', '=', 'commission.from_id')
            ->join('profile_infos', 'profile_infos.user_id', '=', 'commission.user_id')
            ->join('packages', 'packages.id', '=', 'profile_infos.package')
            ->select('users.id','users.username', 'packages.package as position', 'users.lastname', 'users.name', 'commission.created_at', 'commission.total_amount', 'commission.payment_type','from.name as fromname','from.lastname as fromlastname','users.weekly_payout')
            ->where(function ($query) use ($request, $user_id) {
                if ($request->bonus_type != 'all') {
                    $query->where('commission.payment_type', '=', $request->bonus_type);
                }
                if (count($user_id) != 0) {
                    $query->where('commission.user_id', '=', $user_id);
                }
            })
            ->orderBy('commission.created_at','ASC')
            ->get();
        foreach ($reportdata as $key => $value) {
            if($value->weekly_payout == 'no'){
                $status = PurchaseHistory::where('created_at', '>', date('Y-m-1 00:00:00'))
                                    ->select('user_id',DB::raw('SUM(total_bv) as total_bv'))
                                    ->where('user_id',$value->id)
                                    ->where('type','product')->where('pay_by','!=','register_point')
                                    ->having(DB::raw('SUM(total_bv)'), '>', 100)
                                    ->groupBY('user_id')->get();
                if(count($status) == 0)
                    $value->weekly_payout = 'non';
            }
        }
            //dd($reportdata);

        $totalamount = Commission::where('commission.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('commission.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('commission.payment_status', '=', 'yes')
            ->where(function ($query) use ($request, $user_id) {
                if ($request->bonus_type != 'all') {
                    $query->where('commission.payment_type', '=', $request->bonus_type);
                }
                //$user_id = User::where('username', $request->username)->pluck('id');
                if (count($user_id) != 0) {
                    $query->where('commission.user_id', '=', $user_id);
                }
            })
            ->join('users', 'users.id', '=', 'commission.user_id')
            ->sum('total_amount');
            //dd($totalamount);

        $company=AppSettings::find(1);
        $start_date=$request->start;
        $end_date=$request->end;

        return view('app.admin.report.ewalletreportview', compact('title', 'reportdata', 'totalamount', 'sub_title', 'base', 'method', 'company', 'start_date', 'end_date'));
    }

    public function payoutreport()
    {
        $title     = trans('report.payout_released_report');
        $sub_title = trans('report.payout_release_report');
        $base      = trans('report.report');
        $method    = trans('report.payout_release_report');
        $users     = User::where('id', '>', 1)->get();
        $packages  = Packages::all();
        $user      = User::find(Auth::user()->id);
        return view('app.admin.report.payoutreport', compact('title', 'users', 'user', 'packages', 'sub_title', 'base', 'method'));
    }

    public function payoutreportview(Request $request)
    {
         $userid=User::where('username',$request->username)->value('id');
        //Assets::AddCSS(asset('assets/globals/css/print.css'));

        $validator = Validator::make($request->all(), [
            'start' => 'required|date',
            'end'   => 'required|date|',
            //'username'=>'required|exists:users',
        ]);
        //dd($request->username);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        //$user_id = User::where('username', $request->username)->pluck('id');
        //dd($user_id);
        $title      = trans('report.payout_released_report');
        $sub_title  = trans('report.payout_release_report');
        $base       = trans('report.report');
        $method     = 'Payout release report view';
        $reportdata = Payout::where(function ($query) use ($request,$userid) {
            if ($request->username != null) {
                $query->where('payout_request.user_id', '=', $userid);
            }
        })
            ->where('payout_request.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('payout_request.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('payout_request.status', '=', 'released')
            ->join('users', 'users.id', '=', 'payout_request.user_id')
            ->join('profile_infos', 'profile_infos.user_id', '=', 'payout_request.user_id')
            ->join('currencies', 'currencies.id', '=', 'profile_infos.currency')
            ->select('users.id', 'users.username', 'users.lastname', 'users.name', 'profile_infos.account_holder_name', 'profile_infos.account_number', 'profile_infos.bank_code', 'profile_infos.sort_code', 'profile_infos.swift', 'payout_request.*', 'currencies.symbol', 'currencies.exchange_rate','users.weekly_payout')
            ->orderBy('payout_request.created_at','ASC')
            ->get();
        foreach ($reportdata as $key => $value) {
            if($value->weekly_payout == 'no'){
                $status = PurchaseHistory::where('created_at', '>', date('Y-m-1 00:00:00'))
                                    ->select('user_id',DB::raw('SUM(total_bv) as total_bv'))
                                    ->where('user_id',$value->id)
                                    ->where('type','product')->where('pay_by','!=','register_point')
                                    ->having(DB::raw('SUM(total_bv)'), '>', 100)
                                    ->groupBY('user_id')->get();
                if(count($status) == 0)
                    $value->weekly_payout = 'non';
            }
        }

        $totalamount = Payout::where(function ($query) use ($request,$userid) {
            if ($request->username != null) {
                $query->where('payout_request.user_id', '=', $userid);
            }
        })
            ->where('payout_request.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('payout_request.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('status', '=', 'released')
            ->sum('amount');
             $company=AppSettings::find(1);
            $start_date=$request->start;
            $end_date=$request->end;

        return view('app.admin.report.payoutreportview', compact('title', 'reportdata', 'totalamount', 'sub_title', 'base', 'method', 'company', 'start_date', 'end_date'));
    }

    public function salesreport()
    {
        $title        = trans('report.report');
        $sub_title    = trans('report.sales_report');
        $unread_count = Mail::unreadMailCount(Auth::id());
        $unread_mail  = Mail::unreadMail(Auth::id());
        $base         = trans('report.sales_report');
        $method       = trans('report.sales_report');
        $userss       = User::getUserDetails(Auth::id());
        $user         = $userss[0];
        return view('app.admin.report.salesreport', compact('title', 'unread_count', 'unread_mail', 'user', 'sub_title', 'base', 'method'));
    }

    public function salesreportview(Request $request)
    {
// dd($request->all());
         if (($request->username != null || $request->autocompleteusers != null )&&($request->name!= null)) {
           
         $validator = Validator::make($request->all(), [
            'start'    => 'required|date',
            'end'      => 'required|date|',
            'username' => 'exists:users,username',
            'name' => 'exists:users,username',
           
                 ]);
        } 
        elseif(($request->username != null || $request->autocompleteusers != null )&&($request->name == null)){
         
             $validator = Validator::make($request->all(), [
            'start'    => 'required|date',
            'end'      => 'required|date|',
            'username' => 'exists:users,username',
           
           
                 ]);

        }
        elseif(($request->username == null && $request->autocompleteusers == null )&&($request->name != null)){
           
            $validator = Validator::make($request->all(), [
            'start'    => 'required|date',
            'end'      => 'required|date|',
           
            'name' => 'exists:users,username',
           
                 ]);

        }
        else {
          
            $validator = Validator::make($request->all(), [
            'start'    => 'required|date',
            'end'      => 'required|date|',
            
          ]);
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $seller_id = User::where('username', $request->username)->pluck('id');
        $user_id = User::where('username', $request->name)->pluck('id');
        // dd($seller_id,$user_id);

        $title      = trans('report.report');
        $sub_title  = trans('report.sales_report');
        $base       = trans('report.sales_report');
        $method     = trans('report.sales_report');
        $reportdata = PurchaseHistory::where('purchase_history.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('purchase_history.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('purchase_history.sales_status', 'yes')
            ->join('users', 'users.id', '=', 'purchase_history.user_id')
             ->join('users as seller', 'seller.id', '=', 'purchase_history.seller_id')
            ->select('purchase_history.created_at', 'users.username', 'users.name', 'users.lastname', 'users.email',DB::raw('sum(purchase_history.total_amount) as amount'), DB::raw('sum(purchase_history.count) as count'), 'purchase_history.seller_id','seller.username as sellername','purchase_history.order_status','purchase_history.tracking_id','purchase_history.product_name','purchase_history.id','purchase_history.user_id','purchase_history.payment_date','purchase_history.type','purchase_history.invoice_id') 
            ->where(function ($query) use ($request, $user_id,$seller_id) {
                if (count($user_id) != 0 && count($seller_id) == 0) {
                    $query->where('purchase_history.user_id', '=', $user_id);
                }
                if(count($seller_id) != 0 && count($user_id) == 0){
                     $query->where('purchase_history.seller_id', '=',$seller_id);
                }
                if((count($seller_id) != 0 && count($user_id) != 0)){
                  $query->where('purchase_history.user_id', '=', $user_id)
                        ->where('purchase_history.seller_id', '=',$seller_id);
                }
            })
            ->groupBY('purchase_history.invoice_id')
            ->get();

        $countries = CountryState::getCountries();
            // dd($reportdata);
        // foreach ($reportdata as $key => $value) {
        //     $states = CountryState::getStates($value->country);
        //     $state  = array_get($states,$value->state);
        //     if($state != null)
        //         $reportdata[$key]->state = $state;
        // }

        $total_amount = PurchaseHistory::where('purchase_history.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('purchase_history.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('purchase_history.sales_status', 'yes')
             ->where(function ($query) use ($request, $user_id,$seller_id) {
                if (count($user_id) != 0 && count($seller_id) == 0) {
                    $query->where('purchase_history.user_id', '=', $user_id);
                }
                if(count($seller_id) != 0 && count($user_id) == 0){
                     $query->where('purchase_history.seller_id', '=',$seller_id);
                }
                if((count($seller_id) != 0 && count($user_id) != 0)){
                  $query->where('purchase_history.user_id', '=', $user_id)
                        ->where('purchase_history.seller_id', '=',$seller_id);
                }
            })
            ->sum('total_amount');
// dd($total_amount);
            $company=AppSettings::find(1);
            $start_date=$request->start;
            $end_date=$request->end;

        return view('app.admin.report.salesreportview', compact('title', 'reportdata', 'total_amount', 'sub_title', 'base', 'method', 'company', 'start_date', 'end_date'));
    }

    public function stockManagement()
    {
        $title        = trans('report.report');
        $sub_title    = trans('menu.stock_management');
        $base         = trans('menu.stock_management');
        $method       = trans('menu.stock_management');
        $product      = Product::all();

        // return view('app.admin.report.stock_management', compact('title','sub_title', 'base', 'method', 'product'));
    }

    public function stockManagementView(Request $request)
    {
         if ($request->username != null || $request->autocompleteusers != null) {
         $validator = Validator::make($request->all(), [
            'start'    => 'required|date',
            'end'      => 'required|date|',
            'username' => 'exists:users',
                 ]);
        } else {
            $validator = Validator::make($request->all(), [
            'start'    => 'required|date',
            'end'      => 'required|date|',
            
          ]);
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $user_id = User::where('username', $request->username)->pluck('id');

        $title      = trans('report.report');
        $sub_title  = trans('menu.stock_management');
        $base       = trans('menu.stock_management');
        $method     = trans('menu.stock_management');

        $reportdata = StockManagement::where('stock_management.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('stock_management.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('stock_management.product_id', $request->product)
            ->join('users', 'users.id', '=', 'stock_management.user_id')
            ->join('product', 'product.id', '=', 'stock_management.product_id')
            ->join('profile_infos', 'profile_infos.user_id', '=', 'users.id')
            ->select('product.name as product_name','stock_management.in','stock_management.out','stock_management.balance','users.username', 'users.name', 'users.lastname','profile_infos.country','profile_infos.state','stock_management.created_at','stock_management.remark','stock_management.status')
            ->orderby('stock_management.id','ASC')
            ->get();
        $countries = CountryState::getCountries();
        foreach ($reportdata as $key => $value) {
            $states = CountryState::getStates($value->country);
            $state  = array_get($states,$value->state);
            if($state != null)
                $reportdata[$key]->state = $state;
        }
        // $total_amount = PurchaseHistory::where('purchase_history.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
        //     ->where('purchase_history.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
        //     ->where('purchase_history.sales_status', 'yes')
        //      ->where(function ($query) use ($request, $user_id) {
               
        //         if (count($user_id) != 0) {
        //             $query->where('purchase_history.user_id', '=', $user_id);
        //         }
        //     })
        //     ->where('type','product')
        //     ->where('pay_by','!=','register_point')
        //     ->sum('total_amount');

            $company=AppSettings::find(1);
            $start_date=$request->start;
            $end_date=$request->end;

        // return view('app.admin.report.stock_management_view', compact('title', 'reportdata', 'sub_title', 'base', 'method', 'company', 'start_date', 'end_date'));
    }
    public function rpreport()
    {
        $title        = trans('report.report');
        $sub_title    = trans('report.register_point_report');
        $base         = trans('report.register_point_report');
        $method       = trans('report.register_point_report');
        $userss       = User::getUserDetails(Auth::id());
        $user         = $userss[0];
        return view('app.admin.report.rpreport', compact('title', 'user', 'sub_title', 'base', 'method'));
    }

    public function rpreportview(Request $request)
    {

        if ($request->username != null || $request->autocompleteusers != null) {
         $validator = Validator::make($request->all(), [
            'start'    => 'required|date',
            'end'      => 'required|date|',
            'username' => 'exists:users',
                 ]);
        } else {
            $validator = Validator::make($request->all(), [
            'start'    => 'required|date',
            'end'      => 'required|date|',
            
          ]);
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $user_id = User::where('username', $request->username)->pluck('id');
        $users = User::all();
        foreach ($users as $key => $value)
            $all_users[$value->id]=$value;
        
        $title      = trans('report.report');
        $sub_title  = trans('report.register_point_report');
        $base       = trans('report.register_point_report');
        $method     = trans('report.register_point_report');
        $reportdata = PurchaseHistory::where('purchase_history.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('purchase_history.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('purchase_history.sales_status', 'yes')
            ->join('users', 'users.id', '=', 'purchase_history.user_id')
            ->join('users as from', 'from.id', '=', 'users.sponsor_id')
            ->join('product', 'product.id', '=', 'purchase_history.package_id')
            ->select('purchase_history.created_at', 'users.username', 'users.name', 'users.lastname', 'users.email', 'purchase_history.total_amount as amount','purchase_history.total_bv', 'product.name as product_name','purchase_history.count','purchase_history.order_status','purchase_history.id','purchase_history.purchase_type','from.username as fromuser')
            ->where(function ($query) use ($request, $user_id) {
                if (count($user_id) != 0) {
                    $query->where('purchase_history.user_id', '=', $user_id);
                }
                if($request->track_id != ""){
                     $query->where('purchase_history.order_status', '=', $request->track_id);
                }
            })
            ->where('type','product')
            ->where('pay_by','register_point')
            ->get();
       
        $total_amount = PurchaseHistory::where('purchase_history.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('purchase_history.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('purchase_history.sales_status', 'yes')
             ->where(function ($query) use ($request, $user_id) {
               
                if (count($user_id) != 0) {
                    $query->where('purchase_history.user_id', '=', $user_id);
                }
            })
            ->where('type','product')
            ->where('pay_by','register_point')
            ->sum('total_amount');

            $company=AppSettings::find(1);
            $start_date=$request->start;
            $end_date=$request->end;

        return view('app.admin.report.rpreportview', compact('title', 'reportdata', 'total_amount', 'sub_title', 'base', 'method', 'company', 'start_date', 'end_date'));
    }
    public function membersRegisterPoint()
    {
        $title        = trans('report.members_register_point');
        $sub_title    = trans('report.members_register_point');
        $base         = trans('report.members_register_point');
        $method       = trans('report.members_register_point');
        $userss       = User::getUserDetails(Auth::id());
        $user         = $userss[0];
        return view('app.admin.report.membersregisterpoint', compact('title', 'user', 'sub_title', 'base', 'method'));
    }

    public function membersRegisterPointView(Request $request)
    {

        if ($request->username != null || $request->autocompleteusers != null) {
         $validator = Validator::make($request->all(), [
            'start'    => 'required|date',
            'end'      => 'required|date|',
            'username' => 'exists:users',
                 ]);
        } else {
            $validator = Validator::make($request->all(), [
            'start'    => 'required|date',
            'end'      => 'required|date|',
            
          ]);
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $user_id = User::where('username', $request->username)->pluck('id');
        $usersname = $request->username;
 
        $title      = trans('report.members_register_point');
        $sub_title  = trans('report.members_register_point');
        $base       = trans('report.members_register_point');
        $method     = trans('report.members_register_point');
        $rpArray    = [];
        $rp         = RegisterPoint::all();
        foreach ($rp as $key => $value) {
            $rpArray[$value->user_id][$value->type] = isset($rpArray[$value->user_id][$value->type]) ?  $rpArray[$value->user_id][$value->type]+ $value->total_amount: $value->total_amount;
        }
        $reportdata = Balance::where('users.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('users.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->join('users', 'users.id', '=', 'user_balance.user_id')
            ->select('user_balance.user_id','user_balance.register_point', 'users.email', 'users.username', 'users.name', 'users.lastname')
            ->where(function ($query) use ($request, $user_id) {
                if (count($user_id) != 0) {
                    $query->where('user_balance.user_id', '=', $user_id);
                }
            })
            ->get();
        foreach ($reportdata as $key => $value) {
            $value->total = isset($rpArray[$value->user_id]['credit']) ? $rpArray[$value->user_id]['credit'] : 0;
            $value->used  = isset($rpArray[$value->user_id]['debit']) ? $rpArray[$value->user_id]['debit'] : 0;
        }
        $totalamount = Balance::where('users.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('users.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->join('users', 'users.id', '=', 'user_balance.user_id')
            ->where(function ($query) use ($request, $user_id) {
               
                if (count($user_id) != 0) {
                    $query->where('user_balance.user_id', '=', $user_id);
                }
            })
            ->sum('register_point');

            $company=AppSettings::find(1);
            $start_date=$request->start;
            $end_date=$request->end;

        return view('app.admin.report.membersregisterpointview', compact('title', 'reportdata', 'totalamount', 'sub_title', 'base', 'method', 'company', 'start_date', 'end_date','usersname'));
    }

    public function editRp(Request $request)
    {    
        Balance::where('user_id',$request->user_id)->update(['register_point'=>$request->rp]);
        Session::flash('flash_notification', array('level' => 'success', 'message' => "RP Updated Successfully"));
        return redirect()->back();
        $user_id = User::where('username', $request->username)->pluck('id');
        $usersname = $request->username;
        
        $title      = trans('report.members_register_point');
        $sub_title  = trans('report.members_register_point');
        $base       = trans('report.members_register_point');
        $method     = trans('report.members_register_point');
        $rpArray    = [];
        $rp         = RegisterPoint::all();
        foreach ($rp as $key => $value) {
            $rpArray[$value->user_id][$value->type] = isset($rpArray[$value->user_id][$value->type]) ?  $rpArray[$value->user_id][$value->type]+ $value->total_amount: $value->total_amount;
        }
        $reportdata = Balance::where('users.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('users.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->join('users', 'users.id', '=', 'user_balance.user_id')
            ->select('user_balance.user_id','user_balance.register_point', 'users.email', 'users.username', 'users.name', 'users.lastname')
            ->where(function ($query) use ($request, $user_id) {
                if (count($user_id) != 0) {
                    $query->where('user_balance.user_id', '=', $user_id);
                }
            })
            ->get();
        foreach ($reportdata as $key => $value) {
            $value->total = isset($rpArray[$value->user_id]['credit']) ? $rpArray[$value->user_id]['credit'] : 0;
            $value->used  = isset($rpArray[$value->user_id]['debit']) ? $rpArray[$value->user_id]['debit'] : 0;
        }
        $totalamount = Balance::where('users.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('users.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->join('users', 'users.id', '=', 'user_balance.user_id')
            ->where(function ($query) use ($request, $user_id) {
               
                if (count($user_id) != 0) {
                    $query->where('user_balance.user_id', '=', $user_id);
                }
            })
            ->sum('register_point');

            $company=AppSettings::find(1);
            $start_date=$request->start;
            $end_date=$request->end;

        return view('app.admin.report.membersregisterpointview', compact('title', 'reportdata', 'totalamount', 'sub_title', 'base', 'method', 'company', 'start_date', 'end_date','usersname'));
    }
    public function pairingreport()
    {
        $title     = trans('report.pairing_report');
        $sub_title = trans('report.pairing_report');
        $base      = trans('report.report');
        $method    = trans('report.pairing_report');

        $user     = User::find(Auth::id());
        $users    = User::where('id', '>', 1)->get();
        $packages = Packages::all();
        return view('app.admin.report.pairingreport', compact('title', 'user', 'users', 'sub_title', 'base', 'method', 'packages'));
    }

    public function pairingreportview(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'start' => 'required|date',
            'end'   => 'required|date|',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ($request->user_id != 'all') {
            $request->username = $request->user_id;
        }

        $title     = trans('report.pairing_report');
        $sub_title = trans('report.pairing_report');
        $base      = trans('report.report');
        $method    = trans('report.pairing_report');

        if (date('l', strtotime($request->start)) != 'Sunday') {
            $nextSunday     = strtotime('last Sunday', strtotime($request->start));
            $request->start = date('Y-m-d', $nextSunday);
        }
        if (date('l', strtotime($request->end)) != 'Saturday') {
            $nextSaturday = strtotime('next Saturday', strtotime($request->end));
            $request->end = date('Y-m-d', $nextSaturday);
        }

        $date_arr = array();

        $start_date = date('Y-m-d', strtotime($request->start));
        $end_date   = date('Y-m-d', strtotime($request->end));

        while (strtotime($end_date) >= strtotime('next Saturday', strtotime($start_date))) {
            $date_arr[] = array('start' => $start_date, 'end' => date('Y-m-d', strtotime('next Saturday', strtotime($start_date))));
            $start_date = date('Y-m-d', strtotime('next Sunday', strtotime($start_date)));
        }

        $final_arr = [];

        foreach ($date_arr as $key => $value) {
            $final_arr[] = $reportdata = PairingHistory::where('pairing_history.created_at', '>', date('Y-m-d 00:00:00', strtotime($value['start'])))
                ->where('pairing_history.created_at', '<', date('Y-m-d 23:59:59', strtotime($value['end'])))
                ->where(function ($query) use ($request) {
                    if ($request->username != 'all') {
                        $query->where('pairing_history.user_id', '=', $request->username);
                    }
                    if ($request->position != 'all') {
                        $query->where('users.package', '=', $request->position);
                    }
                })
                ->join('users', 'users.id', '=', 'pairing_history.user_id')
                ->select('users.username', 'users.lastname', 'users.name', 'pairing_history.*')
                ->orderBy('created_at', 'ASC')
                ->get();
        }

        return view('app.admin.report.pairingreportview', compact('title', 'final_arr', 'date_arr', 'sub_title', 'base', 'method'));
    }

    public function carryreportview(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'start' => 'required|date',
            'end'   => 'required|date|',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ($request->user_id != 'all') {
            $request->username = $request->user_id;
        }
        $title     = trans('report.carry_forward');
        $sub_title = trans('report.pairing_report');
        $base      = trans('report.report');
        $method    = trans('report.pairing_report');

        if (date('l', strtotime($request->start)) != 'Sunday') {
            $nextSunday     = strtotime('last Sunday', strtotime($request->start));
            $request->start = date('Y-m-d', $nextSunday);
        }
        if (date('l', strtotime($request->end)) != 'Saturday') {
            $nextSaturday = strtotime('next Saturday', strtotime($request->end));
            $request->end = date('Y-m-d', $nextSaturday);
        }

        $date_arr = array();

        $start_date = date('Y-m-d', strtotime($request->start));
        $end_date   = date('Y-m-d', strtotime($request->end));

        while (strtotime($end_date) >= strtotime('next Saturday', strtotime($start_date))) {
            $date_arr[] = array('start' => $start_date, 'end' => date('Y-m-d', strtotime('next Saturday', strtotime($start_date))));
            $start_date = date('Y-m-d', strtotime('next Sunday', strtotime($start_date)));
        }

        $final_arr = [];

        foreach ($date_arr as $key => $value) {
            $final_arr[] = $reportdata = CarryForwardHistory::where('carry_forward_history.created_at', '>', date('Y-m-d 00:00:00', strtotime($value['start'])))
                ->where('carry_forward_history.created_at', '<', date('Y-m-d 23:59:59', strtotime($value['end'])))
                ->where(function ($query) use ($request) {
                    if ($request->username != 'all') {
                        $query->where('carry_forward_history.user_id', '=', $request->username);
                    }
                    if ($request->position != 'all') {
                        $query->where('users.package', '=', $request->position);
                    }
                })
                ->join('users', 'users.id', '=', 'carry_forward_history.user_id')
                ->select('users.username', 'users.lastname', 'users.name', 'carry_forward_history.*')
                ->orderBy('created_at', 'ASC')
                ->get();
        }

        return view('app.admin.report.carryreportview', compact('title', 'final_arr', 'date_arr', 'sub_title', 'base', 'method'));
    }

    public function topearners()
    {
        $title        = trans('report.top_earners');
        $sub_title    = trans('report.top_earners');
        $unread_count = Mail::unreadMailCount(Auth::id());
        $unread_mail  = Mail::unreadMail(Auth::id());
        $base         = trans('report.top_earners');
        $method       = trans('report.top_earners');
        $userss       = User::getUserDetails(Auth::id());
        $user         = $userss[0];
        return view('app.admin.report.topearners', compact('title', 'unread_count', 'unread_mail', 'user', 'sub_title', 'base', 'method'));
    }

    public function topearnersview(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'start' => 'required|date',
            'end'   => 'required|date|',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $title      = trans('report.top_earners_report');
        $sub_title  = trans('report.top_earners_report');
        $base       = trans('report.top_earners_report');
        $method     = trans('report.top_earners_report');
        $reportdata = Commission::where('commission.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))->where('commission.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('commission.payment_status', '=', 'yes')
            ->join('users', 'users.id', '=', 'commission.user_id')
            ->join('profile_infos', 'profile_infos.user_id', '=', 'commission.user_id')
            ->groupBY('commission.user_id')
            ->select('users.username', 'users.name', 'users.lastname',  DB::raw('SUM(payable_amount) as amount'))
            ->where('payable_amount', '>', 0)
            ->orderby('amount', 'DESC')
            ->get();
            //dd($reportdata);
             $totalamount = Commission::where('commission.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('commission.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('commission.payment_status', '=', 'yes')
            /*->where(function ($query) use ($request, $user_id) {
                if ($request->bonus_type != 'all') {
                    $query->where('commission.payment_type', '=', $request->bonus_type);
                }
                //$user_id = User::where('username', $request->username)->pluck('id');
                if ($user_id != null) {
                    $query->where('commission.user_id', '=', $user_id);
                }*/
            //})
            ->join('users', 'users.id', '=', 'commission.user_id')
            ->sum('total_amount');
            $company=AppSettings::find(1);
            $start_date=$request->start;
            $end_date=$request->end;

        return view('app.admin.report.topearnersview', compact('title', 'reportdata', 'totalamount', 'sub_title', 'base', 'method', 'company', 'start_date', 'end_date'));
    }
    public function topsellerview(Request $request)
    {
// dd(1);
        $validator = Validator::make($request->all(), [
            'start' => 'required|date',
            'end'   => 'required|date|',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $title      = trans('report.top_seller_report');
        $sub_title  = trans('report.top_seller_report');
        $base       = trans('report.top_seller_report');
        $method     = trans('report.top_seller_report');
        $reportdata = PurchaseHistory::where('purchase_history.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))->where('purchase_history.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('purchase_history.sales_status', '=', 'yes')
            ->join('users', 'users.id', '=', 'purchase_history.seller_id')
            ->groupBY('purchase_history.seller_id')
            ->select('users.username', 'users.name', 'users.lastname',  DB::raw('SUM(total_amount) as amount'),DB::raw('SUM(count) as sale_count'))
            ->where('total_amount', '>', 0)
            ->orderby('amount', 'DESC')
            ->get();
            // dd($reportdata);
             $totalamount = PurchaseHistory::where('purchase_history.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('purchase_history.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('purchase_history.sales_status', '=', 'yes')
            /*->where(function ($query) use ($request, $user_id) {
                if ($request->bonus_type != 'all') {
                    $query->where('commission.payment_type', '=', $request->bonus_type);
                }
                //$user_id = User::where('username', $request->username)->pluck('id');
                if ($user_id != null) {
                    $query->where('commission.user_id', '=', $user_id);
                }*/
            //})
            ->join('users', 'users.id', '=', 'purchase_history.seller_id')
            ->sum('total_amount');
            $company=AppSettings::find(1);
            $start_date=$request->start;
            $end_date=$request->end;

        return view('app.admin.report.topsellerview', compact('title', 'reportdata', 'totalamount', 'sub_title', 'base', 'method', 'company', 'start_date', 'end_date'));
    }

    public function revenuereport()
    {
        $title     = trans('report.revenue_report');
        $sub_title = trans('report.revenue_report');
        $base      = trans('report.report');
        $method    = trans('report.revenue_report');
        $user      = User::find(Auth::id());
        $users     = User::where('id', '>', 1)->get();

        return view('app.admin.report.revenuereport', compact('title', 'users', 'user', 'sub_title', 'base', 'method'));
    }

    public function revenuereportview(Request $request)
    {

        $title     = trans('report.revenue_report');
        $sub_title = trans('report.revenue_report');
        $base      = trans('report.report');
        $method    = trans('report.revenue_report');
        $user      = User::find(Auth::id());

        if ($request->user_id != 'all') {
            $request->username = $request->user_id;
        }

        $user = User::find($request->username);

        $total_sales = PurchaseHistory::where('purchase_history.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('purchase_history.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('purchase_history.status', '=', 'approved')
            ->where(function ($query) use ($request) {
                if ($request->username != 'all') {
                    $query->where('purchase_history.user_id', '=', $request->username);
                }
            })
            ->sum('total_amount');

        $payout = Commission::where('commission.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('commission.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('commission.payment_status', '=', 'yes')
            ->where(function ($query) use ($request) {
                if ($request->username != 'all') {
                    $query->where('commission.user_id', '=', $request->username);
                }
                if ($request->bonus_type != 'all') {
                    $query->where('commission.payment_type', '=', $request->bonus_type);
                }
            })
            ->sum('payable_amount');

        return view('app.admin.report.revenuereportview', compact('title', 'user', 'sub_title', 'base', 'method', 'request', 'user', 'total_sales', 'payout'));
    }

    public function salereport()
    {
        $title     = trans('report.sales_report');
        $sub_title = trans('report.sales_report');
        $base      = trans('report.report');
        $method    = trans('report.sales_report');
        $user      = User::find(Auth::id());
        $users     = User::where('id', '>', 1)->get();
        $package   = Packages::all();

        return view('app.admin.report.salesreport', compact('title', 'users', 'user', 'sub_title', 'base', 'method', 'package'));
    }

    public function salereportview(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'start' => 'required|date',
            'end'   => 'required|date|',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ($request->user_id != 'all') {
            $request->username = $request->user_id;
        }

        $title      = trans('report.sales_report');
        $sub_title  = trans('report.sales_report');
        $base       = trans('report.report');
        $method     = trans('report.sales_report');
        $reportdata = PurchaseHistory::where('purchase_history.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('purchase_history.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('purchase_history.status', '=', 'approved')
            ->where(function ($query) use ($request) {
                if ($request->username != 'all') {
                    $query->where('purchase_history.user_id', '=', $request->username);
                }
                if ($request->package != 'all') {
                    $query->where('users.package', '=', $request->package);
                }
            })
            ->join('users', 'users.id', '=', 'purchase_history.user_id')
            ->join('packages', 'packages.id', '=', 'users.package')
            ->select('purchase_history.*', 'users.username', 'users.user_id as userid', 'users.lastname', 'users.name', 'packages.package')
            ->orderBy('purchase_history.created_at', 'ASC')
            ->get();

        return view('app.admin.report.salereportview', compact('title', 'reportdata', 'sub_title', 'base', 'method'));
    }

    public function maintenancereport()
    {
        $title     = trans('report.maintenance_report');
        $sub_title = trans('report.maintenance_report');
        $base      = trans('report.report');
        $method    = trans('report.maintenance_report');
        $user      = User::find(Auth::id());
        $users     = User::where('id', '>', 1)->get();

        return view('app.admin.report.maintenancereport', compact('title', 'users', 'user', 'sub_title', 'base', 'method'));
    }
    public function maintenancereportview(Request $request)
    {
        $title     = trans('report.maintenance_report');
        $sub_title = trans('report.maintenance_report');
        $base      = trans('report.report');
        $method    = trans('report.maintenance_report');
        $users     = array();
        if ($request->bv == 'm') {
            $users = User::rightjoin('purchase_history', 'purchase_history.user_id', '=', 'users.id')
                ->whereYear('purchase_history.created_at', '=', date('Y', strtotime($request->start)))
                ->whereMonth('purchase_history.created_at', '=', date('m', strtotime($request->start)))
                ->where('purchase_history.status', '=', 'approved')
                ->leftjoin('packages', 'packages.id', '=', 'users.package')
                ->select('users.username', 'users.id', 'users.name', 'packages.package', 'users.lastname', 'users.user_id', DB::raw('SUM(purchase_history.BV) as BV'))
                ->having(DB::raw('SUM(purchase_history.BV)'), '<', 100)
                ->groupBY('purchase_history.user_id')
                ->get();
        } elseif ($request->bv == 'n') {
            $users = User::rightjoin('purchase_history', 'purchase_history.user_id', '=', 'users.id')
                ->whereYear('purchase_history.created_at', '=', date('Y', strtotime($request->start)))
                ->whereMonth('purchase_history.created_at', '=', date('m', strtotime($request->start)))
                ->where('purchase_history.status', '=', 'approved')
                ->leftjoin('packages', 'packages.id', '=', 'users.package')
                ->select('users.username', 'users.id', 'users.name', 'packages.package', 'users.lastname', 'users.user_id', DB::raw('SUM(purchase_history.BV) as BV'))
                ->having(DB::raw('SUM(purchase_history.BV)'), '>=', 100)
                ->groupBY('purchase_history.user_id')
                ->get();
        }

        $users_not_in = array(1);
        $users_in     = array();

        foreach ($users as $key => $value) {
            array_push($users_not_in, $value->id);
        }

        $user_list = User::where(function ($query) use ($users_not_in) {
            $query->whereNotIn('users.id', $users_not_in);
        })
            ->leftjoin('packages', 'packages.id', '=', 'users.package')
            ->select('users.*', 'packages.package')
            ->get();

        $reportdata = array();

        foreach ($user_list as $key => $value) {
            $bv = PurchaseHistory::getMonthlyTotal($value->id, $request->start);
            if ($bv >= 100) {
                $status = 'Maintain';
            } else {
                $status = 'Not Maintain';
            }
            $reportdata[] = array(
                'username' => $value->username,
                'user_id'  => $value->user_id,
                'name'     => $value->name . ' ' . $value->lastname,
                'package'  => $value->package,
                'BV'       => $bv,
                'status'   => $status,
            );
        }

        return view('app.admin.report.maintenancereportview', compact('title', 'sub_title', 'base', 'method', 'reportdata'));
    }

    public function summuryreport()
    {
        $title     = trans('report.report');
        $sub_title = trans('report.summary_report');
        $base      = trans('report.report');
        $method    = trans('report.summary_report');
       
        return view('app.admin.report.summuryreport', compact('title', 'sub_title', 'base', 'method'));
    }

    public function summuryreportview(Request $request)
    {
        
        $title     = trans('report.summary_report');
        $sub_title = trans('report.summary_report');
        $base      = trans('report.report');
        $method    = trans('report.summary_report');
         
          $total_purchase= PurchaseHistory::select(array(
                                    DB::raw('DATE(`created_at`) as `date`'),
                                    DB::raw('sum(total_amount) as `sum`')
                                ))
                               ->whereMonth('purchase_history.created_at', '=', date('m', strtotime($request->start)))
                                ->groupBy('date')
                                ->orderBy('date', 'DESC')
                                ->get()->toArray();



         $total_purchase_sum = PurchaseHistory::whereMonth('purchase_history.created_at', '=', date('m', strtotime($request->start)))
                               ->sum('total_amount'); 
                               // dd($total_purchase,$total_purchase_sum);

            $total_commission = Commission::select(array(
                                    DB::raw('DATE(`created_at`) as `date`'),
                                    DB::raw('sum(total_amount) as `sum`')
                                ))
                               ->whereMonth('commission.created_at', '=', date('m', strtotime($request->start)))
                               ->where('commission.payment_type','<>','plan_upgrade')
                               ->where('payment_type','NOT LIKE','%fund_%')
                                ->groupBy('date')
                                ->orderBy('date', 'DESC')
                                ->get()->toArray();

        $total_commission_sum = Commission::whereMonth('commission.created_at', '=', date('m', strtotime($request->start))) ->where('commission.payment_type','<>','plan_upgrade')
                               ->where('payment_type','NOT LIKE','%fund_%')
                                ->sum('total_amount');

                // dd($total_commission,$total_commission_sum);             
     
        $grnad_total=$total_purchase_sum-$total_commission_sum; 
      
              $company=AppSettings::find(1);
            $start_date=$request->start;
            $end_date= date("m/t/Y", strtotime($request->start));

            
       
        return view('app.admin.report.summuryreportview', compact('title', 'sub_title', 'base', 'method', 'total_purchase', 'total_commission', 'grnad_total', 'company', 'start_date', 'end_date','total_purchase_sum','total_commission_sum'));
    }

    public function inactiveUsers()
    {
        $title     = trans('report.report');
        $sub_title = 'Inactive User Report';
        $base      = trans('report.report');
        $method    = 'Inactive User Report';
       
        return view('app.admin.report.inactive_users', compact('title', 'sub_title', 'base', 'method'));
    }

    public function inactiveUsersView(Request $request){

        $title     = trans('report.report');
        $sub_title = 'Inactive User Report';
        $base      = trans('report.report');
        $method    = 'Inactive User Report';

        // $data = UserInactiveHistory::where('created_at', '>=', date('Y-m-d 00:00:00', strtotime($request->start)))->where('created_at', '<=', date('Y-m-d 23:59:59', strtotime($request->end)))->pluck('user_id')->toArray();

        $value = User::where('id','>',1)->where('status','inactive')->where('user_type','!=','Customer')->get();
        // dd($value);
        $reportdata = [];
        foreach ($value as $key => $data) {
            // $data = User::find($value);
            $reportdata[$key]['username']     = $data->username;
            $reportdata[$key]['fullname']     = $data->name.' '.$data->lastname;
            $reportdata[$key]['email']        = $data->email;
            $reportdata[$key]['created_at']   = $data->created_at;
            $reportdata[$key]['lastpurchase'] = PurchaseHistory::where('user_id',$data->id)->max('created_at');
            $reportdata[$key]['expire_at']    = $data->expiry_date;
            // dd($reportdata);
        }
            // dd($reportdata);

        // $reportdata = User::where('id','>',1)->where('status','inactive')->where('user_type','!=','Customer')->get();

        return view('app.admin.report.inactive_users_view', compact('title', 'sub_title', 'base', 'method','reportdata'));    

    }
    public function usersDetails()
    {
        $title     = trans('report.user_details');
        $sub_title = trans('report.user_details');
        $base      = trans('report.user_details');
        $method    = trans('report.user_details');
        return view('app.admin.report.user_details', compact('title', 'sub_title', 'base', 'method'));
    }    
    public function usersDetailsPost(Request $request)
    {
        $title     = trans('report.user_details');
        $sub_title = trans('report.user_details');
        $base      = trans('report.user_details');
        $method    = trans('report.user_details');

        $reportdata = User::join('pending_transactions', 'pending_transactions.username',  'users.username')->join('profile_infos', 'profile_infos.user_id',  'users.id')->select('users.*','profile_infos.*', 'users.created_at as date','pending_transactions.payment_method','pending_transactions.invoice as bankslip')->where('users.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))->where('users.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))->groupBy('users.username')->orderBy('users.id')->get();
        $countries = CountryState::getCountries();
        foreach ($reportdata as $key => $value) {
            $country   = array_get($countries,$value->country);

                if($country != null)
                $reportdata[$key]->country_name = $country;
    
                $states = CountryState::getStates($value->country);
                $state  = array_get($states,$value->state);
                if($state != null)
                $reportdata[$key]->state_name = $state;
        }
      
        $start_date=$request->start;
        $end_date=$request->end;

        return view('app.admin.report.user_details_view', compact('title', 'sub_title', 'base', 'method','reportdata','start_date','end_date'));
    }
    public function topEnrollerReport()
    {
        $title     = trans('report.top_enroller_report');
        $sub_title = trans('report.top_enroller_report');
        $base      = trans('report.top_enroller_report');
        $method    = trans('report.top_enroller_report');

        return view('app.admin.report.topenrollerreport', compact('title','sub_title', 'base', 'method'));
    }
    
    public function topEnrollerReportView(Request $request){

        // dd($request->all());
        $title     = trans('report.top_enroller_report');
        $sub_title = trans('report.top_enroller_report');
        $base      = trans('report.report');
        $method    = trans('report.top_enroller_report');
        $user_id = User::where('username', $request->username)->pluck('id');

        $reportdata = Sponsortree::where('sponsortree.updated_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))->where('sponsortree.updated_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('sponsortree.type','<>','vaccant')
            ->join('users', 'users.id', '=', 'sponsortree.sponsor')
            ->join('profile_infos', 'profile_infos.user_id', '=', 'sponsortree.sponsor')
            ->groupBy('sponsortree.sponsor')
            ->select('users.username', 'users.name', 'users.lastname','users.email' , DB::raw('COUNT(sponsortree.user_id) as referals'))
            ->where(function ($query) use ($request, $user_id) {
                if (count($user_id) != 0) {
                    $query->where('users.id', '=', $user_id);
                }
            })
            ->orderby('referals', 'DESC')
            ->get();

            $start_date=$request->start;
            $end_date=$request->end;

         return view('app.admin.report.topenrollerreportview', compact('title', 'reportdata', 'sub_title', 'base', 'method','start_date','end_date'));
          
    }
     public function customer_report()
     {
        $title     = trans('Customer Report');
        $sub_title = trans('Customer Report');
        $base      = trans('Customer Report');
        $method    = trans('Customer Report');

        return view('app.admin.report.stock_management', compact('title','sub_title', 'base', 'method'));
     }
     
     public function customer_reportView(Request $request)
     {
        $title     = trans('Customer Report');
        $sub_title = trans('Customer Report');
        $base      = trans('Customer Report');
        $method    = trans('Customer Report');
        $start_date=$request->start;
        $end_date=$request->end;

        $reportdata = User::where('users.user_type','Customer')
        ->join('purchase_history','purchase_history.user_id','users.id')
        ->join('users as seller','seller.id','purchase_history.seller_id')
        ->where('purchase_history.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
        ->where('purchase_history.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
        ->groupBY('purchase_history.user_id')
        ->select('users.name','users.lastname','users.user_type','users.email','seller.username as sellername','users.created_at','purchase_history.created_at as purchased_at')
        ->get();

        return view('app.admin.report.stock_management_view', compact('title','sub_title', 'base', 'method','reportdata','start_date','end_date'));
     }
     public function dealer_report()
     {
        $title     = trans('Dealer Report');
        $sub_title = trans('Dealer Report');
        $base      = trans('Dealer Report');
        $method    = trans('Dealer Report');

        return view('app.admin.report.dealer', compact('title','sub_title', 'base', 'method'));
     }
      public function dealer_reportView(Request $request)
     {
        $title     = trans('Dealer Report');
        $sub_title = trans('Dealer Report');
        $base      = trans('Dealer Report');
        $method    = trans('Dealer Report');
        $start_date=$request->start;
        $end_date=$request->end;

        $reportdata = User::join('purchase_history','purchase_history.user_id','users.id')
        ->where('purchase_history.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
        ->where('purchase_history.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
        ->where('users.user_type','Dealer')
        ->groupBY('users.id')
        // ->where(function($query) {
        //             $query->where('users.user_type','Dealer')
        //             ->orWhere('users.user_type','Share Partner')
        //             ->orWhere('users.user_type','Member'); 
        //                 })
        ->select('users.name','users.lastname','users.user_type','users.email','users.created_at','purchase_history.created_at as purchased_at')
        ->get();
       // dd($reportdata);
        return view('app.admin.report.dealer_view', compact('title','sub_title', 'base', 'method','reportdata','start_date','end_date'));
     }
     public function sharepartnerstockreport()
    {
        $title        = trans('report.report');
        $sub_title    = trans('menu.sharepartner_stock_management');
        $base         = trans('menu.sharepartner_stock_management');
        $method       = trans('menu.sharepartner_stock_management');

        return view('app.admin.report.sharepartner_stock', compact('title','sub_title', 'base', 'method'));
    }

    public function sharepartnerstockreportview(Request $request)
    {
        $title      = trans('report.report');
        $sub_title  = trans('menu.sharepartner_stock_management');
        $base       = trans('menu.sharepartner_stock_management');
        $method     = trans('menu.sharepartner_stock_management');
        
         if ($request->username != null || $request->autocompleteusers != null) {
         $validator = Validator::make($request->all(), [
            'start'    => 'required|date',
            'end'      => 'required|date|',
            'username' => 'exists:users',
                 ]);
        } else {
            $validator = Validator::make($request->all(), [
            'start'    => 'required|date',
            'end'      => 'required|date|',
            
          ]);
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $user_id = User::where('username', $request->username)->pluck('id');


        $stock      = StockManagement::where('stock_management.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
                    ->where('stock_management.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
                    ->join('users','users.id','stock_management.user_id')
                    ->join('share_partners','share_partners.id','stock_management.product_id')
                    ->select('stock_management.product_id','stock_management.in','stock_management.out','stock_management.balance','stock_management.created_at','share_partners.Products','users.name','users.lastname','users.id')
                    ->get();
                    // dd($stock);

                       
        $report = [] ;
        foreach ($stock as $key => $value) {

            $report[$value->id]['product'][] = $value->Products ; 
            $report[$value->id]['in'][] = $value->in ; 
            $report[$value->id]['out'][] = $value->out ; 
            $report[$value->id]['balance'][] = $value->balance ; 
            $report[$value->id]['name'] = $value->name ; 
            $report[$value->id]['lastname'] = $value->lastname ; 
            $report[$value->id]['created_at'] = $value->created_at ; 
                    
        }
      
        $company=AppSettings::find(1);
        $start_date=$request->start;
        $end_date=$request->end;

        return view('app.admin.report.sharepartner_stock_view', compact('title', 'report', 'sub_title', 'base', 'method', 'company', 'start_date', 'end_date'));
    }


}
