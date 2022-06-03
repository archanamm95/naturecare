<?php
namespace App\Http\Controllers\admin;

use App\Balance;
use App\Commission;
use App\Country;
use App\DirectSposnor;
use App\Helpers\Thumbnail;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\DeleteRequest;
use App\Http\Requests\Admin\UserEditRequest;
use App\Http\Requests\Admin\UserRequest;
use App\LeadershipBonus;
use App\Settings;
use App\Packages;
use App\PointTable;
use App\ProfileInfo;
use App\PurchaseHistory;
use App\RsHistory;
use App\Sponsortree;
use App\SponsorChangeHistory;
use App\Tree_Table;
use App\Emails;
use App\AppSettings;
use App\Mail;
use App\User;
use App\Voucher;
use App\News;
use App\EventVideos;
use App\PoolHistory;
use Auth;
use Datatables;
use Carbon;
use DB;
use Illuminate\Http\Request;
use Input;
use Redirect;
use Response;
use Session;
use Validator;
use App\Activity;
use App\Payout;
use Crypt;
use CountryState;
use App\Ranksetting;
use App\Transactions;
use App\PendingTransactions;
use Storage;
use App\VoucherRequest;
use App\Payoutmanagemt;
use App\payout_gateway_details;
use App\Hyperwallet;

class UserController extends AdminController
{

