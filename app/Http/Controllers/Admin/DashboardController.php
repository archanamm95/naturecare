<?php namespace App\Http\Controllers\Admin;

use App\Balance;
use App\Http\Controllers\Admin\AdminController;
use App\Mail;
use App\Payout;
use App\PointTable;
use App\ProfileInfo;
use App\Sponsortree;
use App\PurchaseHistory;
use App\Packages;
use App\User;
use App\Voucher;
use App\Emails;
use App\AppSettings;
use App\PendingTransactions;
use App\PendingCommission;
use App\Commission;
use App\PoolHistory;
use App\Tree_Table;
use App\Ranksetting;
use App\Settings;
use Auth;
use DB;
use Carbon;
use Crypt;
use App\Jobs\SendEmail;

// use Mail;
use App\Activity;
use App\Models\Helpdesk\Ticket\Ticket;

use Illuminate\Http\Request;

class DashboardController extends AdminController
{

    public function index()
    {   

        $title     = trans('dashboard.dashboard');
        $sub_title = trans('dashboard.your-dashboard');
     /*........................downline_members..............*/
        $list_total_users    = User::where('admin', '!=', 1)->where('user_type','!=','Customer')->get(); 
        $total_users         = $list_total_users->count(); 
     /*.....................end downline_members..............*/
     
    /*........................members income..............*/
        $commission = Commission::where('user_id','>',1)->get();
        $total_amount=round($commission->sum('total_amount'), 2);
        $per_payout  = Payout::getPayoutPercentage();

      /*........................end members income...............*/

      /*........................package sale...............*/
        $total_sales =PurchaseHistory::where('type','Packages')->where('pay_by','!=','register_point')->sum('total_amount');
      /*........................end package sale................*/


      /*........................commission details................*/
        $payment = [];

            $payment['referral_bonus']   = $commission->where('payment_type','referral_bonus')->sum('total_amount');
            $payment['sales_bonus']      = $commission->where('payment_type','sales_bonus')->sum('total_amount');
            $payment['leadership_bonus'] = $commission->where('payment_type','leadership_bonus')->sum('total_amount');
            $payment['cashback_bonus']   = $commission->where('payment_type','cashback_bonus')->sum('total_amount');
            // $level_bonus                 = $commission->where('payment_type', 'LIKE', 'level_%')->sum('total_amount');

        $level_bonus=Commission::where('user_id','>',1)->where('payment_type', 'LIKE', 'level_%')->sum('total_amount');

        /*........................end commission details................*/

        /*........................current month details................*/

        $pending_commission=round(PendingCommission::where('payment_status','no')->where('pending_commissions.user_id','>',1)->sum('total_amount'), 2);
        $nonMaintainMembers=$list_total_users->where('status', 'inactive')->count();
        $maintain_member   = $list_total_users->where('status', 'active')->pluck('id');

        // $nonMaintainMembersIncome = Commission::whereNotIn('user_id',$maintain_member)->where('id','>',1)->sum('total_amount');

        /*........................end current month details................*/

        /*........................widget link................*/

        $secret             = base64_encode(Auth::user()->username);

        /*........................end widget link................*/

        /*........................graph joined datails................*/

       // $total_sales,$total_users

        /*........................end graph joined datails................*/

        /*........................list top users................*/

        $top_recruiters = ProfileInfo::select(array('users.id', 'users.name', 'users.username', 'country','image','profile','cover', 'users.email', 'users.created_at',DB::raw('COUNT(sponsortree.sponsor) as count')))
                          ->join('sponsortree', 'sponsortree.sponsor','profile_infos.user_id')
                          ->orderBy('count', 'desc')->take(5)
                          ->join('users', 'users.id','profile_infos.user_id')
                          ->where('users.user_type','!=','Customer')
                          ->where('sponsortree.type', '<>', 'vaccant')
                          ->where('sponsortree.sponsor', '<>', 0)
                          ->groupBy('sponsortree.sponsor')
                          ->get();

        /*........................end list top users................*/ 

        /*........................recent plan top up................*/                  


        $recent    = PurchaseHistory::orderBy('purchase_history.id', 'desc')->take(5)
                        ->join('users', 'users.id', 'purchase_history.user_id')
                        ->join('users as sponsor','sponsor.id','purchase_history.seller_id')
                        ->select('purchase_history.*', 'users.username','sponsor.username as sponsorusername',DB::raw('SUM(purchase_history.count) as count'))
                        ->groupBy('purchase_history.invoice_id')
                        ->get();

         /*........................end recent plan top up................*/ 

        /*........................new registered user................*/ 

        $new_users = ProfileInfo::orderBy('created_at', 'desc')->take(12)
              ->select(array('users.id', 'users.name', 'users.username', 'country','image','profile','cover', 'users.email', 'users.created_at'))
              ->join('users', 'users.id', 'profile_infos.user_id')
              ->where('admin', '<>', 1)
              ->where('users.user_type','!=','Customer')
              ->get();

        $count_new = count($new_users);
        
         /*........................end new registered user................*/ 

         /*........................recent activities................*/ 

        // $all_activities = User::select(array('users.id', 'name', 'username', 'activity_log.description', 'email', 'users.created_at'))
        //       ->join('activity_log', 'activity_log.user_id', '=', 'users.id')
        //       ->where('admin', '<>', 1)
        //       ->where('user_type','!=','Customer')
        //       ->orderBy('created_at', 'DESC')->take(15)->get();
        $all_activities = Activity::select(array('users.id', 'name', 'username', 'activity_log.description', 'email', 'activity_log.created_at'))
              ->join('users', 'users.id', '=', 'activity_log.user_id')
              ->where('users.admin', '<>', 1)
              ->where('users.user_type','!=','Customer')
              ->orderBy('activity_log.created_at', 'DESC')->take(15)->get();

        /*........................end recent activities................*/ 


        return view('app.admin.dashboard.index', compact('title','total_users','total_amount','per_payout','total_sales','top_recruiters','recent','count_new','new_users','all_activities','sub_title','maintain_member','payment','level_bonus','pending_commission','nonMaintainMembers','secret'));
    }


