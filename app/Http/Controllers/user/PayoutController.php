<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Auth;
use DB;
use Input;
use Redirect;
use Session;
use Validator;
use App\Balance;
use App\Payout;
use App\User;
use App\Mail;
use App\Activity;
use App\Settings;
use App\Currency;
use App\Payoutmanagemt;
use App\payout_gateway_details;
use App\PurchaseHistory;
use App\Commission;
use DataTables;
use App\Http\Requests;
use App\Http\Requests\user\getPayoutRquestingRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\user\UserAdminController;

class PayoutController extends UserAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $se=Settings::value('payout_notification');

      
        $payment_type=Payoutmanagemt::where('status', 1)->get();
        $payment_mode=array();
        foreach ($payment_type as $key => $value) {
            $payment_mode[$key]['id']=$value->id;
            $payment_mode[$key]['payment_mode']=$value->payment_mode;
        }
        $user_balance = Balance::where('user_id', '=', Auth::user()->id)->value('balance');
        $title        = trans('payout.payout_request');
        $sub_title    = trans('payout.my_requests');
        $total_payout = Payout::where('user_id', '=', Auth::user()->id)
                                ->where('status', '=', 'released')
                                ->sum('amount');
        $total_pending = Payout::where('user_id', '=', Auth::user()->id)
                                ->where('status', '=', 'pending')
                                ->sum('amount');
        $rules = ['req_amount' => 'required'];
        
        $base = trans('payout.payout');
        $method = trans('payout.payout_request');

        $startDate = date('Y-m-1 00:00:00');
        $endDate   = date('Y-m-7 23:59:59');

        $P_monthpv = PurchaseHistory::where('user_id',Auth::user()->id)->where('created_at', '>=', $startDate)
                      ->where('created_at', '<=',$endDate)->where('type','product')->sum('total_bv');

        // dd($P_monthpv);
        return view('app.user.payout.payout_request', compact('title', 'user_balance', 'rules', 'base', 'method', 'sub_title', 'total_pending', 'total_payout', 'payment_type', 'payment_mode'));
    }

    public function data(Request $request)
    {

        $amount = 0;
        $users1 = array();
        $users2 = array();
        //echo $user_id;die();
       $users1 = Commission::select('commission.id', 'user.username', 'fromuser.username as fromuser', 'commission.payment_type', 'commission.payable_amount', 'commission.created_at', 'commission.updated_at') 
            ->join('users as fromuser', 'fromuser.id', '=', 'commission.from_id')
            ->join('users as user', 'user.id', '=', 'commission.user_id')
            ->join('profile_infos as profile', 'profile.user_id', '=', 'commission.from_id')
            // ->join('packages as pack', 'pack.id','profile.package')
            ->where('commission.user_id', '=', Auth::user()->id)
            ->orderBy('commission.id', 'desc');
       
        $users2 = Payout::select('payout_request.id', 'users.username', 'users.username as fromuser', 'payout_request.status as payment_type', 'payout_request.amount as payable_amount', 'payout_request.created_at', 'payout_request.updated_at')
            ->join('users', 'users.id', '=', 'payout_request.user_id')
            ->where('payout_request.user_id', '=', Auth::user()->id)
            ->where('payout_request.status', 'released')
            ->orderBy('payout_request.id', 'desc');

        $ewallet_count = $users1->union($users2)->orderBy('created_at', 'DESC')->get()->count();
        $users = $users1->union($users2)->orderBy('created_at', 'DESC')

            // ->offset($request->start)
            // ->limit($request->length)
            ->get();
        // dd($users);
        $binary = BinaryCommissionSettings::find(1)->pair_value;
        // $adminpackage = ProfileInfo::where('user_id',1)->join('packages as pack', 'pack.id','profile_infos.package')->select('pack.package')->first()->package;

        return DataTables::of($users)
            ->editColumn('fromuser', '@if ($payment_type =="released") Adminuser @else {{$fromuser}} @endif')
            ->editColumn('payment_type', ' @if ($payment_type =="released") Payout released @else <?php  echo ucfirst(str_replace("_", " ", "$payment_type")) ;  ?> @endif')
            ->editColumn('payable_amount', '@if($payable_amount>=0)  <span> {{currency(round($payable_amount,2))}} </span> @else  <span  style="color: red;" >{{currency(round($payable_amount,2))}}</span> @endif')         
            ->removeColumn('id')
            ->setTotalRecords($ewallet_count)
            ->escapeColumns([])
            ->make();
    }
   


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
    public function request(Request $request)
    {

        $validator = Validator::make(Input::all(), array(
            'req_amount' => 'required|numeric',
            'payment_mode' =>'required',

        ));
    

        if ($validator->fails()) {
        // get the error messages from the validator
            $messages = "Request amount is required";

        // redirect our user back to the form with the errors from the validator
            return Redirect::to('payoutrequest')
            ->withErrors($validator);
        }

        $payout_details=payout_gateway_details::find(1);
        if ($request->req_amount < $payout_details->min_payout_amount) {
            Session::flash('flash_notification', array('level'=>'error','message'=>trans('payout.amount_is_less_than_minimum_request_amount')));
             return redirect()->back();
        }

        
        $req_amount = round($request->req_amount, 2);
        $user_balance = Balance::getTotalBalance(Auth::user()->id);
        if ($req_amount <= $user_balance and $req_amount > 0 and is_numeric($request->req_amount) and $payout_details->payout_setup_admin == 2) {
            Payout::create([
                'user_id'        => Auth::user()->id,
                'amount'         => $req_amount,
                'payment_mode'   => $request->payment_mode,
                'status'         => 'pending'
            ]);
            Balance::updateBalance(Auth::user()->id, $req_amount);
            Activity::add("payout requested by ".Auth::user()->username, Auth::user()->username ." requested payout  an amount of $req_amount ");
            Session::flash('flash_notification', array('level'=>'success','message'=>trans('payout.request_completed')));
        } else {
            Session::flash('flash_notification', array('level'=>'error','message'=>trans('payout.payout_is_not_possible')));
        }
        return Redirect::action('user\PayoutController@index');
    }
    public function viewall()
    {
        $title = trans('payout.view_all_requests');
        $sub_title = trans('payout.my_requests');
        $base = trans('payout.payout');
        $method = trans('payout.my_requests');

        $data =Payout::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();

        $requests = Payout::getMyPayoutRequests();
        $USER_CURRENCY=Currency::find(8);
        $user_balance = Balance::where('user_id', '=', Auth::user()->id)->value('balance');
        $total_payout = Payout::where('user_id', '=', Auth::user()->id)
                                ->where('status', '=', 'released')
                                ->sum('amount');
        $total_pending = Payout::where('user_id', '=', Auth::user()->id)
                                ->where('status', '=', 'pending')
                                ->sum('amount');

        return view('app.user.payout.view_all_requests', compact('title', 'base', 'method', 'sub_title','data','user_balance','total_payout','total_pending'));
    }

    public function datatable()
    {
        DB::statement(DB::raw('set @rownum=0'));
        $data= DB::table('payout_request')->select(DB::raw('@rownum  := @rownum  + 1 AS rownum'),'payout_request.*','payout_request.id as payout_id')->where('user_id', Auth::id())->get();

        return DataTables::of($data)        
            ->removeColumn('id')
            ->escapeColumns([])
            ->editColumn('commissions', '<a href="{{{ URL::to(\'user/payout-details/\' . encrypt($payout_id)) }}}" class="submit-user-note btn btn-primary btn-labeled btn-labeled-right" type="button">View<b><i class="icon-circle-right2"></i></b></a>')
             ->editColumn('amount', '<span> {{currency(round($amount,2))}} </span>')
            ->make();
    }

    public function payout_details($payout_id)
    {
        $payout_id=decrypt($payout_id);
        $commission_id= Payout::find($payout_id)->commission_id;

        $data=Commission::join('users','users.id','commission.from_id')
        ->whereIn('commission.id',explode(',',$commission_id))
        ->select('users.name as from_user','commission.payment_type','commission.total_amount','commission.created_at as request_date')
        ->get();

        $title = "Payout Details";
        // $title = trans('payout.view_all_requests');
        $sub_title = trans('payout.my_requests');
        $requests = Payout::getMyPayoutRequests();
        $base = trans('payout.payout');
        $method = trans('payout.my_requests');
        $USER_CURRENCY=Currency::find(8);
        $user_balance = Balance::where('user_id', '=', Auth::user()->id)->value('balance');
        $total_payout = Payout::where('user_id', '=', Auth::user()->id)
                                ->where('status', '=', 'released')
                                ->sum('amount');
        $total_pending = Payout::where('user_id', '=', Auth::user()->id)
                                ->where('status', '=', 'pending')
                                ->sum('amount');
        return view('app.user.payout.payout_details', compact('title', 'requests', 'base', 'method', 'sub_title','USER_CURRENCY','user_balance','total_payout','total_pending','payout_id'));
    }

    public function payout_details_datatable($payout_id)
    {
        $payout= Payout::find($payout_id);

        DB::statement(DB::raw('set @rownum=0'));
        $data=Commission::join('users','users.id','commission.from_id')
        ->whereIn('commission.id',explode(',',$payout->commission_id))
        ->select(DB::raw('@rownum  := @rownum  + 1 AS rownum'),'users.name as from_user','commission.payment_type','commission.total_amount','commission.created_at as request_date')  
        ->get();

        return DataTables::of($data)        
            ->removeColumn('id')
            ->escapeColumns([])
            ->editColumn('payment_type', '<?php  echo ucfirst(str_replace("_", " ", "$payment_type")) ;  ?> ')
            ->editColumn('total_amount', '<span> {{currency(round($total_amount,2))}} </span>')
            ->make();
    }

    public function reg()
    {
        $title = trans('payout.view_all_requests');
        return view('app.user.payout.reg', compact('title', 'requests'));
    }
    public function getpayout()
    {
        $details = Payout::getUserPayoutDetails();
        print_r($details);
    }
}