    /*
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        // Show the page
        $title     = trans('users.users');
        $sub_title = trans('users.users');
        $base      = trans('users.users');
        $method    = trans('users.view_all');
        // $unread_count  = Mail::unreadMailCount(Auth::id());
        // $unread_mail  = Mail::unreadMail(Auth::id());
        // $userss = User::getUserDetails(Auth::id());

        // $user = $userss[0];

        // $userss = User::getUserDetails(Auth::id());


        //     $user = $userss[0];

    
        // return view('app.admin.users.index',  compact('title','user','sub_title','base','method','profile_infos'));
        return view('app.admin.users.index', compact('title', 'sub_title', 'base', 'method'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        return view('app.admin.users.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate(UserRequest $request)
    {

        $user                    = new User();
        $user->name              = $request->name;
        $user->username          = $request->username;
        $user->email             = $request->email;
        $user->password          = bcrypt($request->password);
        $user->confirmation_code = str_random(32);
        $user->confirmed         = $request->confirmed;
        $user->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function getEdit()
    {

        $title     = trans('users.change_password');
        $sub_title = trans('users.change_password');
        $base      = trans('users.change_password');
        $method    = trans('users.change_password');

        $userss   = User::getUserDetails(Auth::id());
        $user     = $userss[0];
        $users    = User::where('id', '>', 1)->get();
        $packages = Packages::all();

        return view('app.admin.users.create_edit', compact('title', 'base', 'method', 'sub_title', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function postEdit(UserEditRequest $request)
    {
        $user                 = User::find(User::userNameToId($request->username));
        $password             = $request->password;
        $passwordConfirmation = $request->password_confirmation;

        if (!empty($password) && $user->id > 1) {
            if ($password === $passwordConfirmation) {
                $user->password = bcrypt($password);
            }
        }
        $user->save();

        Session::flash('flash_notification', array('message' => trans('users.password_has_been_changed'), 'level' => 'success'));

        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function change_transaction_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username1' => 'required',
            'transaction_password'   => 'required|alpha_num|min:6',
            
        ], ['username1.required' => 'username is required']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $user=$request->username1;
            $user_id = User::where('username', $user)->value('id');
            $users = User::find($user_id);
            $password=$request->transaction_password;
            $confirm_password =$request->tpassword_confirmation ;
           
            if ($password == $confirm_password) {
                $users->transaction_pass = $password;
                $users->save();
                Session::flash('flash_notification', array('message' => trans('users.transaction_password_has_been_changed'), 'level' => 'success'));
            } else {
                Session::flash('flash_notification', array('message' => trans('users.password_doesnt_match'), 'level' => 'error'));
            }
            return redirect()->back();
        }
    }

    public function getDelete($id)
    {
        $user = User::find($id);
        // Show the page
        return view('app.admin.users.delete', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function postDelete(DeleteRequest $request, $id)
    {
        $user = User::find($id);
        $user->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data(Request $request)
    {
        
        DB::statement(DB::raw('set @rownum=0'));
        $user_count = User::where('admin', '<>', 1)->where('user_type','!=','Customer')->count();
        // $users = User::select(array('users.id','users.name','users.username','packages.package','users.email', 'users.created_at'))
        // ->join('packages','packages.id','=','users.package')->where('admin','<>',1)

        // $users = ProfileInfo::select(array(DB::raw('@rownum  := @rownum  + 1 AS rownum'),'users.id','users.lastname', 'users.name', 'users.username', 'packages.package', 'users.email', 'users.created_at','users.active','users.confirmed','sponsor.username as sponsor','placement.username as placement_under','tree_table.leg as position'))
        //         ->join('users', 'users.id','profile_infos.user_id')
        //         ->join('users as sponsor', 'sponsor.id','users.sponsor_id')
        //         ->join('tree_table', 'tree_table.user_id','profile_infos.user_id')
        //         ->join('users as placement', 'placement.id','tree_table.placement_id')
        //         ->join('packages', 'packages.id', '=', 'profile_infos.package')
        //         ->orderBy('users.created_at','desc')
        //         ->where('users.admin', '<>', 1)
        //         ->get();
        $users = User::select(array(DB::raw('@rownum  := @rownum  + 1 AS rownum'),'users.id','users.lastname', 'users.name', 'users.username', 'users.email', 'users.user_type', 'users.created_at','users.active','users.confirmed','users.sponsor_id as sponsor'))
                ->join('profile_infos', 'profile_infos.user_id','users.id')
                ->where('users.id','>','1')
                ->where('users.user_type','!=','Customer')
                ->orderBy('users.created_at','desc')
                ->get();
        foreach ($users as $key => $value) {
          $value->sponsor = User::find($value->sponsor)->username;
          // $tree = Tree_Table::where('user_id',$value->id)->first();
          // $value->placement_under = User::find($tree->placement_id)->username;
          // $value->position = $tree->leg ;
        }

        return DataTables::of($users)
            // ->editColumn('created_at', '{{ date("d-m-Y",strtotime($created_at)) }}')
            ->addColumn('actions', '<div class="list-icons">
                      <div class="list-icons-item dropdown">
                        <a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform;top: 0px;left: 0px;transform: translate3d(-164px, 16px, 0px);">
                           @if ($id!="1")
                          <a href="{{{ URL::to(\'admin/userprofiles/\' . $username . \'#update\' ) }}}" class="dropdown-item"><i class="fa fa-eye"></i>{{trans("users.view")}}</a><div class="dropdown-divider"></div><br>@endif
                          <a href="{{{ URL::to(\'admin/users/\' . $id . \'/userlogin\' ) }}}" class="dropdown-item"><i class="fa fa-sign-in" aria-hidden="true"></i>{{trans("users.impersonate")}}</a>
                        
                        </div>
                      </div>
                    </div>')

             ->setTotalRecords($user_count)
             ->escapeColumns([])
             ->make();
    }

    public function approvePaymentsData()
    {

        DB::statement(DB::raw('set @rownum=0'));
        $payment_data_count = PendingTransactions::where('payment_status', 'pending')->where('payment_method','bankwire')->count();
        $payment_data = PendingTransactions::select(array(DB::raw('@rownum  := @rownum  + 1 AS rownum'),'pending_transactions.id','order_id', 'sp.username as sponsor', 'pending_transactions.email','pending_transactions.payment_type as check','pending_transactions.payment_method as payment_type','amount','pending_transactions.created_at','invoice','pending_transactions.request_data'))
                      ->join('users as sp', 'sp.username', '=', 'pending_transactions.sponsor')
                      ->where('payment_status', 'pending')
                      ->where('payment_method','bankwire')
                      ->get();

        return DataTables::of($payment_data)
          ->addColumn('actions', '<div class="list-icons">
                      <div class="list-icons-item dropdown">
                      <a href="#" class="list-icons-item" data-toggle="dropdown"><i 
                      class="icon-menu7"></i></a>
                      <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end"
                      style="position: absolute; will-change: transform;top: 0px;left:
                      0px;transform: translate3d(-164px, 16px, 0px);">
                        
                      <a href="{{{ URL::to(\'admin/approve/\' . $id ) }}}" class="dropdown-item"><i 
                      class="fa fa-check" aria-hidden="true" style="color:green"></i>
                      {{trans("users.approve")}}</a><div class="dropdown-divider"></div><br>
                   
                       <a  data-id="{{$id}}" href="{{{ URL::to(\'admin/delete_approve/\' . $id) }}}"  class="dropdown-item approvepayment" > <i class="fa fa-times" aria-hidden="true" style="color:red"></i></i> {{trans("payout.reject")}}  </a>
                        
                      
                        </div>
                      </div>
                    </div>')

        ->editColumn('amount','{{currency($amount)}}')
        // ->editColumn('placement_under','@php isset(json_decode($request_data)->placement_user) ? json_decode($request_data)->placement_user : "-" @endphp')
        // ->editColumn('position','@php isset(json_decode($request_data)->leg) ? json_decode($request_data)->leg : "-" @endphp')
        ->editColumn('placement_under','@if($check == "dummy_reg" || $check == "register"){{json_decode($request_data)->placement_user}} @endif')
        ->editColumn('position','@if($check == "dummy_reg" || $check == "register"){{json_decode($request_data)->leg}} @endif')
        ->editColumn('payment_type','{{ucwords(str_replace("_"," ",$payment_type))}}')
        ->editColumn('invoice', ' 

             
              <!-- Trigger the modal with a button -->

        <button type="button"  class="btn btn-default" data-toggle="modal" data-target="#myModal{{$id}}"><svg class="feather"><use xlink:href="/backend/icons/feather/feather-sprite.svg#eye" /></svg></button>

      <!-- Modal -->

        <div id="myModal{{$id}}" class="modal fade" role="dialog">
        <div class="modal-dialog">

      <!-- Modal content-->

        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <div class="modal-body" style="overflow: auto !important;">

       <center> 

        <embed src="{{\'/uploads/documents/\'.$invoice}}" style="width:400px; height:auto;" frameborder="0">
      
        </center>


        </div>                 
        </form>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>
        </div>
        </div>
        <script type="text/javascript">

        $("#myModal{{$id}}").on("hidden.bs.modal", function () {
        oTable.ajax.reload();
        })
        </script>

              ')
        ->addColumn('download', ' <a href="{{\'/admin/download_id/\'.$invoice}}" class="btn btn-success btn-md" target="_blank"><svg class="feather"><use xlink:href="/backend/icons/feather/feather-sprite.svg#download" /></svg> </a> 
          <button type="button"  class="btn btn-info" data-toggle="modal" data-target="#myModal2{{$id}}"><svg class="feather"><use xlink:href="/backend/icons/feather/feather-sprite.svg#edit" /></svg></button>
          <form class="form-vertical" action="{{url(\'admin/edit/paymnetslip\')}}" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="id" value={{$id}}>
          {!! csrf_field() !!}
            <!-- Modal -->
            <div id="myModal2{{$id}}" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body" style="overflow: auto !important;">
                    <div class="row">
                      <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-8">
                          <div class="row">
                            <span class="col-form-label" style="text-align: unset!important;font-weight: bold;"">Banking slip</span>
                            <span class="col-form-label" style="font-size: 80%;font-weight: 400"> ( doc,docx,pdf,jpeg,png,jpg {{trans(\'ticket_config.files_only\')}} )</span>
                          </div>                                                    
                          <div class="row">
                            <input id="bank_file" name="bank_file" type="file" required multiple class="file-loading" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain,application/pdf,image/jpg, image/jpeg, image/png">
                          </div>
                        </div>                                                   
                      </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-8">
                            <button class="btn btn-info btn-lg" role="button">Upload</button>
                        </div>
                    </div>
                  </div>                 
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
        </form>
        <script type="text/javascript">

        $("#myModal{{$id}}").on("hidden.bs.modal", function () {
        oTable.ajax.reload();
        })
        </script>') 
        ->setTotalRecords($payment_data_count)
        ->escapeColumns([])
        ->make();
    }

    public function deactivateUser(Request $request)
    {
      // dd($request->all());
 
         User::where('username', '=', $request->username)->update(['active'=>'no']);
         Session::flash('flash_notification', array('message' => "User deactivated Successfully", 'level' => 'success'));
         return redirect()->back();
    }



    public function activateUser($user)
    {
   
        User::where('username', '=', $user)->update(['active'=>'yes']);
        Session::flash('flash_notification', array('message' => "User activated Successfully", 'level' => 'success'));
        return redirect()->back();
    }
    public function email_confirm($id)
    {
   
        User::where('id', '=', $id)->update(['confirmed'=>1]);
        Session::flash('flash_notification', array('message' => "Email Confirmed Successfully", 'level' => 'success'));
        return redirect()->back();
    }

    
    public function viewprofile($user = 'NatureCare')
    {

        
        $title     = trans('users.member_profile');
        $sub_title = trans('users.view_all');
        $base = trans('users.view_all');
        $method = trans('users.view_all');



        if ($user) {
            $user_id = User::where('username', $user)->value('id');
            if ($user_id != null) {
                Session::put('prof_username', $user);
            }
        } else {
            $user_id = Auth::id();
            Session::put('prof_username', Auth::user()->username);
        }


        $user_id = $user_id;

        $selecteduser = User::with('profile_info')->find($user_id);
        // dd($selecteduser);
        $profile_infos = ProfileInfo::with('images')->where('user_id', $user_id)->first();
        $profile_photo = isset($profile_infos->profile)?$profile_infos->profile:'avatar-big.png';
        
        //if (!Storage::disk('images')->exists($profile_photo)){
        //    $profile_photo = 'avatar-big.png';
        //}

        if (!$profile_photo) {
            $profile_photo = 'avatar-big.png';
        }

        $cover_photo = isset($profile_infos->cover)?$profile_infos->cover:'cover.jpg';

        if (!Storage::disk('images')->exists($cover_photo)) {
            $cover_photo = 'cover.jpg';
        }

        if (!$cover_photo) {
            $cover_photo = 'cover.jpg';
        }
       

        $referals = User::select('users.*')->join('sponsortree', 'sponsortree.user_id', '=', 'users.id')->where('sponsortree.sponsor', $user_id)->get();
        $Hyperwallet=Payoutmanagemt::where('payment_mode', 'Hyperwallet')->value('status');
        $paypal=Payoutmanagemt::where('payment_mode', 'Paypal')->value('status');
        $Bitaps=Payoutmanagemt::where('payment_mode', 'Bitaps')->value('status');
        $Manual_Bank=Payoutmanagemt::where('payment_mode', 'Manual/Bank')->value('status');

      
        $total_referals = count($referals);
        $base           = trans('users.profile');
        $method         = trans('users.profile_view');

        $referrals      = Sponsortree::getMyReferals($user_id);

        $balance         = Balance::getTotalBalance($user_id);
        //$vouchers        = Voucher::getAllVouchers();
        $vouchers        = Voucher::where('user_id', 0)->get();
        $voucher_count   = count($vouchers);
        $mails           = Mail::getMyMail($user_id);
        $mail_count      = count($mails);
        $referrals_count = $total_referals;
        $sponsor_id      = Sponsortree::getSponsorID($user_id);
        $sponsor      = User::with('profile_info')->where('id', $sponsor_id)->first();
         //$voucher_count  = //VoucherRequest::where('user_id',$user_id)
        //                                 ->where('status','complete')
        //                                 ->sum('count');


        // $left_bv         = PointTable::where('user_id', '=', $user_id)->value('left_carry');
        // $right_bv = PointTable::where('user_id', '=', $user_id)->value('right_carry');
        $total_payout = Payout::where('user_id', '=', $user_id)->sum('amount');
        

        // $user_package    = Packages::where('id', $selecteduser->profile_info->package)->value('package');
        // $user_rank = Ranksetting::getUserRank($user_id);
        // $user_rank_name = Ranksetting::idToRankname($user_rank);
    

        $countries = Country::all();

// dd($selecteduser);
        $userCountry = $selecteduser->profile_info->country;
        if ($userCountry) {
            $countries = CountryState::getCountries();
            $country   = array_get($countries, $userCountry);
        } else {
            $country = 'MY';
            $countries = CountryState::getCountries();
        }


        $userState = $selecteduser->profile_info->state;
        if ($userState) {
            $states = CountryState::getStates($userCountry);
            $state  = array_get($states, $userState);
        } else {
            $state = "unknown";
            $states = CountryState::getStates('MY');
        }
// dd($states);


        /**
         * Get Countries from mmdb
         * @var [collection]
         */
        // $countries = CountryState::getCountries();
        /**
         * [Get States from mmdb]
         * @var [collection]
         */
        // $states = CountryState::getStates('US');
        /**
         * Get all packages from database
         * @var [collection]
         */

