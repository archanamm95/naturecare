<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Tree_Table;
use App\Sponsortree;
use App\PointTable;
use App\Commission;
use App\RegisterPoint;
use App\Packages;
use App\ProfileModel;
use App\PurchaseHistory;
use App\SponsorCommission;
use App\ProfileInfo;
use App\LeadershipBonus;
use App\RsHistory;
use App\Activity;
use App\Emails;
use App\TempDetails;
use App\PendingTransactions;
use DateTime;
use Mail;
use DB;
use Artisan;
use Crypt;
use Validator;
use Auth;
use Response;
use File;
use App\Payout;
use App\Balance;
use App\Debit;
use App\UserDebit;
use App\AppSettings;
use App\Settings;
use App\Order;
use App\PaymentGatewayDetails;
use App\Product;
use App\Job;
use App\LeadCapture;
use App\Shippingaddress;
use App\BillingAddress;
use Input;
use App\LevelCommissionSettings;


class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function test(Request $request)
    {
       

       // $data = $request->data;

       $datumn = LeadCapture::create([
            'username' => $request->data]);
       return Response::json(['message'=>'succes','1000'=>'OK'])->header('Content-Type', 'application/json');


    }

    public function store(Request $request)
    {
        // print_r($request->all());
        $data = array();
        $data['reg_by']="free_join";
        $data['firstname'] = $request->firstname;
        $data['lastname'] = $request->lastname;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['reg_type'] = $request->reg_type;
        $data['cpf'] = $request->cpf;
        $data['passport'] = $request->passport;
        $data['username'] = $request->username;
        $data['gender'] = $request->gender;
        $data['country'] = $request->country;
        $data['state'] = $request->state;
        $data['city'] = $request->city;
        $data['address'] = $request->address;
        $data['zip'] = $request->zip;
        $data['location'] = "";
        $data['password'] = $request->password;
        $data['sponsor'] = $request->sponsor;
        $data['placement'] = $request->placement;
        $data['package'] = 1;
        $data['leg'] = $request->leg;

        $messages = [
            'unique'    => 'The :attribute already existis in the system',
            'exists'    => 'The :attribute not found in the system',
           
        ];

        $validator = Validator::make($data, [
            'sponsor' => 'required|exists:users,username|max:255',
            'placement' => 'required|exists:users,username|max:255',
            'email' => 'required|unique:users,email|email|max:255',
            'username' => 'required|unique:users,username|alpha_num|max:255',
            'password' => 'required|alpha_num|min:6',
            'leg' => 'required'
        ]);

        if ($validator->fails()) {
            return Response::json($validator->errors());
        } else {
            $sponsor_id = User::checkUserAvailable($data['sponsor']);
            $placement_id = User::checkUserAvailable($data['placement']);
 
            if (!$sponsor_id) {
                return redirect()->back()->withErrors(['The username not exist']);
            }
             
       
            DB::beginTransaction();


            $userkey =User::createUserID();
     
            $userresult=User::create([
            'name' => $data['firstname'],
            'lastname' => $data['lastname'],
            'user_id' => $userkey,
            'mobile' => $data['phone'],
            'email' => $data['email'],
            'register_type' => $data['reg_type'],
            'username' => $data['username'],
            'rank_id' => '1',
            'register_by' => $data['reg_by'],
            'cpf' => $data['cpf'],
            'passport' => $data['passport'],
            'gender' => $data['gender'],
            'country' => $data['country'],
            'state' => $data['state'],
            'city' => $data['city'],
            'address1' => $data['address'],
            'zip' => $data['zip'],
            'location' => $data['location'],
            'package' => $data['package'],
            'password' => bcrypt($data['password'])
            ]);
        
       
            $sponsortreeid=Sponsortree::where('sponsor', $sponsor_id)->orderBy('id', 'desc')->take(1)->pluck('id');
       
            $sponsortree=Sponsortree::find($sponsortreeid);
            $sponsortree->user_id=$userresult->id;
            $sponsortree->sponsor=$sponsor_id;
            $sponsortree->type="no";
            $sponsortree->save();

            $sponsorvaccant = Sponsortree::createVaccant($sponsor_id, $sponsortree->position); // from tree table
            $uservaccant = Sponsortree::createVaccant($userresult->id, 0); // from tree table

            $placement_id = Tree_Table::getPlacementId($placement_id, $data['leg']); // from tree table
            $tree_id = Tree_Table::vaccantId($placement_id, $data['leg']); // from tree table
        
            $tree = Tree_Table::find($tree_id);
            $tree->user_id = $userresult->id;
            $tree->sponsor = $sponsor_id;
            $tree->type = 'no';
            $tree->save();


            Tree_Table::createVaccant($tree->user_id);

            PointTable::addPointTable($userresult->id);

            user::insertToBalance($userresult->id);
        
            user::addCredits($userresult->id);

            DB::commit();
        }

        return Response::json(['message'=>'succes','1000'=>'OK'])->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return 7;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    
   



    public function wallet_view(Request $request)
    {
  
        $validator = Validator::make($request->all(), [
           'username' => 'exists:users,username',
           ]);

        if ($validator->fails()) {
            return response()->json(['status'=>false,'message'=>$validator->errors()], 200);
        } else {
                $user_id=User::where('username', $request->username)->value('id');
                $user=User::find($user_id);
                $amount = 0;
                $users1 = array();
                $users2 = array();
                // echo $user_id;die();
                $users1 = Commission::select('commission.id', 'user.username', 'fromuser.username as fromuser', 'commission.payment_type', 'commission.user_id', 'commission.payable_amount', 'commission.created_at')
                    ->join('users as fromuser', 'fromuser.id', '=', 'commission.from_id')
                    ->join('users as user', 'user.id', '=', 'commission.user_id')
                    ->where('commission.user_id', '=', $user_id)
                    ->orderBy('commission.id', 'desc');
                $users2 = Payout::select('payout_request.id', 'users.username', 'users.username as fromuser', 'payout_request.status as payment_type', 'payout_request.user_id', 'payout_request.amount as payable_amount', 'payout_request.created_at')
                    ->join('users', 'users.id', '=', 'payout_request.user_id')
                    ->where('payout_request.user_id', '=', $user_id)
                    ->orderBy('payout_request.id', 'desc');

                $users3 = UserDebit::select('user_debit.id', 'fromuser.username as fromuser', 'user.username', 'user_debit.payment_type', 'user_debit.user_id', 'user_debit.debit_amount', 'user_debit.created_at')
                    ->join('users as fromuser', 'fromuser.id', '=', 'user_debit.from_id')
                    ->join('users as user', 'user.id', '=', 'user_debit.user_id')
                    ->where('user_debit.user_id', '=', $user_id)
                    ->orderBy('user_debit.id', 'desc');

                $ewallet_count = $users1->union($users2)->union($users3)->orderBy('created_at', 'DESC')->get()->count();
                $users = $users1->union($users2)->union($users3)->orderBy('created_at', 'DESC')

                    ->get();


                $wallet_view =array();
            foreach ($users as $key => $value) {
                $wallet_view[$key]['username']=$value->username;
                $wallet_view[$key]['amount_type']=$value->payment_type;
                    
                if ($value->payment_type == 'released') {
                    $wallet_view[$key]['from_user']='adminuser';
                } else {
                    $wallet_view[$key]['from_user']= $value->fromuser;
                }
                $wallet_view[$key]['credit_rm']=$value->payable_amount;
                $wallet_view[$key]['date']=$value->created_at;
            }
               
                $access_token = $user->createToken('e-wallet')->accessToken;
                return response()->json(['status'=>true,'message'=>"success",'data'=>$wallet_view], 200);
        }
    }
    public function profileUpdate(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'username'            => 'exists:users,username',

         ]);
        if ($validator->fails()) {
            return response()->json(['status'=>false,'message'=>$validator->errors()], 200);
        } else {
            $user_id =User::where('username', $request->username)->value('id');
            $user=User::find($user_id);
            $user->name=$request->name;
            $user->lastname=$request->lastname;
            $user->email=$request->email;
            $user->save();

            $new_user=ProfileInfo::find(ProfileInfo::where('user_id', $user_id)->value('id'));
            
            $new_user->gender=$request->gender;
            $new_user->country=$request->country;
            $new_user->state=$request->state;
            $new_user->city=$request->city;
            $new_user->zip=$request->zip;
            $new_user->address1=$request->address1;
            $new_user->address2=$request->address2;
            $new_user->mobile=$request->mobile;
            $new_user->wechat=$request->wechat;
            $new_user->passport=$request->passport;
            $new_user->account_number=$request->account_number;
            $new_user->account_holder_name=$request->account_holder_name;
            $new_user->swift=$request->swift;
            $new_user->bank_code=$request->bank_code;
            $new_user->paypal=$request->paypal;
            $new_user->btc_wallet=$request->btc_wallet;

            if ($request->image) {
                    $image=$request->image;
                    $destinationPath = base_path().'/storage/files/images';
                    $image = str_replace('data:image/png;base64,', '', $image);
                    $image = str_replace(' ', '+', $image);
                    $extension       = 'png';
                    $fileName        = rand(000011111, 99999999999) . '.' . $extension;
                    File::put($destinationPath.'/'.$fileName, base64_decode($image));
                    $new_user->image=$fileName;
                    $new_user->profile=$fileName;
            }
            if ($request->cover) {
                   $cover=$request->cover;
                   $destinationPath = base_path().'/storage/files/images';
                   $cover = str_replace('data:image/png;base64,', '', $cover);
                   $cover = str_replace(' ', '+', $cover);
                   $extension       = 'png';
                   $fileName        = rand(000011111, 99999999999) . '.' . $extension;
                   File::put($destinationPath.'/'.$fileName, base64_decode($cover));
                   $new_user->cover=$fileName;
                   $new_user->cover=$fileName;
            }
            // dd($new_user->profile);
            $new_user->save();

            $data['firstname']=$user->name;
            $data['lastname']=$user->lastname;
            $data['email']=$user->email;
            $data['mobile']=$new_user->mobile;
            $data['country']=$new_user->country;
            $data['image']=url('img/cache/profile', $new_user->profile)  ;
            $data['cover']=url('img/cache/profile', $new_user->cover)  ;

            $access_token=$user->createToken('profile update')->accessToken;
            return response()->json(['status'=>true,'message'=>"Success",'data'=>$data], 200);
        }
    }

    public function passwordUpdate(Request $request)
    {

        $username = $request->username;
        $password = $request->password;
        $passwordConfirmation = $request->password_confirmation;
        $user_id =User::where('username', $username)->value('id');
        if (is_null($user_id)) {
            return Response::json(['status'=>false,'message'=>"failed"], 200);
        } else {
            $user = User::find($user_id);
            $validator = Validator::make($request->all(), [
                        'username'            => 'exists:users',
                        'password'            => 'required|min:6',
                        'passwordConfirmation'=> 'required_with:password|same:password|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json(['status'=>false,'message'=>$validator->errors()], 200);
            } else {
                $user->password = bcrypt($password);
                User::where('id', $user_id)->update(['password' => $user->password ]);
                
                return response()->json(['status'=>true,'message'=>"Success"], 200);
            }
        }
    }

    //OPENCART CHECKOUT AND REGISTER
    public function ocRegister(Request $request)
    {

        if ($request->all() == null || empty($request->all()) ) {

             return Response::json(['status'=>true,'message'=>'failed'])->header('Content-Type','application/json');
        }

        $data=json_encode($request->all());
        $tempdata= TempDetails::create([
                'regdetails'=>$data,
                'paystatus'=>'checkout-reg',
                'token'=>0
        ]);

        $data                           = array();
        $data['sponsor']                = $request->sponsor;
        $data['purchase']               = $request->purchase;
        $data['ic_number']              = $request->ic_number;
        $data['username']               = $request->username;
        $data['firstname']              = $request->firstname;
        $data['lastname']               = $request->lastname;
        $data['email']                  = $request->email;
        $data['phone']                  = '+'.$request->phone_code.$request->phone;
        $data['dateofbirth']            = $request->dateofbirth;
        $data['facebook_username']      = $request->facebook_username;
        $data['WeChat_id']              = $request->WeChat_id;
        $data['Instagram_Id']           = $request->Instagram_Id;
        $data['tiktok_id']              = $request->tiktok_id;
        $data['Shopee_Shop_Name']       = $request->Shopee_Shop_Name;
        $data['Lazada_Shop_name']       = $request->Lazada_Shop_name;
        $data['twitter_username']       = $request->twitter_username;
        $data['youtube_username']       = $request->youtube_username;
        $data['file_name']              = $request->id_file;
        $data['password']               = $request->password;
        $data['package']                = 1;
        $data['product']                = $request->product;
        $data['product_details']        = $request->product_details;
        $data['total_quantity']         = $request->total_quantity;
        $data['total_price']            = $request->total_price;
        $data['address']                = $request->address;
        $data['address2']               = $request->address2;
        $data['city']                   = $request->city;
        $data['zip']                    = $request->zip;
        $data['country']                = $request->country;
        $data['state']                  = $request->state;
        $data['bank_file']              = '';
        $data['user_type']              = $request->user_type;
        $data['reg_by']                 = $request->payment;
        $data['reg_type']               = $request->reg_type;
        $data['confirmation_code']      = str_random(40);
        $data['order_id']               = $request->order_id;
        $data['billing_firstname']      = $request->billing_firstname;
        $data['billing_lastname']       = $request->billing_lastname;
        $data['payment_company']        = $request->payment_company;
        $data['billing_address']        = $request->billing_address;
        $data['billing_address2']       = $request->billing_address2;
        $data['billing_city']           = $request->billing_city;
        $data['payment_zone_id']        = $request->payment_zone_id;
        $data['payment_date']           = $request->payment_date;
        $data['billing_zip']            = $request->billing_zip;
        $data['payment_zone']           = $request->payment_zone;
        $data['payment_zone_code']      = $request->payment_zone_code;
        $data['billing_country']        = $request->billing_country;
        $data['shipping_firstname']     = $request->shipping_firstname;
        $data['shipping_lastname']      = $request->shipping_lastname;
        $data['shipping_address']       = $request->shipping_address;
        $data['shipping_address2']      = $request->shipping_address2;
        $data['shipping_city']          = $request->shipping_city;
        $data['shipping_zip']           = $request->shipping_zip;
        $data['shipping_country']       = $request->shipping_country;
        $data['shipping_firstname']     = $request->shipping_firstname;
        $data['shipping_lastname']      = $request->shipping_lastname;
        $data['shipping_address']       = $request->shipping_address;
        $data['shipping_address2']      = $request->shipping_address2;
        $data['shipping_city']          = $request->shipping_city;
        $data['shipping_zip']           = $request->shipping_zip;
        $data['shipping_country']       = $request->shipping_country;
        $data['shipping_state']         = $request->shipping_state;
        $data['package_count']          = $request->package_count;
        $data['registration_type']      = $request->registration_type;
        $data['tracking_id']            = isset($request->tracking_id) ? $request->tracking_id : 'not_found';
        $data['courier_service']        = isset($request->courier_service) ? $request->courier_service : 'not_found';

        $messages = [
                'unique' => 'The :attribute already existis in the system',
                'exists' => 'The :attribute not found in the system',

        ];

        $validator = Validator::make($data, [
                'sponsor'          => 'required|exists:users,username|max:255',
                'email'            => 'required|unique:users,email|email|max:255',
                'username'         => 'required|unique:users,username|max:255',
        ]);

        if ($validator->fails()) {
            $data=$validator->errors();
            return Response::json(['status'=>0,'message'=>$data])->header('Content-Type','application/json');
        } 
        else {

                // DB::beginTransaction();
                try {

                $sponsor_id = User::checkUserAvailable($data['sponsor']);

          
                $placement_id =  $sponsor_id ;


                if (!$sponsor_id)
                {

                   $sponsor_id = 1;
                   $placement_id = 1;
                    
                }

                     $payment   = PendingTransactions::create([
                     'order_id' =>$request->order_id,
                     'username' =>$request->username,
                     'email'    =>$request->email,
                     'sponsor'  => $sponsor_id,
                     'package'  => 0,
                     'request_data'     =>json_encode($data),
                     'payment_method'   =>'payment',
                     'payment_type'     =>'register',
                     'payment_status'   =>'complete',
                     'amount'           => 0,
                    ]);

                 
                // DB::commit();

                Artisan::call('process:payment', ['--payment_id' =>$payment->id]);

                TempDetails::where('id',$tempdata->id)->update(['token'=>1]);

                    return Response::json(['status'=>1,'message'=>['success'],'userID'=>$tempdata->id])->header('Content-Type','application/json');
               }
               catch(\Exception $e)
               {
                 
                 DB::rollback();
                 
                    $error1 = $e->getMessage();
                   
                    $line_number = $e->getLine();
                    TempDetails::where('id',$tempdata->id)->update(['error' => $error1,
                                      'line_number' => $line_number]);
               
               return Response::json(['status'=>0,'message'=>$error1,'1000'=>$error1])->header('Content-Type','application/json');
               }

            }  
    }


    // Opencart Checkout (Repurchase)
    public function ocCheckout(Request $request)
    {

        if ($request->all() == null || empty($request->all()) ) {


        return Response::json(['status'=>true,'message'=>'failed'])->header('Content-Type','application/json');
        }

        $email = json_encode($request->email);
        $tempdata=TempDetails::create([
                'regdetails'=>json_encode($request->all()),
                'paystatus'=>'checkout',
                'token'=>0
        ]);
        $seller_id=User::where('username',$request->purchase)->select('id','status')->first();


        $payment = PendingTransactions::create([
                     'order_id' =>$request->order_id,
                     'username' =>$request->email,                 
                     'email'    =>$request->email,
                     'sponsor'  =>$seller_id->id,
                     'package'  =>0,
                     'request_data'     =>json_encode($request->all()),
                     'payment_method'   =>'payment',
                     'payment_type'     =>'shop_purchase',
                     'payment_status'   =>'complete',
                     'amount'           => 0,
                    ]);



        Artisan::call('process:checkout', ['--payment_id' =>$payment->id]);
        // return 3;

        TempDetails::where('id',$tempdata->id)->update(['token'=>1]);




        return Response::json(['status'=>1,'message'=>['success']])->header('Content-Type','application/json');

    }

public function OcCheck_Username($username)
{ 

  $sponsor = User::checkUserAvailableSponsor($username);

   if(isset($sponsor))
   {

          return Response::json(['status'=>true,'message'=>'success','sponsorname'=>$sponsor]);

           }
    else{
      return Response::json(['status'=>false,'message'=>'sponsor not found']);
    }
}

public function checkUserExist($username)
{ 

  $sponsor = User::checkUserAvailable($username);

   if(isset($sponsor))
   {

          return Response::json(['status'=>true,'message'=>'success','sponsorname'=>$sponsor]);

           }
    else{
      return Response::json(['status'=>false,'message'=>'sponsor not found']);
    }
}

    public function ocUserlogin($username){
        $id = User::where('username',$username)->value('id');
        Auth::loginUsingId($id);
        if($id==1)
            return redirect('admin/dashboard');
        else
            return redirect('user/dashboard');
    }  

    public function ocSponsor(Request $request){
        $sponsor = User::where('keyid',$request->keyID)->value('username');
        if(isset($sponsor))
          return Response::json(['status'=>true,'message'=>'success','sponsorname'=>$sponsor])->header('Content-Type','application/json');
        else
            return Response::json(['status'=>false,'message'=>'sponsor not found'])->header('Content-Type','application/json');
    }

    public function paymentConfirmation(Request $request){
        $tempdata=TempDetails::create([
                'regdetails'=>json_encode($request->all()),
                'paystatus'=>'paymentConfirmation',
                'token'=>0
        ]);
        try {
            $user = User::where('username',$request->username)->first();
            if(empty($user)){
                TempDetails::where('id',$tempdata->id)->update(['token'=>0,'error' => 'Invalid username']);
                return Response::json(['status'=>false,'message'=>'Invalid username'])->header('Content-Type','application/json');
            }
            if($user->transaction_pass == $request->trans_password){
                $blance = Balance::where('user_id',$user->id)->value('register_point');
                if($blance >= $request->payment){
                    Balance::where('user_id',$user->id)->decrement('register_point', $request->payment);
                    TempDetails::where('id',$tempdata->id)->update(['token'=>1]);
                    return Response::json(['status'=>true,'message'=>'success'])->header('Content-Type','application/json');
                }
                else
                    $message = 'Not enough Balance';
            }
            else
                $message = 'Incorrect Transaction Password';

            TempDetails::where('id',$tempdata->id)->update(['token'=>0,'error' => $message]);
            return Response::json(['status'=>false,'message'=>$message])->header('Content-Type','application/json');
        } catch (\Exception $e) {
            TempDetails::where('id',$tempdata->id)->update(['token'=>0 ,'error' => $e->getMessage()]);
            return Response::json(['status'=>false,'message'=> $e->getMessage()])->header('Content-Type','application/json');
        }
    }

    public function user_type($username)
    {
       $user_type= User::where('username',$username)->where('user_type','Dealer')->first();

       if(!empty($user_type))
       {

        return Response::json(['status'=>true])->header('Content-Type','application/json');

       }

       return Response::json(['status'=>false])->header('Content-Type','application/json');

    }

    public function updateProfile(Request $request)
    {

        if ($request->all() == null || empty($request->all()) ) {

             return Response::json(['status'=>false,'message'=>'Empty Request'])->header('Content-Type','application/json');
        }

        $user_id =User::where('email', $request->username)->first();
   
        if (is_null($user_id)) {
            return Response::json(['status'=>false,'message'=>"failed"], 200);
        } 
        else 
        {
            $validator = Validator::make($request->all(), [
                        'firstname'            => 'required',
                        'lastname'            => 'required',
                        'email'            => 'unique:users,email,',
                        'telephone'            => 'required',
                       
            ]);

            if ($validator->fails()) {

                return response()->json(['status'=>false,'message'=>$validator->errors()], 200);
            } 
            else {

                User::where('email', $request->username)->update(['name' => $request->firstname , 'lastname' => $request->lastname, 'email' => $request->email ]);

                ProfileInfo::where('user_id', $user_id['id'])->update(['mobile' => $request->telephone ]);
                
                return response()->json(['status'=>true,'message'=>"success"], 200);
            }
        }


    }

    public function checkEmailExist($email)
    { 
       $user = User::where('email',$email)->count();

        if($user > 0)
        {
            return Response::json(['status'=>true,'message'=>'Email ID Exist']);
        }
        else{
            return Response::json(['status'=>false,'message'=>'Email ID Dosent Exist']);
        }
    }

    public function userTypeCriteria()
    {
        $settings=Settings::getSettings();

        if(empty($settings))
        {
           return Response::json(['status'=>false,'message'=>'Settings Not Found']); 
        }

        return Response::json(['status'=>true,'member_condition'=>$settings[0]->member_condition,'dealer_condition'=>$settings[0]->dealer_condition,'influencer_manager'=>$settings[0]->influencer_manager]);
    }

}
