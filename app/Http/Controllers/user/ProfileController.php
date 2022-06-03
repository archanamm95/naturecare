<?php

namespace App\Http\Controllers\user;

use App\Balance;
use App\Commission;
use App\Country;
use App\DirectSposnor;
use App\Helpers\Thumbnail;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\DeleteRequest;
use App\Http\Requests\Admin\UserEditRequest;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\user\ProfileEditRequest;
use App\LeadershipBonus;
use App\Mail;
use App\Packages;
use App\PointTable;
use App\ProfileInfo;
use App\PurchaseHistory;
use App\RsHistory;
use App\Sponsortree;
use App\InfluencerTree;
use App\Tree_Table;
use App\User;
use App\Voucher;
use App\Payout;
use App\Shippingaddress;
use Auth;
use Datatables;
use DB;
use Illuminate\Http\Request;
use Input;
use Redirect;
use Response;
use Session;
use Validator;
use App\Activity;
use App\Note;
use Crypt;
use CountryState;
use App\Ranksetting;
use App\payout_gateway_details;
use App\Hyperwallet;
use App\Payoutmanagemt;
use Storage;

class ProfileController extends UserAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
        
        $title     = trans('users.profile');
        $sub_title = trans('users.profile');
        $base = trans('users.profile');
        $method = trans('users.profile');
      
        Session::put('prof_username', Auth::user()->username);

        $selecteduser = User::with('profile_info')->find(Auth::id());
        //$admin_openPayoutOptions=Payoutmanagemt::where('status',1)->get();
        $Hyperwallet=Payoutmanagemt::where('payment_mode', 'Hyperwallet')->value('status');
        $paypal=Payoutmanagemt::where('payment_mode', 'Paypal')->value('status');
        $Bitaps=Payoutmanagemt::where('payment_mode', 'Bitaps')->value('status');
        $Manual_Bank=Payoutmanagemt::where('payment_mode', 'Manual/Bank')->value('status');
      
        $profile_infos = ProfileInfo::with('images')->where('user_id', Auth::id())->first();
        $profile_photo = $profile_infos->profile;
        // if (!Storage::disk('images')->exists($profile_photo)){
        //     $profile_photo = 'avatar-big.png';
        // }
        if (!$profile_photo) {
            $profile_photo = 'avatar-big.png';
        }

        $cover_photo = $profile_infos->cover;

        if (!Storage::disk('images')->exists($cover_photo)) {
            $cover_photo = 'cover.jpg';
        }
        if (!$cover_photo) {
            $cover_photo = 'cover.jpg';
        }
       
        $referals = User::select('users.*')->join('tree_table', 'tree_table.user_id', '=', 'users.id')->where('tree_table.sponsor', Auth::id())->limit(6)->get();

        $total_referals = count($referals);
        $base           = trans('users.profile');
        $method         = trans('users.profile_view');
        $referrals      = Auth::user()->user_type == "InfluencerManager" ? InfluencerTree::getMyReferals(Auth::id()) : Sponsortree::getMyReferals(Auth::id());
        // dd($referrals);
        $balance         = Balance::getTotalBalance(Auth::id());
        $total_payout    = Payout::getMyTotalPayout(Auth::id());
        $vouchers        = Voucher::getAllVouchers();
        $voucher_count   = count($vouchers);
        $mails           = Mail::getMyMail(Auth::id());
        $mail_count      = count($mails);
        // $referrals_count = $total_referals;
        $referrals_count = count($referrals);
        $sponsor_id      = Sponsortree::getSponsorID(Auth::id());
        $sponsor      = User::with('profile_info')->where('id', $sponsor_id)->first();

        $left_bv         = PointTable::where('user_id', '=', Auth::id())
            ->value('left_carry');
        $right_bv = PointTable::where('user_id', '=', Auth::id())
            ->value('right_carry');

        $user_package    = Packages::where('id', $selecteduser->profile_info->package)->value('package');
        $user_rank = Ranksetting::getUserRank(Auth::id());
        $user_rank_name = Ranksetting::idToRankname($user_rank);
    
        $countries = Country::all();

        $userCountry = $selecteduser->profile_info->country;
        // $userCountry = 'MY';
        $total_countries=CountryState::getCountries();

        if ($userCountry) {
            $countries = $total_countries;
            $country   = array_get($countries, $userCountry);
        } else {
            $country = 'MY';
            $countries = $total_countries;
        }

        $userState = $selecteduser->profile_info->state;

        // $userState = '07';

        // $userState = 'AL';

        if ($userState) {
            $states = CountryState::getStates($userCountry);
            $state  = array_get($states, $userState);
            if(empty($state))
            {
                $state=$userState;
            }
        } else {
            $state = "unknown";
            $states = CountryState::getStates('MY');
        }
        $activities = Activity::with('user')->where('user_id', Auth::user()->id)->get();
        $notes   = Note::where('user_id', '=', Auth::user()->id)->get();

        $shipping_address=Shippingaddress::where('user_id',Auth::user()->id);

        $Shippingaddress = $shipping_address->where('option_type',1)->first();
        if(is_null($Shippingaddress))
            $Shippingaddress = $shipping_address->where('user_id',Auth::user()->id)->orderBy('id', 'desc')->first();

        return view('app.user.profile.index', compact('title', 'sub_title', 'base', 'method', 'mail_count', 'voucher_count', 'balance', 'referrals', 'countries', 'selecteduser', 'sponsor', 'referals', 'left_bv', 'right_bv', 'user_package', 'profile_infos', 'country', 'state', 'referrals_count', 'user_rank_name', 'profile_photo', 'cover_photo', 'total_payout', 'notes', 'states', 'Manual_Bank', 'Hyperwallet', 'Bitaps', 'paypal','Shippingaddress','activities'));
    }

    // public function index()
    // {

       // $title=trans('profile.title');
       // $sub_title = trans('profile.sub_title');
       // $user = User::find(Auth::user()->id);
       // $profile_infos=ProfileInfo::find(Auth::user()->id);
       // $dateofbirth= explode('/',$profile_infos->dateofbirth);
       // $ddArr=array();
       // $referals = ProfileInfo::select('profile_infos.*','packages.package as packagename')
       // ->join('sponsortree', 'sponsortree.user_id', '=', 'profile_infos.user_id')
       // ->join('packages','packages.id','=','profile_infos.package')
       // ->where('sponsortree.sponsor',Auth::user()->id)->get();
       // $total_referals = User::select('users.*')->join('sponsortree', 'sponsortree.user_id', '=', 'users.id')->where('sponsortree.sponsor',Auth::user()->id)->count();
       // $total_ewallet = Balance::getTotalBalance(Auth::user()->id);
       // $all_vouchers = Voucher::getAllVouchers();
       // $num_vouchers = count($all_vouchers);
       // $my_mails = Mail::getMyMail(Auth::user()->id);
       // $mail_count = count($my_mails);
       // for($i=01;$i<=31;$i++)
       // $ddArr[$i] =$i;
       // $categories = Country::getcountry();
       // $currencies = Currency::all();

       //  $left_bv =  PointTable::where('user_id','=',Auth::user()->id)->value('left_carry');
       //  $right_bv =  PointTable::where('user_id','=',Auth::user()->id)->value('right_carry');
       
       // $base = trans('profile.profile');
       // $method = trans('profile.title');
    //    return view('app.user.profile.index',compact('title','total_referals','left_bv','right_bv','total_ewallet','num_vouchers','currencies','user','mail_count','categories','ddArr','dateofbirth','referals','base','method','sub_title','profile_infos'));
    // }

   
    public function currency(Request $request)
    {
        $user=ProfileInfo::find(Auth::user()->id);
        $user->currency=$request->currency;
        $user->save();
          Session::flash('flash_notification', array('message'=>trans('profile.currency_saved'),'level'=>'success'));
          return redirect()->back();
    }

    public function legsetting(Request $request)
    {
        $user=User::find(Auth::user()->id);
        $user->default_leg=$request->leg;
        $user->save();
          Session::flash('flash_notification', array('message'=>trans('profile.default_leg'),'level'=>'success'));
          return redirect()->back();
    }
    public function rssetting(Request $request)
    {
        $user=ProfileInfo::find(Auth::user()->id);
        $user->auto_rs=$request->auto_rs;
        $user->save();
         Session::flash('flash_notification', array('message'=>trans('profile.rs_top_up'),'level'=>'success'));
         return redirect()->back();
    }
    public function getEdit()
    {
       
        $title = trans('profile.change_password');
        $sub_title =  trans('profile.change_password');
        $base = trans('profile.change_password');
        $method = trans('profile.change_password');

        Session::flash('flash_notification', array('message'=>trans('profile.password_changed'),'level'=>'success'));
          return redirect()->back();

        return view('app.user.users.index', compact('title', 'base', 'method', 'sub_title'));
    }

    public function postEdit(Request $request)
    {

        $user = User::find(Auth::user()->id);


   

        $password = $request->password;
        $passwordConfirmation = $request->change_password;

        if (!empty($password)) {
            if ($password === $passwordConfirmation) {
                $user->password = bcrypt($password);
            }
        }


      
        $user -> save();

          Session::flash('flash_notification', array('message'=>trans('profile.password_has_been_changed'),'level'=>'success'));

            /*$password = Emails::find(1) ;

        $app_settings = AppSettings::find(1) ;

         Mail::send('emails.password', ['email'=>$email,'company_name'=>$app_settings->company_name,'login_username' => $data['username'],'password'=> $data['password']], function ($m) use ($data , $email) {
             $m->to($data['email'], $data['firstname'])->subject('Password changed')->from($email->from_email, $email->from_name);
        });*/
          return redirect()->back();
    }

   


    public function update(ProfileEditRequest $request, $id)
    {

      // dd($request->all());
        $email=User::where('email', $request->email)->value('id');
        if ($email <> null && $request->email <> Auth::user()->email) {
             return redirect()->back()->withErrors([trans('users.email_already_taken')]);
        }
    
        // $user=User::find($id);
    
        // $user->name=$request->name;
        // $user->lastname=$request->lastname;
        // $user->email = $request->email;
        // $user->save();

        $new_user=ProfileInfo::find(ProfileInfo::where('user_id', $id)->value('id'));

        $new_user->mobile='+'.$request->phone_code.$request->phone;
        $new_user->address1=$request->address1;
        $new_user->address2=$request->address2;
        $new_user->city=$request->city;
        $new_user->country=$request->country;
        $new_user->state=$request->state;
        $new_user->zip=$request->zip;
        // $new_user->gender=$request->gender;
        // $new_user->dateofbirth=$request->dd.'/'.$request->mm.'/'.$request->year;
        // $new_user->skype=$request->skype;
        // $new_user->gplus=$request->gplus;
        // $new_user->linkedin=$request->linkedin;
        $new_user->twitter=$request->twitter;
        $new_user->facebook=$request->facebook;
        // $new_user->whatsapp=$request->whatsapp;
        // $new_user->about=$request->prof_details;
        $new_user->wechat=$request->wechat;
        $new_user->instagram=$request->instagram;
        $new_user->tiktok=$request->tiktok;
        $new_user->youtube=$request->youtube;
        $new_user->Lazada_Shop_name=$request->Lazada_Shop_name;
        $new_user->Shopee_Shop_Name=$request->Shopee_Shop_Name;


        // $new_user->passport=$request->passport;

     


        if ($request->hasFile('profile_pic')) {
            $destinationPath = base_path()."\public\appfiles\images\profileimages";
            $extension = Input::file('profile_pic')->getClientOriginalExtension();
            $fileName = rand(11111, 99999).'.'.$extension;
            Input::file('profile_pic')->move($destinationPath, $fileName);
            $new_user->image=$fileName;

             $path2 = public_path() . '/appfiles/images/profileimages/thumbs/';
            Thumbnail::generate_profile_thumbnail($destinationPath .'/'. $fileName, $path2 . $fileName);
            $path3= public_path() . '/appfiles/images/profileimages/small_thumbs/';
            Thumbnail::generate_profile_small_thumbnail($destinationPath .'/'. $fileName, $path3 . $fileName);
        }
       
        $new_user->save();


        Session::flash('flash_notification', array('level'=>'success','message'=>trans('profile.details_updated')));
              
        return Redirect::action('user\ProfileController@index');
    }

   
   
    public function getstates(getstaesRequest $request, $id)
    {
        $data=DB::table('life_state')->where('country_id', $id)->get();
        $html2="";
      
        $count = count($data);
        for ($i = 0; $i < $count; $i++) {
            $html2 =  $html2 . "<option value='".$data[$i]->State_Id."'>".$data[$i]->State_Name."</option>";
        }
        $html1 = "<lablel for='state_id'>Select State:</lablel><select name='state_id' id='state_id' class='form-control'>".$html2."</select>";
         //  $html=$html1+$html2;
            return($html1);
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
        
            Session::flash('flash_notification', array('message'=>trans('profile.successfully_created'),'level'=>'success'));
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
      //dd($request->all());


        $validator = Validator::make($request->all(), [
            'new_loginPassword'        => 'required|min:6',
            'confirm__loginPassword'   => 'required|min:6',
            'confirm__loginPassword'   => 'required_with:new_loginPassword|same:new_loginPassword|min:6',
           
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $password=bcrypt($request->new_loginPassword);
            $id=$request->id;
             User::where('id', '=', $id)
             ->update(['password'=>$password]);
            Session::flash('flash_notification', array('level'=>'success','message'=>trans('profile.password_updated_successfully')));
            return redirect()->back();
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
            return redirect()->back()->withErrors($validator);
        } else {
            User::where('id', $request->id)->update(['transaction_pass'=>$request->new_transactionPassword]);
            Session::flash('flash_notification', array('level'=>'success','message'=>trans('profile.details_updated')));
            return redirect()->back();
        }
    }
    public function payout_update(Request $request, $id)
    {
        $new_user=ProfileInfo::find(ProfileInfo::where('user_id', $id)->value('id'));
        if(empty($new_user->account_holder_name))
            $new_user->account_holder_name=$request->account_holder_name;
        if(empty($new_user->account_number))
            $new_user->account_number=$request->account_number;
        if(empty($new_user->swift))
            $new_user->swift=$request->swift;
        // $new_user->sort_code=$request->sort_code;
        if(empty($new_user->bank_code))
            $new_user->bank_code=$request->bank_code;
        if(empty($new_user->branch_address))
            $new_user->branch_address=$request->branch_address;
        // $new_user->paypal=$request->paypal;
        // $new_user->btc_wallet=$request->btc_wallet;
        // $new_user->paypal=$request->paypal_email;
        $new_user->save();

        $user=User::find($id);
        $user->hypperwalletid=$request->hypperwalletid;
        $user->hypperwallet_token=$request->hyperwallet_token;
        $user->save();
        Session::flash('flash_notification', array('level'=>'success','message'=>trans('profile.details_updated')));
        return redirect()->back();
    }
    public function enable_2fa_authentication(Request $request, $id)
    {
      //dd($request->all());
     
        $user=User::find($id);
        $user->enable_2fa = $request->input('enable_2fa');
        $user->save();
        Session::flash('flash_notification', array('level'=>'success','message'=>trans('profile.details_updated')));
        return redirect()->back();
    }
    public function shipping_address(Request $request){
        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'lastname'     => 'required',
            'address1'     => 'required',
            'address2'     => 'required',
            'zip'          => 'required',
            'city'         => 'required',
            'country'      => 'required',
            'state'        => 'required',
            'default'      => 'required',
        ]);
        if ($validator->fails()) {
            $user=User::find($request->id);
            return redirect('admin/userprofiles/'.$user->username.'#settings')->withErrors($validator);
        } else {
            $shipID = Shippingaddress::where('user_id',Auth::user()->id)->where('option_type',1)->value('id');
            if(is_null($shipID)){
                Shippingaddress::create([
                    'user_id'          => Auth::user()->id,
                    'option_type'      => $request->default,
                    'fname'            => $request->name,
                    'lname'            => $request->lastname,
                    'address'          => $request->address1,
                    'address2'         => $request->address2,
                    'pincode'          => $request->zip,
                    'city'             => $request->city,
                    'state'            => $request->state,
                    'country'          => $request->country,
                ]);
            }
            else{
                Shippingaddress::where('id',$shipID)->update([
                    'option_type'      => $request->default,
                    'fname'            => $request->name,
                    'lname'            => $request->lastname,
                    'address'          => $request->address1,
                    'address2'         => $request->address2,
                    'pincode'          => $request->zip,
                    'city'             => $request->city,
                    'state'            => $request->state,
                    'country'          => $request->country,
                ]);
            }
            Session::flash('flash_notification', array('level'=>'success','message'=>trans('profile.details_updated')));
            return redirect()->back();
        }
    }
}