       /**
     * Fetching dashboard graph data to implement graph.
     *
     * @return type Json
     */
    public function ChartData($date111 = '', $date122 = '')
    {
        $date11 = strtotime($date122);
        $date12 = strtotime($date111);
        if ($date11 && $date12) {
            $date2 = $date12;
            $date1 = $date11;
        } else {
            // generating current date
            $date2 = strtotime(date('Y-m-d'));
            $date3 = date('Y-m-d');
            $format = 'Y-m-d';
            // generating a date range of 1 month
            $date1 = strtotime(date($format, strtotime('-1 month'.$date3)));
        }
        $return = '';
        $last = '';
        for ($i = $date1; $i <= $date2; $i = $i + 86400) {
            $thisDate = date('Y-m-d', $i);

            $created = \DB::table('tickets')->select('created_at')->where('created_at', 'LIKE', '%'.$thisDate.'%')->count();
            $closed = \DB::table('tickets')->select('closed_at')->where('closed_at', 'LIKE', '%'.$thisDate.'%')->count();
            $reopened = \DB::table('tickets')->select('reopened_at')->where('reopened_at', 'LIKE', '%'.$thisDate.'%')->count();

            $value = ['date' => $thisDate, 'open' => $created, 'closed' => $closed, 'reopened' => $reopened];
            $array = array_map('htmlentities', $value);
            $json = html_entity_decode(json_encode($array));
            $return .= $json.',';
        }
        $last = rtrim($return, ',');

        return '['.$last.']';

        // $ticketlist = DB::table('tickets')
        //     ->select(DB::raw('MONTH(updated_at) as month'),DB::raw('SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as closed'),DB::raw('SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) as reopened'),DB::raw('SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as open'),DB::raw('SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) as deleted'),
        //         DB::raw('count(*) as totaltickets'))
        //     ->groupBy('month')
        //     ->orderBy('month', 'asc')
        //     ->get();
        // return $ticketlist;
    }


    public function getGenderJson()
    {

            $male_users_count  = ProfileInfo::where('user_id', '<>', 1)->where('gender', 'm')->count();
            $female_users_count  = ProfileInfo::where('user_id', '<>', 1)->where('gender', 'f')->count();
            return response()->json(
                [[
                'gender' => 'Male',
                "value"=> $male_users_count,
                "color"=> "#66BB6A"
                ],
                [
                'gender' => 'Female',
                "value" => $female_users_count,
                "color"=>"#EF5350"
                ]],
                200
            );
    }