         $acti = Activity::with('user')->where('user_id',$user_id)->get();

        return view('app.admin.users.profile', compact('title', 'sub_title', 'base', 'method', 'mail_count', 'voucher_count', 'balance', 'referrals', 'countries', 'selecteduser', 'sponsor', 'referals', 'profile_infos', 'countries', 'country', 'states', 'state', 'referrals_count', 'profile_photo', 'cover_photo', 'total_payout', 'Manual_Bank', 'Hyperwallet', 'Bitaps', 'paypal','acti'));
    }
    public function profile(Request $request)
    {
        $validator = Validator::make($request->all(), ["user" => 'required|exists:users,username']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors(['The username not exist']);
        }
         else {
            Session::put('prof_username', $request->user);
            return redirect()->back();
        }
    }
    public function suggestlist(Request $request)
    {
        if ($request->input != '/' && $request->input != '.') {
            $users['results'] = User::where('username', 'like', "%" . trim($request->input) . "%")->select('id', 'username as value', 'email as info')->get();
        } else {
            $users['results'] = User::select('id', 'username as value', 'email as info')->get();
        }

        echo json_encode($users);
    }
    public function saveprofile(Request $request)
    {
        dd(1322);
        dd("as");

        // die(Session::get('prof_username'));

        if (!Session::has('prof_username')) {
            return redirect()->back();
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
        $related_profile_info->mobile      = 11111111111111111111111111111;

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
            Session::flash('flash_notification', array('message' => "Profile updated succesfully", 'level' => 'success'));
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors(['Whoops, looks like something went wrong']);
        }
    }
    public function allusers()
    {
        $users       = User::select('users.username')->get();
        $loop_end    = count($users);
        $user_string = '';
        for ($i = 0; $i < $loop_end; $i++) {
            $user_string = $user_string . $users[$i]->username;
            if ($i < ($loop_end - 1)) {
                $user_string = $user_string . ",";
            }
        }
        print_r($user_string);
    }

    public function validateuser(Request $request)
    {
        return User::takeUserId($request->sponsor);
    }

    public function activate()
    {

        $title     = trans('users.activate_user');
        $sub_title = trans('users.activate_user');
        $base      = trans('users.activate_user');
        $method    = trans('users.activate_user');




     

        $users = User::join('profile_infos', 'profile_infos.user_id', '=', 'users.id')
            ->join('packages', 'packages.id', '=', 'profile_infos.package')
            ->join('tree_table', 'tree_table.user_id', '=', 'users.id')
            ->join('sponsortree', 'sponsortree.user_id', '=', 'users.id')
            ->join('users as sponsors', 'sponsors.id', '=', 'sponsortree.sponsor')
            ->select('sponsors.username as sponsors', 'users.username', 'users.id', 'users.email', 'users.created_at', 'users.name', 'users.lastname', 'packages.package')
            ->where('tree_table.type', '=', 'yes')
            ->where('users.confirmed', '<>', 1)
            ->paginate(10);
            // dd($users);

        return view('app.admin.users.activate', compact('title', 'sub_title', 'base', 'method', 'users'));
    }

    public function confirme_active(Request $request, $id)
    {

        $user_detail = User::find($request->user);

        if ($user_detail) {
            $sponsor_id = Sponsortree::where('user_id', $user_detail->id)->pluck('sponsor');
            $package_id = ProfileInfo::where('user_id', $user_detail->id)->value('package');
            $package = Packages::find($package_id);

            /* Sponsor Commission */
            Transactions::sponsorcommission($sponsor_id, $user_detail->id);

            /* Leadership Bonus */
            LeadershipBonus::allocateCommission($sponsor_id, Sponsortree::where('user_id', $sponsor_id)->value('sponsor'), $package->pv / 10);

            /* Ponit Update */
            Tree_Table::getAllUpline($user_detail->id);
            PointTable::updatePoint($package->pv, $user_detail->id);

            User::where('id', $user_detail->id)->update(['confirmed' => 1]);
        } else {
            return redirect()->back()->withErrors(['Whoops, User not found ']);
        }

        Session::flash('flash_notification', array('message' => "Member activated succesfully", 'level' => 'success'));

        return redirect()->back();
    }
    public function search(Request $request)
    {
        $keywords    = $request->get('username');
        $suggestions = User::where('username', 'LIKE', '%' . $keywords . '%')->get();
        return $suggestions;
    }
    public function changeusername()
    {
        $title     = trans('adminuser.change_username');
        $sub_title     = trans('adminuser.change_username');
        $base     = trans('adminuser.change_username');
        $method     = trans('adminuser.change_username');


        return view('app.admin.users.changeusername', compact('title', 'sub_title', 'base', 'method'));
    }
    public function updatename(Request $request)
    {
        if (strtolower($request->username) == 'adminuser') {
            Session::flash('flash_notification', array('message' => trans('users.username_cannot_change'), 'level' => 'success'));
            return redirect()->back();
        }
        $username         = $request->username;
        $new_username     = $request->new_username;
        $data             = array();
        $user['username'] = $request->username;
        $validator        = Validator::make(
            $user,
            ['username' => 'required|exists:users']
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $data['username'] = $request->new_username;
            $validator        = Validator::make(
                $data,
                ['username' => 'required|unique:users,username|alpha_num|max:255']
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            } else {
                $update = DB::table('users')->where('username', $username)->update(['username' => $new_username]);
                Session::flash('flash_notification', array('message' => trans('users.username_changed_successfully'), 'level' => 'success'));

                return redirect()->back();
            }
        }
    }

    public function userlogin(Request $request, $id)
    {
        Session::put('impersonate', 'yes');
        Auth::loginUsingId($id);
        return redirect('user/dashboard');
    }

    public function useraccounts(Request $request)
    {
// dd($request->all());
        if (isset($request)) {
             $validator = Validator::make($request->all(), [
            'key_user_hidden' => 'exists:users,username',
             ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors(trans('admin.invalid_username'));
            }
        }
        $title     = trans("users.user_account");
        $sub_title = trans("users.user_account");
        $base      = trans("users.user_account");
        $method    = trans("users.user_account");

        $data = null ;
        if ($request->has('key_user_hidden')) {
          // dd($request->key_user_hidden);
            $data = User::where('username', '=', $request->key_user_hidden)
                          ->join('profile_infos', 'profile_infos.user_id', '=', 'users.id')
                           ->select('users.id','users.name','users.lastname','users.username','users.email','profile_infos.mobile','profile_infos.account_number','profile_infos.passport','profile_infos.profile')
                           ->get();
        }
        // dd($data);

        return view('app.admin.users.useraccounts', compact('title', 'sub_title', 'base', 'method', 'data', 'request'));
       }


        public function userpromote($id)
        {
             
         $update= User::where('id', $id)->update(['influencer_type' => 'yes']);

          Session::flash('flash_notification', array('message' => "Successfully promoted", 'level' => 'success'));

           return redirect()->back();
        }



    public function incomedetails($id)
    {
        // dd($id);
        $title     = trans("users.income_details");
        $sub_title = trans("users.income_details");
        $base      = trans("users.income_details");
        $method    = trans("users.income_details");

        $data = User::where('users.id', '=', $id)
                          ->join('profile_infos', 'profile_infos.user_id', '=', 'users.id')
                           ->select('users.id','users.name','users.lastname','users.username','users.email','profile_infos.mobile','profile_infos.account_number','profile_infos.passport','profile_infos.profile')
                           ->get();
        // dd($data);
        $settings = Settings::getSettings();
       
        //dd($data);join('payout_request','payout_request.user_id','commission.user_id')->where('payout_request.status','released')
                            
        $income= Commission::join('users', 'commission.from_id', '=', 'users.id')
                            ->where('commission.user_id', $id)
                            ->where('commission.from_id', '!=', $id)
                            ->where('commission.payment_type', '!=', 'fund_debit')
                  ->where('commission.payment_type', '!=', 'fund_credit')
                            ->select('users.username', 'commission.*')
                            ->paginate(20);
       

        // $income = Commission::where('commission.user_id',$accounts)
        //                     ->where('commission.from_id','!=',$accounts)
        //                     ->join('users','commission.from_id','=','users.id')
                        /*->join('users','user_accounts.user_id','=','users.id')*/
                            // ->select('users.username','commission.*')
                            // ->paginate(100);
       
        return view('app.admin.users.incomedetails', compact('title', 'sub_title', 'base', 'method', 'income', 'data'));
    }
    public function salesdetails($id)
    {
        // dd($id);
        $title     = trans("users.sales_details");
        $sub_title = trans("users.sales_details");
        $base      = trans("users.sales_details");
        $method    = trans("users.sales_details");

        $data = User::where('users.id', '=', $id)
                          ->join('profile_infos', 'profile_infos.user_id', '=', 'users.id')
                           ->select('users.id','users.name','users.lastname','users.username','users.email','profile_infos.mobile','profile_infos.account_number','profile_infos.passport','profile_infos.profile')
                           ->paginate(20);
        // dd($data);
        // $settings = Settings::getSettings();
       
        //dd($data);join('payout_request','payout_request.user_id','commission.user_id')->where('payout_request.status','released')
                            
        $sales= PurchaseHistory::where('purchase_history.seller_id', $id)
                             ->join('users','purchase_history.user_id','=','users.id')
                            ->select('purchase_history.*','users.username')
                            ->get();
       

        // $income = Commission::where('commission.user_id',$accounts)
        //                     ->where('commission.from_id','!=',$accounts)
        //                     ->join('users','commission.from_id','=','users.id')
                        /*->join('users','user_accounts.user_id','=','users.id')*/
                            // ->select('users.username','commission.*')
                            // ->paginate(100);
       
        return view('app.admin.users.salesdetails', compact('title', 'sub_title', 'base', 'method', 'sales', 'data'));
    }
    public function purchasedetails($id)
    {
        // dd($id);
        $title     = trans("users.purchase_details");
        $sub_title = trans("users.purchase_details");
        $base      = trans("users.purchase_details");
        $method    = trans("users.purchase_details");

        $data = User::where('users.id', '=', $id)
                          ->join('profile_infos', 'profile_infos.user_id', '=', 'users.id')
                           ->select('users.id','users.name','users.lastname','users.username','users.email','profile_infos.mobile','profile_infos.account_number','profile_infos.passport','profile_infos.profile')
                           ->paginate(20);
        // dd($data);
        // $settings = Settings::getSettings();
       
        
                            
        $purchase= PurchaseHistory::where('purchase_history.user_id', $id)
                             ->join('users','purchase_history.seller_id','=','users.id')
                            ->select('purchase_history.*','users.username')
                            ->get();
       

       
        return view('app.admin.users.purchasedetails', compact('title', 'sub_title', 'base', 'method', 'purchase', 'data'));
    }

    public function referraldetails($id)
    {

        $title     = trans("users.referral_details");
        $sub_title = trans("users.referral_details");
        $base      = trans("users.referral_details");
        $method    = trans("users.referral_details");

        $referrals      = Sponsortree::getMyReferals($id);
        $data = User::where('users.id', '=', $id)
                          ->join('profile_infos', 'profile_infos.user_id', '=', 'users.id')
                           ->select('users.id','users.name','users.lastname','users.username','users.email','profile_infos.mobile','profile_infos.account_number','profile_infos.passport','profile_infos.profile')
                           ->get();



        return view('app.admin.users.referralsdetails', compact('title', 'sub_title', 'base', 'method', 'referrals', 'data'));
    }

    public function ewalletdetails($id)
    {
        //dd($id);

        $title     = trans("users.ewallet_details");
        $sub_title = trans("users.ewallet_details");
        $base      = trans("users.ewallet_details");
        $method    = trans("users.ewallet_details");

        $data = User::where('users.id', '=', $id)
                          ->join('profile_infos', 'profile_infos.user_id', '=', 'users.id')
                           ->select('users.id','users.name','users.lastname','users.username','users.email','profile_infos.mobile','profile_infos.account_number','profile_infos.passport','profile_infos.profile')
                           ->get();
        //dd($data);
        $accounts = User::where('id', $id)->pluck('id') ;
        //dd($accounts);
        // $ewallet =Commission::wherein('commission.user_id',$accounts)
        //                     ->join('users','commission.from_id','=','users.id')
        //                    /* ->join('users','user_accounts.user_id','=','users.id')*/
        //                     ->select('users.username','commission.*')
        //                     ->where(function($j){
        //                         $j->where('payment_type','=','fund_credit');
        //                     })
        //                     ->paginate(100);

        $users1 = Commission::select('commission.id', 'user.username', 'fromuser.username as fromuser', 'commission.payment_type', 'commission.payable_amount', 'commission.created_at')
            ->join('users as fromuser', 'fromuser.id', '=', 'commission.from_id')
            ->join('users as user', 'user.id', '=', 'commission.user_id')
            ->where('commission.user_id', $id)
            ->orderBy('commission.id', 'desc');

        $users2 = Payout::select('payout_request.id', 'users.username', 'users.username as fromuser', 'payout_request.status as payment_type', 'payout_request.amount as payable_amount', 'payout_request.created_at')
            ->join('users', 'users.id', '=', 'payout_request.user_id')
            ->where('payout_request.user_id', $id)
            ->where('payout_request.status', 'released')
            ->orderBy('payout_request.id', 'desc');

    
        $ewallet = $users1->union($users2)->orderBy('created_at', 'DESC')

            // ->offset($request->start)
            // ->limit($request->length)
           ->get();
      

        return view('app.admin.users.ewalletdetails', compact('title', 'sub_title', 'base', 'method', 'ewallet', 'data'));
    }

    public function payoutdetails($id)
    {

        $title     = trans("users.payout_details");
        $sub_title = trans("users.payout_details");
        $base      = trans("users.payout_details");
        $method    = trans("users.payout_details");

        $accounts = User::where('id', $id)->pluck('id') ;

       $data = User::where('users.id', '=', $id)
                          ->join('profile_infos', 'profile_infos.user_id', '=', 'users.id')
                           ->select('users.id','users.name','users.lastname','users.username','users.email','profile_infos.mobile','profile_infos.account_number','profile_infos.passport','profile_infos.profile')
                           ->get();

        $payout = Payout::wherein('payout_request.user_id', $accounts)
                            ->join('users', 'payout_request.user_id', '=', 'users.id')
                           ->where('payout_request.status', 'released')
                            ->select('users.username', 'payout_request.*')
                            ->paginate(100);

      //dd($payout);

        return view('app.admin.users.payoutdetails', compact('title', 'sub_title', 'base', 'method', 'data', 'payout'));
    }

    public function approve_payments()
    {
        // Show the page
        $title     = trans('users.approve_payments');
        $sub_title = trans('users.approve_payments');
        $base      = trans('users.approve_payments');
        $method    = trans('users.approve_payments');

        return view('app.admin.users.approve_payments', compact('title', 'sub_title', 'base', 'method'));
    }






    public function approve(Request $request)
    {
        // dd($request->id);
        $update= PendingTransactions::where('id', $request->id)->update(['payment_status' => 'complete','approved_by' => 'manual']);
        
        

        Session::flash('flash_notification', array('message' => "Successfully Approved", 'level' => 'success'));
           return redirect()->back();
    }
    public function delete_approve(Request $request)
    {
        $delete_approve = PendingTransactions::find($request->id);
        $new_mail = $delete_approve->email.'-deleted';
        PendingTransactions::where('id',$request->id)->update(['email'=> $new_mail]);
        $delete_approve->delete();
        Session::flash('flash_notification', array('message' => "Successfully Deleted !!", 'level' => 'success'));
            return redirect()->back();
    }

    //   public function approve_users()
    // {
    //     // Show the page
    //     $title     = 'Approve users';
    //     $sub_title = 'Approve users';
    //     $base      = 'Approve users';
    //     $method    = 'Approve users';


    //     return view('app.admin.users.approve_users', compact('title', 'sub_title', 'base', 'method'));
    // }


    // public function approveUser(Request $request)
    // {
    //     // dd($request->id);
    //     $user_id = $request->id;
    //     Sponsortree::$upline_users = array();
    //     Sponsortree::getAllUpline($user_id);
    //     $upline_users = Sponsortree::$upline_users;

    //     foreach ($upline_users as $key => $value)
    //     { 
    //     $sponsortree_userid = $value['user_id'];  
    //     $increment =Sponsortree::where('sponsor',$sponsortree_userid)->increment('member_count');  
    //     }


    //     $update= User::where('id', $request->id)->update(['active' => 'yes']);
    //     Session::flash('flash_notification', array('message' => "Successfully Approved", 'level' => 'success'));
    //        return redirect()->back();
    // }


    //   public function activate_UserData()
    //   {

    
         
    //     DB::statement(DB::raw('set @rownum=0'));

    //     $Unapproved_Users_count = User::where('active', 'pending')->where('id','>',1)->count();

    //     $users_data = User::select(array(DB::raw('@rownum  := @rownum  + 1 AS rownum'),'id','username','email'))
    //                   ->where('id','>',1)
    //                   ->where('active', 'pending')

    //                   ->get();
       
    //     return DataTables::of($users_data)
    //        ->removeColumn('id')
    //        ->addColumn('actions', '<div class="list-icons">
    //                   <div class="list-icons-item dropdown">
    //                   <a href="#" class="list-icons-item" data-toggle="dropdown"><i 
    //                   class="icon-menu7"></i></a>
    //                   <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end"
    //                   style="position: absolute; will-change: transform;top: 0px;left:
    //                   0px;transform: translate3d(-164px, 16px, 0px);">
                        
    //                   <a href="{{{ URL::to(\'admin/approveUser/\' . $id ) }}}" class="dropdown-item"><i 
    //                   class="fa fa-check" aria-hidden="true" style="color:green"></i>
    //                   Approve user</a>
    //                   <div class="dropdown-divider"></div><br>
    //                     </div>
    //                   </div>
    //                 </div>')
    //          ->setTotalRecords($Unapproved_Users_count)
    //          ->escapeColumns([])
    //          ->make();
    // }

    
    
    public function payout_update(Request $request, $id)
    {
        $new_user=ProfileInfo::find(ProfileInfo::where('user_id', $id)->value('id'));
        $new_user->account_holder_name=$request->account_holder_name;
        $new_user->account_number=$request->account_number;
        $new_user->swift=$request->swift;
        $new_user->sort_code=$request->sort_code;
        $new_user->bank_code=$request->bank_code;
        $new_user->branch_address=$request->branch_address;
        $new_user->paypal=$request->paypal;
        $new_user->btc_wallet=$request->btc_wallet;
        $new_user->save();

        $user=User::find($id);
        $user->hypperwalletid=$request->hypperwalletid;
        $user->hypperwallet_token=$request->hyperwallet_token;
        $user->save();
        Session::flash('flash_notification', array('level'=>'success','message'=>trans('profile.details_updated')));
        return redirect()->back();
    }

    public function createhypperwalletid($id)
    {
        $users             =User::find($id);
        $prof_info         =ProfileInfo::find(ProfileInfo::where('user_id', $id)->value('id'));
        $wallet_id=uniqid();
        $hypperwalletid    = 'hypperwallet_'.$wallet_id;
        $admin_hyperwallet              = payout_gateway_details::find(1);
        $admin_hyperwallet_username     =$admin_hyperwallet->username;
        $admin_hyperwallet_programtoken =$admin_hyperwallet->program_token;
        $admin_hyperwallet_password     =$admin_hyperwallet->password;
    
        $client = new \Hyperwallet\Hyperwallet($admin_hyperwallet_username, $admin_hyperwallet_password, $admin_hyperwallet_programtoken);
        $user = new \Hyperwallet\Model\User();
        $user
        ->setClientUserId($hypperwalletid)
        ->setProfileType(\Hyperwallet\Model\User::PROFILE_TYPE_INDIVIDUAL)
        ->setFirstName($users->name)
        ->setLastName($users->lastname)
        ->setEmail($users->email)
        ->setAddressLine1($prof_info->address1)
        ->setCity($prof_info->city)
        ->setStateProvince('CA')
        ->setCountry($prof_info->country)
        ->setPostalCode($prof_info->zip);
         
        try {
            $createdUser = $client->createUser($user);
            $crd=User::where('id', $id)->update([
                'hypperwallet_token' => $createdUser->token,
                'hypperwalletid'     => $hypperwalletid,
              ]);
        
            Session::flash('flash_notification', array('message'=>'Successfully Created','level'=>'success'));
        } catch (\Hyperwallet\Exception\HyperwalletException $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            $error = $e->getMessage();
          //dd($e);
            Session::flash('flash_notification', array('message'=>$error,'level'=>'error'));
        }
        return redirect()->back();
    }

    public function loginPassword_settings(Request $request)
    {
   

        $validator = Validator::make($request->all(), [
          'new_loginPassword'        => 'required|min:6',
          'confirm__loginPassword'   => 'required|min:6',
          'confirm__loginPassword'   => 'required_with:new_loginPassword|same:new_loginPassword|min:6',
           
        ]);
        if ($validator->fails()) {
            $user=User::find($request->id);
            return redirect('admin/userprofiles/'.$user->username.'#settings')->withErrors($validator);
        } else {
            $password=bcrypt($request->new_loginPassword);
            $id=$request->id;
               User::where('id', '=', $id)
               ->update(['password'=>$password]);
            Session::flash('flash_notification', array('level'=>'success','message'=>trans('profile.details_updated')));
            $user=User::find($request->id);
            return redirect('admin/userprofiles/'.$user->username.'#settings');
        }
    }

    public function transactionPassword_settings(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'new_transactionPassword'        => 'required|min:6',
            'confirm_transactionPassword'    => 'required|min:6',
            'confirm_transactionPassword'    => 'required_with:new_transactionPassword|same:new_transactionPassword|min:6',
           
        ]);
        if ($validator->fails()) {
            $user=User::find($request->id);
            return redirect('admin/userprofiles/'.$user->username.'#settings')->withErrors($validator);
        } else {
            User::where('id', $request->id)->update(['transaction_pass'=>$request->new_transactionPassword]);
            Session::flash('flash_notification', array('level'=>'success','message'=>trans('profile.details_updated')));
            $user=User::find($request->id);
            return redirect('admin/userprofiles/'.$user->username.'#settings');
        }
    }

    public function enable_2fa_authentication(Request $request, $id)
    {
      
        $user=User::find($id);
        $user->enable_2fa = $request->input('enable_2fa');
        $user->save();
        Session::flash('flash_notification', array('level'=>'success','message'=>trans('profile.details_updated')));
        return redirect()->back();
    }

    public function getNews()
    {
        $title     =  trans('users.news');
        $sub_title =  trans('users.news');
        $base      =  trans('users.news');
        $method    =  trans('users.news');
        $news=News::orderBy('created_at', 'DESC')->paginate(5);
        return view('app.admin.users.createnews', compact('title', 'sub_title', 'base', 'method', 'news'));
    }

    public function postNews(Request $request)
    {

        if ($request->summernoteInput == null) {
            Session::flash('flash_notification', array('level'=>'error','message'=>'Target Media and content fields are Required'));
            return redirect()->back();
        } else {
              if (Input::hasFile('thump')) {
                    $destinationPath1 = public_path() . '/uploads/documents';
                    $extension1       = Input::file('thump')->getClientOriginalExtension();
                    $fileName1        = rand(000011111, 99999999999) . '.' . $extension1;
                    Input::file('thump')->move($destinationPath1, $fileName1);
                     $post=News::create([
                         'title'           =>$request->post_name,
                         'content'        => $request->summernoteInput,
                         'thumnail'        => $fileName1,
                         'sub_text'        => $request->shorttext,
                       
                     ]);
              }
              else{
                Session::flash('flash_notification', array('level'=>'error','message'=>'Thumnail Required'));
                return redirect()->back();
              }

            Session::flash('flash_notification', array('level'=>'success','message'=>'Post Added successfully'));
            return redirect()->back();
        }
    }

    public function viewnews($id)
    {
        $title     =  trans('users.view_news');
        $sub_title =  trans('users.view_news');
        $base      =  trans('users.view_news');
        $method    =  trans('users.view_news');
        $post=News::find($id);
        return view('app.admin.users.viewnews', compact('title', 'sub_title', 'base', 'method', 'post'));
    }
    public function allnews()
    {
        $title     =  trans('users.view_news');
        $sub_title =  trans('users.view_news');
        $base      =  trans('users.view_news');
        $method    =  trans('users.view_news');
        $news=News::orderBy('created_at', 'DESC')->paginate(5);
        return view('app.admin.users.allnews', compact('title', 'sub_title', 'base', 'method', 'news'));
    }

    public function editnews($id)
    {

        $title     =  trans('users.edit_news');
        $sub_title =  trans('users.edit_news');
        $base      =  trans('users.edit_news');
        $method    =  trans('users.edit_news');
        $news=News::find($id);
        return view('app.admin.users.editnews', compact('title', 'sub_title', 'base', 'method', 'news'));
    }
    public function posteditnews(Request $request)
    {
        // dd($request->all());
        $news=News::find($request->post_id);
        $news->title = $request->post_name;
        $news->content =$request->summernoteInput;
        $news->sub_text =$request->shorttext;
        $news->save();
        Session::flash('flash_notification', array('level'=>'success','message'=>trans('users.post_edited_successfully')));
        return redirect('admin/getnews');
    }

    public function deletenews(Request $request)
    {
        $news=News::find($request->id);
        $news->delete();
        Session::flash('flash_notification', array('level'=>'success','message'=>trans('users.post_edited_successfully')));
        return redirect('admin/getnews');
    }

    public function getVideos()
    {
     
        $title     =  trans('users.videos');
        $sub_title =  trans('users.videos');
        $base      =  trans('users.videos');
        $method    =  trans('users.videos');
        $videos=EventVideos::all();
        // dd($videos);
        $result=array();
        foreach ($videos as $key => $video) {
            $video_html=EventVideos::getVideoHtmlAttribute($video->url);
            $result[$video->id]['id']=$video->id;
            $result[$video->id]['title']=$video->title;
            $result[$video->id]['url']=$video_html;
            $result[$video->id]['created']=$video->created_at;

        }
 
   
        return view('app.admin.users.videos', compact('title', 'sub_title', 'base', 'method', 'result'));
    }

    public function postVideos(Request $request)
    {
        $url=$this::isValidURL(trim($request->videos));

        if ($url<>0) {
            EventVideos::create([
            'title'       =>$request->title,
            'url'=>$request->videos,
            'type'      =>'video',
            ]);

            Session::flash('flash_notification', array('level' => 'success', 'message' => 'Videos Added Successfully'));
        } else {
            Session::flash('flash_notification', array('level' => 'error', 'message' => 'Please check the url'));
        }
    
      
        
         return redirect()->back();
    }

    public static function isValidURL($url)
    {
        return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
    }
    public function editvideo($id)
    {
        $title     =  trans('users.edit_video');
        $sub_title =  trans('users.edit_video');
        $base      =  trans('users.edit_video');
        $method    =  trans('users.edit_video');
        $editvideo=EventVideos::find($id);
        return view('app.admin.users.editvideo', compact('title', 'sub_title', 'base', 'method', 'editvideo'));
    }

    public function posteditvideo(Request $request)
    {

        $video=EventVideos::find($request->id);
        $url=$this::isValidURL(trim($request->videos));

        if ($url<>0) {
            $video->title = $request->title;
            $video->url=$request->videos;
            $video->save();


            Session::flash('flash_notification', array('level' => 'success', 'message' => 'Videos edited Successfully'));
        } else {
            Session::flash('flash_notification', array('level' => 'error', 'message' => 'Please check the url'));
        }
        
        return redirect()->back();
    }

    public function deletevideo(Request $request)
    {
        $delete_video=EventVideos::find($request->id);
        $delete_video->delete();
    }

    public function poolBonus(){
     
        $title     =  trans('users.pool_bonus');
        $sub_title =  trans('users.calculations');
        $base      =  trans('users.pool_bonus');
        $method    =  trans('users.pool_bonus');

        $pool_percentage = Settings::find(1)->service_charge;
        $pool_balance = PurchaseHistory::where('pool_status','no')
                                       ->where('type','product')
                                       ->where('shipping_country','MY')
                                       ->where('pay_by','!=','register_point')
                                       ->sum('total_bv')*($pool_percentage/100);

        $rank_settings = Ranksetting::where('id','>',1)
                                    ->where('id','<>',5)
                                    ->get();

        $total_users = 0;
        $total_share = 0;
        $one_share   = 0;
        $user_rank_data = array();

        foreach ($rank_settings as $key => $value) {
          
          // $user_count = User::where('rank_id',$value->id)->count();
          $user_data = User::join('profile_infos','profile_infos.user_id','users.id')
                           ->where('profile_infos.country','MY')
                           ->where('users.rank_id',$value->id)
                           ->select('users.username','users.name','users.lastname')
                           ->get();

          $user_count = count($user_data);
          $total_users = $total_users+ $user_count;
          $share = $user_count*$value->pool_share;
          $total_share = $total_share + $share;

          $user_rank_data[$value->id]['name'] = $value->rank_name;
          $user_rank_data[$value->id]['count'] = $user_count;
          $user_rank_data[$value->id]['share'] = $share;
          $user_rank_data[$value->id]['username'] = $user_data;

        }

     
        $pool_history = PoolHistory::all();
        if($total_share)
          $one_share = $pool_balance/$total_share;

        return view('app.admin.users.pool-bonus', compact('title', 'sub_title', 'base', 'method', 'pool_percentage','pool_balance','total_users','total_share','one_share','user_rank_data','pool_history'));

    }

    public function poolBonusPost(Request $request){


      if($request->total_users > 0 && $request->pool_balance > 0){
      
         Ranksetting::poolBonus($request->all());

            Session::flash('flash_notification', array('level' => 'success', 'message' => 'Leadership pool bonus released'));
      }else{

           Session::flash('flash_notification', array('level' => 'warning', 'message' => 'There is no users to distribute the pool bonus or the pool bonus balance is minimum'));
      }

      return redirect()->back();
    }
    public function editPaymentSlip(Request $request){
        $validator = Validator::make($request->all(), [
            'bank_file'        => 'required|mimes:pdf,doc,docx,jpeg,png,jpg'
        ]);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        if (Input::hasFile('bank_file')) {
            $destinationPath   = public_path() . '/uploads/documents';
            $extension         = Input::file('bank_file')->getClientOriginalExtension();
            $bank_file         = rand(000011111, 99999999999) . '.' . $extension;
            Input::file('bank_file')->move($destinationPath, $bank_file);
            PendingTransactions::where('id',$request->id)->update(['invoice' => $bank_file]);

            Session::flash('flash_notification', array('level' => 'success', 'message' => 'Payment Slip Updated Successfully'));
        }else{
             Session::flash('flash_notification', array('level' => 'warning', 'message' => 'Whoops, looks like something went wrong'));
        }
        return redirect()->back();      
    }
    public function maintainMembers(){

        $title     = trans('menu.members');
        $sub_title = trans('menu.maintain_members');
        $month     = date('m');

        return view('app.admin.users.maintain_members', compact('title', 'sub_title','month'));
    }
    public function postMaintainMembers(Request $request){  
      $year  = date('Y');
      $month = $request->month;
      $query_date = $year.'-'.$month.'-01';
      $finallist = [];
      $start     = date('Y-m-1 00:00:00', strtotime($query_date));
      $firststart= $start;
      $total_income= 0;
      if($request->type == 1){ 
          $end   = date('Y-m-7 23:59:59', strtotime($query_date));
          $users     = User::where('weekly_payout','yes')->get();
        
          foreach ($users as $key => $value) {
              $value->total_bv      = PurchaseHistory::where('user_id',$value->id)
                                        ->where('created_at', '>', $start)->where('created_at', '<', $end)
                                        ->where('type','product')->where('pay_by','!=','register_point')
                                        ->sum('total_bv');
            if($value->total_bv > 100){
              $value->purchase_type = PurchaseHistory::where('user_id',$value->id)->where('type','product')->where('pay_by','!=','register_point')->orderBy('id','desc')->first()->purchase_type;
              $value->week1 = Commission::where('user_id',$value->id)->where('created_at', '>', $start)->where('created_at', '<', $end)->sum('payable_amount');
              $start = $end;
              $end   = date('Y-m-d 23:59:59',strtotime("+7 day", strtotime($start)));
              $value->week2 = Commission::where('user_id',$value->id)->where('created_at', '>', $start)->where('created_at', '<', $end)->sum('payable_amount');
              $start = $end;
              $end   = date('Y-m-d 23:59:59',strtotime("+7 day", strtotime($start)));
              $value->week3 = Commission::where('user_id',$value->id)->where('created_at', '>', $start)->where('created_at', '<', $end)->sum('payable_amount');
              $start = $end;
              $end   = new Carbon('last day of this month');
              $end   = date('Y-m-d 23:59:59',strtotime($end));
              $value->week4 = Commission::where('user_id',$value->id)->where('created_at', '>', $start)->where('created_at', '<', $end)->sum('payable_amount');
              $start = $firststart;
              $value->total_income = Commission::where('user_id',$value->id)->where('created_at', '>', $start)->where('created_at', '<', $end)->sum('payable_amount');
              $finallist[] = $value;
              $total_income = $total_income+$value->total_income;
            }
          }
          $type = 'Weekly';
      }
      else{
          $end       = date('Y-m-t 23:59:59', strtotime($query_date));
          $users     = User::where('weekly_payout','no')->get();

          foreach ($users as $key => $value) {
              $value->total_bv   =  PurchaseHistory::where('user_id',$value->id)
                                      ->where('created_at', '>', $start)->where('created_at', '<', $end)
                                      ->where('type','product')->where('pay_by','!=','register_point')
                                      ->sum('total_bv');

              if($value->total_bv > 100){
                  $value->purchase_type = PurchaseHistory::where('user_id',$value->id)->where('type','product')->where('pay_by','!=','register_point')->orderBy('id','desc')->first()->purchase_type;
                  $value->total_income = Commission::where('user_id',$value->id)->where('created_at', '>', $start)->where('created_at', '<', $end)->sum('payable_amount');
                  $finallist[] = $value;
                  $total_income = $total_income+$value->total_income;
              }
          }
          $type = 'Monthly';
      }
      $title     =  trans('menu.members');
      $sub_title =  trans('menu.maintain_members');
      $monthName = date("F", mktime(0, 0, 0, $month, 10));

        
      return view('app.admin.users.maintain_members_view', compact('title', 'sub_title','finallist','monthName','type','month','total_income'));
    }
     public function nonMaintainMembers(){

        $title     = trans('menu.members');
        $sub_title = trans('menu.non_maintain_members');
        $month     = date('m');

        return view('app.admin.users.non_maintain_members', compact('title', 'sub_title','month'));
    }
    public function postNonMaintainMembers(Request $request){  
      $year  = date('Y');
      $month = $request->month;
      $query_date = $year.'-'.$month.'-01';
      $finallist = [];
      $start     = date('Y-m-1 00:00:00', strtotime($query_date));
      $end       = date('Y-m-t 23:59:59', strtotime($query_date));
      $users     = User::where('weekly_payout','no')->get();
      $total_income = 0;
      foreach ($users as $key => $value) {
          $value->total_bv   =  PurchaseHistory::where('user_id',$value->id)
                                  ->where('created_at', '>', $start)->where('created_at', '<', $end)
                                  ->where('type','product')->where('pay_by','!=','register_point')
                                  ->sum('total_bv');

          if($value->total_bv < 100){
              $value->total_income = Commission::where('user_id',$value->id)->where('created_at', '>', $start)->where('created_at', '<', $end)->sum('payable_amount');
              $finallist[] = $value;
              $total_income = $total_income+$value->total_income;
          }
      }
      $type = 'Monthly';
      $title     =  trans('menu.members');
      $sub_title =  trans('menu.non_maintain_members');
      $monthName = date("F", mktime(0, 0, 0, $month, 10));

        
      return view('app.admin.users.non_maintain_members_view', compact('title', 'sub_title','finallist','monthName','type','month','total_income'));
    }

      
       public function changeSponsorPost($userid,$sponsorid)
    {
      // dd($userid,$sponsorid);
        // $validator = Validator::make($request->all(), [
        //     'username' => 'required',
        //     'sponsor_username'   => 'required',
        //      ]);
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator);
        // }else{

            $user_id = $userid;
            $sponsor_id = $sponsorid;
            // dd($user_id,$sponsor_id);
            $oldsponsor = Sponsortree::where('user_id',$user_id)->value('sponsor');

            Sponsortree::$downlineid =[];
            Sponsortree::getDownlinesId(FALSE,$user_id);
            $getdownline_users=Sponsortree::$downlineid;