    public function getUsersJoiningJson(Request $request)
    {

        $today = Carbon\Carbon::today();
      // $table->whereBetween('date', [$today->startOfMonth(), $today->endOfMonth])->count();


         // this week results
        $fromDate = Carbon\Carbon::now()->subDay()->startOfWeek()->toDateString(); // or ->format(..)
        $tillDate = Carbon\Carbon::now()->subDay()->toDateString();


        $duration = strtotime('-365 days');

        if (isset($request->period)) {
            if ($request->period === 'today') {
               // this week results
              // $fromDate = Carbon\Carbon::today(); // or ->format(..)
              // $tillDate = Carbon\Carbon::tomorrow();

                $users = DB::table('users')
                ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as date'), DB::raw('count(*) as value'))
                // ->whereBetween( DB::raw('created_at'), [$fromDate, $tillDate] )
                ->whereDate('created_at', '>=', date('Y-m-d 00:00:00'))
                ->where('admin', '!=', 1)
                ->where('user_type','!=','Customer')
                ->orderBy('date', 'asc')
                ->where('id', '>', '1')
                ->groupBy('date')
                // ->take(15)
                ->get();
                return response()->json($users);
            } elseif ($request->period === 'week') {
               // this week results
              // $fromDate = Carbon\Carbon::now()->subDay()->startOfWeek()->toDateString(); // or ->format(..)
              // $tillDate = Carbon\Carbon::now()->subDay()->toDateString();
                $duration = date('Y-m-d 00:00:00',strtotime('-7 days'));
            } elseif ($request->period === 'month') {
              // this week results
              // $fromDate = Carbon\Carbon::now()->subDay()->startOfMonth()->toDateString(); // or ->format(..)
              // $tillDate = Carbon\Carbon::now()->subDay()->toDateString();
                $duration = date('Y-m-01 00:00:00');
            } elseif ($request->period === 'year') {
              // this week results
              // $fromDate = Carbon\Carbon::now()->subDay()->startOfYear()->toDateString(); // or ->format(..)
              // $tillDate = Carbon\Carbon::now()->subDay()->toDateString();
                $duration = date('Y-01-01 00:00:00');
            }
        }
      

        $users = DB::table('users')
          ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as date'), DB::raw('count(*) as value'))
          // ->whereBetween( DB::raw('DATE(created_at)'), [$fromDate, $tillDate] )
          ->whereDate('created_at', '>=', $duration)
          ->orderBy('date', 'asc')
          ->groupBy('date')
          ->where('admin', '!=', 1)
          ->where('user_type','!=','Customer')
          // ->take(15)
          ->get();
          return response()->json($users);

        // $users = DB::table('users')
        //   ->select(DB::raw('DATE(created_at) as date'),DB::raw('count(*) as value'))
        //   ->orderBy('date', 'asc')
        //   ->groupBy('date')

        //   // ->take(30)
        //   ->whereDate('created_at', '<=', Carbon::today())
        //   ->whereDate('created_at', '<', $duration)
        //   ->get();
          // return response()->json($users);
    }

    public function getUsersWeeklyJoiningJson()
    {

        // this week results
        $fromDate = Carbon\Carbon::now()->subDay()->startOfWeek()->toDateString(); // or ->format(..)
        $tillDate = Carbon\Carbon::now()->subDay()->toDateString();


        $users = DB::table('users')
          ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as value'))
          ->whereBetween(DB::raw('DATE(created_at)'), [$fromDate, $tillDate])
          ->orderBy('date', 'asc')
          ->groupBy('date')
          // ->take(15)
          ->get();
          return response()->json($users);
    }

    public function getUsersMonthlyJoiningJson()
    {

        // this week results
        $fromDate = Carbon\Carbon::now()->subDay()->startOfMonth()->toDateString(); // or ->format(..)
        $tillDate = Carbon\Carbon::now()->subDay()->toDateString();


        $users = DB::table('users')
          ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as value'))
          ->whereBetween(DB::raw('DATE(created_at)'), [$fromDate, $tillDate])
          ->orderBy('date', 'asc')
          ->groupBy('date')
          // ->take(15)
          ->get();
          return response()->json($users);
    }

    public function getUsersYearlyJoiningJson()
    {

        // this week results
        $fromDate = Carbon\Carbon::now()->subDay()->startOfYear()->toDateString(); // or ->format(..)
        $tillDate = Carbon\Carbon::now()->subDay()->toDateString();


        $users = DB::table('users')
          ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as value'))
          ->whereBetween(DB::raw('DATE(created_at)'), [$fromDate, $tillDate])
          ->orderBy('date', 'asc')
          ->groupBy('date')
          // ->take(15)
          ->get();
          return response()->json($users);
    }