// dd($getdownline_users);
            if((in_array($sponsor_id, $getdownline_users)) || $sponsor_id==$user_id || $user_id==1)
                return redirect()->back()->withErrors('Unable To Change Sponsor');
        // dd(Sponsortree::where('user_id',$user_id)->count());
            if(Sponsortree::where('user_id',$user_id)->count() !=0 && Sponsortree::where('user_id',$sponsor_id)->count() !=0 && $user_id != $sponsor_id)
            {
              // dd(3);
              Sponsortree::where('user_id',$user_id)->delete();

              $sponsortreeid = Sponsortree::where('sponsor', $sponsor_id)->where('type', 'vaccant')->orderBy('id', 'desc')->take(1)->value('id');
              // dd($sponsortreeid);
              $sponsortree          = Sponsortree::find($sponsortreeid);
              $sponsortree->user_id = $user_id;
              $sponsortree->sponsor = $sponsor_id;
              $sponsortree->type    = "yes";
              $sponsortree->save();
// dd($user_id);
              SponsorChangeHistory::create([
                    'user_id'     =>$user_id,
                    'old_sponsor' =>$oldsponsor,
                    'new_sponsor' =>$sponsor_id,
              ]);

              //change spobnsor in tree table- no entries in tree table so.....

              $sponsorvaccant = Sponsortree::createVaccant($sponsor_id,$sponsortree->position);
              Session::flash('flash_notification', array('message' =>"User Sponsor Has Been Changed", 'level' => 'success'));
              // dd(10);
            }
            else
            {
              // dd(2);
                Session::flash('flash_notification', array('message' => "Invalid users", 'level' => 'warning'));
            }

        // }

dd("done");
        return redirect()->back();

    }              
      
}