    public function getPackageSalesJson()
    {


        $graph=array();
        $pack=Packages::select('id', 'package')->get();
        $data=PurchaseHistory::distinct()->select(DB::raw('DATE(created_at) as date'))->orderBy('created_at', 'asc')->get();
        foreach ($data as $key => $date) {
            $graph['dates'][]=$date->date;

            foreach ($pack as $key => $value) {
                $graph[$value->id]['pack']=$value->package;
                $graph[$value->id]['purchase_count'][]=PurchaseHistory::where('created_at', 'LIKE', '%'.$date->date.'%')->where('package_id', $value->id)->where('type','package')->count();
            }
        }
        return response()->json($graph);
    }

    


    /**
     * Fetching tickets
     *
     * @return type Json
     */
    public function TicketsStatusJson($date111, $date122)
    {
        
        // $date11 = date('Y-m-d', $date122);
        // $date12 =date('Y-m-d', $date111);

        // dd(date('m/d/Y', $date111));

        $date11 = strtotime($date111);
        $date12 = strtotime($date122);
        // dd($date111);

        // dd(strtotime(date('Y-m-d', strtotime('-1 month'.date('Y-m-d')))));

        if ($date11 && $date12) {
            $date2 = $date12;
            $date1 = $date11;
        } else {
            // generating current date
            $date2 = strtotime(date('Y-m-d'));
            $date3 = date('Y-m-d');
            $format = 'Y-m-d';
            // generating a date range of 1 month
            $date1 = strtotime(date($format, strtotime('-1 month'.$date3)));
        }
        $return = '';
        $last = '';
        for ($i = $date1; $i <= $date2; $i = $i + 86400) {
            $thisDate = date('Y-m-d', $i);

            $created = \DB::table('tickets')->select('created_at')->where('created_at', 'LIKE', '%'.$thisDate.'%')->count();
            $closed = \DB::table('tickets')->select('closed_at')->where('closed_at', 'LIKE', '%'.$thisDate.'%')->count();
            $reopened = \DB::table('tickets')->select('reopened_at')->where('reopened_at', 'LIKE', '%'.$thisDate.'%')->count();

            $value = ['date' => $thisDate, 'open' => $created, 'closed' => $closed, 'reopened' => $reopened];
            $array = array_map('htmlentities', $value);
            $json = html_entity_decode(json_encode($array));
            $return .= $json.',';
        }
        $last = rtrim($return, ',');

        return '['.$last.']';

        // $ticketlist = DB::table('tickets')
        //     ->select(DB::raw('MONTH(updated_at) as month'),DB::raw('SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as closed'),DB::raw('SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) as reopened'),DB::raw('SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as open'),DB::raw('SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) as deleted'),
        //         DB::raw('count(*) as totaltickets'))
        //     ->groupBy('month')
        //     ->orderBy('month', 'asc')
        //     ->get();
        // return $ticketlist;
    }


    public function getmonthusers()
    {

        for ($i = 1; $i <= 12; $i++) {
            echo $count = User::whereMonth('created_at', '=', $i)->whereYear('created_at', '=', date('Y'))->count();
            echo ",";
        }
    }

    public function bitaps(Request $request, $paymentid)
    {
        $item = PendingTransactions::where('id', $paymentid)->first();

        
        if (is_null($item)) {
            return response()->json(['valid' => false]);
        } elseif ($item->payment_status == 'finish') {
            $user_id=User::where('username', $item->username)->value('id');
            if ($user_id <> null) {
                return response()->json(['valid' => true,'status'=>$item->payment_status,'id'=>Crypt::encrypt($user_id)]);
            }
        } else {
            return response()->json(['valid' => true,'status'=>$item->payment_status,'id'=>null]);
        }
        
        return response()->json(['valid' => false]);
    }

    public function bitapspreview(Request $request, $transid)
    {
        $title  = trans('dashboard.bitaps_preview');
        $base=trans('dashboard.bitaps_preview');
        $method=trans('dashboard.bitaps_preview');
        $sub_title=trans('dashboard.bitaps_preview');

        return view('app.admin.dashboard.bitapspreview', compact('title', 'base', 'method', 'sub_title'));
    }
    public function getCompanyPoolJson(Request $request){
      if (isset($request->period)) {
            if ($request->period === 'today') {
              $fromDate = Carbon\Carbon::today()->toDateString();
            } elseif ($request->period === 'week') {
              $fromDate = Carbon\Carbon::now()->subDay()->startOfWeek()->toDateString();
            } elseif ($request->period === 'month') {
              $fromDate = Carbon\Carbon::now()->subDay()->startOfMonth()->toDateString(); // or ->format(..)
            } elseif ($request->period === 'year') {
              $fromDate = Carbon\Carbon::now()->subDay()->startOfYear()->toDateString(); // or ->format(..)
            }
        }
        $company_pool = PurchaseHistory::whereDate('created_at', '>=', date('Y-m-d 00:00:00', strtotime($fromDate)))->where('type','product')->where('pay_by','!=','register_point')->where('shipping_country','MY')->sum('total_bv')*(25/100);

        return response()->json($company_pool);
    }
    public function getLeadershipPoolJson(Request $request)
    {
        if (isset($request->period)) {
            if ($request->period === 'today') {
              $fromDate = Carbon\Carbon::today()->toDateString();
            } elseif ($request->period === 'week') {
              $fromDate = Carbon\Carbon::now()->subDay()->startOfWeek()->toDateString();
            } elseif ($request->period === 'month') {
              $fromDate = Carbon\Carbon::now()->subDay()->startOfMonth()->toDateString(); // or ->format(..)
            } elseif ($request->period === 'year') {
              $fromDate = Carbon\Carbon::now()->subDay()->startOfYear()->toDateString(); // or ->format(..)
            }
        }
        $leadership_pool = PurchaseHistory::whereDate('created_at', '>=', date('Y-m-d 00:00:00', strtotime($fromDate)))->where('pool_status','no')->where('type','product')->where('pay_by','!=','register_point')->where('shipping_country','MY')->sum('total_bv')*(Settings::find(1)->service_charge/100);

        return response()->json($leadership_pool);
    }
    public function getInternationalPoolJson(Request $request){
      if (isset($request->period)) {
            if ($request->period === 'today') {
              $fromDate = Carbon\Carbon::today()->toDateString();
            } elseif ($request->period === 'week') {
              $fromDate = Carbon\Carbon::now()->subDay()->startOfWeek()->toDateString();
            } elseif ($request->period === 'month') {
              $fromDate = Carbon\Carbon::now()->subDay()->startOfMonth()->toDateString(); // or ->format(..)
            } elseif ($request->period === 'year') {
              $fromDate = Carbon\Carbon::now()->subDay()->startOfYear()->toDateString(); // or ->format(..)
            }
        }
        $international_pool = PurchaseHistory::whereDate('created_at', '>=', date('Y-m-d 00:00:00', strtotime($fromDate)))->where('pool_status','no')->where('type','product')->where('pay_by','!=','register_point')->where('shipping_country','!=','MY')->sum('total_bv');

        return response()->json($international_pool);
    }
    public function weeklyMaintain(Request $request){
      $weeklyMaintainMembers  = User::where('weekly_payout','yes')->pluck('id')->toArray();
      $start = new Carbon('first day of this month');
      $startDate = date('Y-m-d 00:00:00',strtotime($start));
      if (isset($request->period)) {
            if ($request->period === 'week1') {
                $endDate   = date('Y-m-d 00:00:00',strtotime("+7 day", strtotime($startDate)));
            } elseif ($request->period === 'week2') {
                $startDate = date('Y-m-d 00:00:00',strtotime("+7 day", strtotime($startDate)));
                $endDate   = date('Y-m-d 00:00:00',strtotime("+7 day", strtotime($startDate)));
            } elseif ($request->period === 'week3') {
                $startDate = date('Y-m-d 00:00:00',strtotime("+14 day", strtotime($startDate)));
                $endDate   = date('Y-m-d 00:00:00',strtotime("+7 day", strtotime($startDate)));
            } elseif ($request->period === 'week4') {
                $startDate = date('Y-m-d 00:00:00',strtotime("+21 day", strtotime($startDate)));
                $end       = new Carbon('last day of this month');
                $endDate   = date('Y-m-d 00:00:00',strtotime($end));
            }
        }
        else{
            $start = new Carbon('last day of this month');
            $endDate = date('Y-m-d 00:00:00',strtotime($start));
        }
        $weeklyMaintainMembersIncome = Commission::where('created_at', '>', $startDate)->where('created_at', '<',$endDate)
                                                 ->wherein('user_id',$weeklyMaintainMembers)->sum('total_amount');

        $data = currency($weeklyMaintainMembersIncome);
        return response()->json($data);
    }
}