<?php

namespace App;

use DB;
use Auth;
use Cache;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Crypt;
use Html;
use Storage;
use Profileinfo;
use DateTime;
use App\Commission;
use App\PointTable;
use App\Balance;
use App\UsertypeHistory;
use App\LevelCommissionSettings;
// use ProductHistory;
use App\Jobs\SendEmail;
use App\ErrorLog;

class User extends Authenticatable
{

    use SoftDeletes;
    use Notifiable,HasApiTokens;

    protected $dates = ['deleted_at'];
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['user_id','email', 'password','username','sponsor','rank_id','register_by','name','lastname','transaction_pass','created_at','confirmation_code','confirmed','shipping_country','shipping_state','black_list','active','hypperwallet_token','hypperwalletid','rank_update_date','enable_2fa','customer_id','keyid','sponsor_id','leg','expiry_date','weekly_payout','admin','user_type','status','influencer_type','p_sales_status'];

    

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

   //By Aslam
    public static function isOnline($id)
    {
        // dd(Cache::get('user-is-online-' . $this->id));
        return Cache::get('user-is-online-' . $id);
    }


    //RELATIONSHIPS - Added By Aslam
    public function profile_info()
    {
        return $this->hasOne('App\ProfileInfo', 'user_id', 'id');
    }

 

    public function sponsor_tree()
    {
        return $this->hasOne('App\Sponsortree', 'user_id', 'id');
    }


    public function tree_table()
    {
        return $this->hasOne('App\Tree_Table', 'user_id', 'id');
    }


    public function purchase_history()
    {
        return $this->hasMany('App\PurchaseHistory', 'user_id', 'id');
    }

    public function packages()
    {
        return $this->hasOne('App\Packages', 'user_id', 'id');
    }

    public function activity()
    {
        return $this->hasMany('App\Activity', 'user_id', 'id');
    }




    public function ticket()
    {
        return $this->hasMany('App\Models\Helpdesk\Ticket\Ticket', 'user_id', 'id');
    }

    public function reply()
    {
        return $this->hasMany('App\Models\Helpdesk\Ticket\TicketReply', 'user_id', 'id');
    }

    public function point()
    {
        return $this->hasOne('App\PointTable', 'user_id', 'id');
    }

    public function rank()
    {
        return $this->belongsTo('App\Ranksetting','rank_id','id');
    }



    public static function createUserID()
    {

        $user_id = "ID". str_random(7);

        if (self::where('user_id', $user_id)->count()  == 0) {
            return $user_id ;
        }
        return self::createUserID();
    }

    public static function checkUserAvailable($username)
     {
       $users = DB::table('users')->where('username', $username)->first();

       if(!$users)
        return;
       return $users->username;
    }

    public static function checkUserAvailableSponsor($username)
     {
       $users = DB::table('users')->where('username', $username)
       ->where('user_type','!=','Customer')
       ->first();

       if(!$users)
        return;
       return $users->username;
    }

    public function getSponsor($user_id)
    {
         $user_id =  Tree_Table::where('sponsor', $sponsor_id)->where("leg", $leg)->value('user_id');
    }
    public static function getSponsorId($sponsor_name)
    {
         return self::where('username', $sponsor_name)->value('id');
    }

    public static function takeUserId($user_name)
    {
         return self::where('username', $user_name)->value('id');
    }

    public static function getSponsorName($user_id)
    {
        $sponsor_id =  Tree_Table::where('user_id', $user_id)->value('sponsor');
        return self::userIdToName($sponsor_id);
    }
    public static function userIdToName($user_id)
    {
        $user_name =  self::where('id', $user_id)->value('username');
        return $user_name;
    }
    
    public static function userNameToId($username)
    {
        $user_id =  self::where('username', $username)->value('id');
        return $user_id;
    }
    public static function getStates($id)
    {
          $countries = DB::select('select * from life_state where country_id = '+$id);
    }
    public static function countryIdToName($country_id)
    {
          $country_name =  DB::table('countries')->where('id', $country_id)->value('name');
          return $country_name;
    }
    public static function stateIdToName($state_id)
    {
          $state_name =  DB::table('life_state')->where('State_Id', $state_id)->value('State_Name');
          return $state_name;
    }
    public static function getPassword($user_id)
    {
         $password = DB::table('users')->where('user_id', $user_id)->value('password');
         return $password;
    }
    public static function updatePassword($user_id, $new_password)
    {
         DB::table('users')->where('id', $user_id)->update(array('password' => $new_password));
    }
   
   
    public static function checkUserType($user_id)
    {
         $type_id = self::where('id', $user_id)->value('admin');
        if ($type_id == 1) {
             return "admin";
        } else {
            return "user";
        }
    }
    public static function getNewUsers()
    {
        $user_type = self::checkUserType(Auth::user()->id);
        $admin_flag = 0;
        if ($user_type == 'admin') {
            $new_users = DB::table('users')
                            ->join('profile_infos', 'profile_infos.user_id', '=', 'users.id')
                           ->where('admin', $admin_flag)
                           ->orderBy('created_at', 'desc')
                           ->limit(8)
                           ->get();
        } else {
            $new_users = DB::table('users')
                            ->join('profile_infos', 'profile_infos.user_id', '=', 'users.id')
                            ->join('tree_table', 'tree_table.user_id', '=', 'users.id')
                            ->where('tree_table.sponsor', '=', Auth::user()->id)
                            ->limit(8)
                            ->get();
        }
        //print_r($new_users);die();
        $loop = count($new_users);
        for ($i = 0; $i < $loop; $i ++) {
           //echo $new_users[$i]->country;die();
            $new_users[$i]->country_name =  null ;//self::getCitizen($new_users[$i]->country);
        }
        return $new_users;
    }
    public static function getCitizen($id)
    {
        return DB::table('countries')->where('id', $id)->pluck('citizenship');
    }
    public static function insertToBalance($user_id)
    {
        DB::table('user_balance')->insert(array('user_id'=>$user_id,'balance' => 0));
    }
    public static function upadteUserBalance($user_id, $sponsor_commisions)
    {
        DB::table('user_balance')->where('user_id', $user_id)->increment('balance', $sponsor_commisions);
    }

    public static function getUserDetails($id)
    {
        return DB::table('users')->where('id', $id)->get();
    }
    public static function getAdminEmail()
    {
        return DB::table('users')->where('admin', 1)->pluck('email');
    }
    public static function getAdminId()
    {
        return DB::table('users')->where('admin', 1)->pluck('id');
    }
    public static function checkEmailAvailable($email)
    {
        $user_email = DB::table('users')->where('email', $email)->pluck('email');
        if (!$user_email) {
            return 'available';
        }
    }
    public static function getUserId($username)
    {
        $user_id = DB::table('users')->where('username', $username)->pluck('id');
        if (!$user_id) {
            return 'available';
        }
    }
    public static function getUsersForDashboardGraph()
    {
      //return Self::getDownlineUsers(Auth::user()->id);
        $downline_users = array();
        return self::getDownlineUsers(1, 1, $downline_users);
      //return Auth::user()->id;
    }
    public static function getDownlineUsers($user_id, $index, $downline_users = array())
    {
      //$u = self::usersDownline(1,1);
      //print_r($u);die();
        $users = DB::table('tree_table')->where('sponsor', $user_id)->where('type', 'yes')->get();
        for ($i=0; $i<count($users); $i++) {
            $downline_users[$index]['user_id'] = $users[$i]->user_id;
            $downline_users[$index]['join_month'] = date("m", strtotime($users[$i]->created_at));
            $index++;
            //$d =date("m", strtotime($downline_users[$index-1]['join_date'] ));
        }
        $count_users = count($downline_users);
        $month_count;
        for ($k=1; $k<13; $k++) {
            $month_count[$k]=0;
        }
        for ($j = 1; $j <= $count_users; $j++) {
            if ($downline_users[$j]['join_month'] == 1) {
                $month_count[1] += 1;
            } elseif ($downline_users[$j]['join_month'] == 2) {
                $month_count[2] += 1;
            } elseif ($downline_users[$j]['join_month'] == 3) {
                $month_count[3] += 1;
            } elseif ($downline_users[$j]['join_month'] == 4) {
                $month_count[4] += 1;
            } elseif ($downline_users[$j]['join_month'] == 5) {
                $month_count[5] += 1;
            } elseif ($downline_users[$j]['join_month'] == 6) {
                $month_count[6] += 1;
            } elseif ($downline_users[$j]['join_month'] == 7) {
                $month_count[7] += 1;
            } elseif ($downline_users[$j]['join_month'] == 8) {
                $month_count[8] += 1;
            } elseif ($downline_users[$j]['join_month'] == 9) {
                $month_count[9] += 1;
            } elseif ($downline_users[$j]['join_month'] == 10) {
                $month_count[10] += 1;
            } elseif ($downline_users[$j]['join_month'] == 11) {
                $month_count[11] += 1;
            } else {
                $month_count[$j] += 1;
            }
        }
        print_r($downline_users);
        die();
        $month = $month_count[1].",".$month_count[2].",".$month_count[3].",".$month_count[4].",".$month_count[5].",".$month_count[6]
        .",".$month_count[7].",".$month_count[8].",".$month_count[9].",".$month_count[10].",".$month_count[11].",".$month_count[12];
        print_r($month);//die();
    }
    public static function getUserPercentage()
    {
        $user_id = Auth::user()->id;
        $all_usercount = self::count();
        $ref_usercount = Tree_Table::where('sponsor', $user_id)->where('type', 'yes')->count();
        $per_user = ($ref_usercount/$all_usercount)*100;
        return $per_user;
    }
    #getmeber data
    public static function getAllMemberDetails($uname)
    {
        return  DB::table('users')->select("*")->where('username', '%like%', $uname)->get();
    }

    public static function addCredits($user_id)
    {

        $user = self::find($user_id);

        $package = Packages::find($user->package) ;

        $user->credits =  $package->stock_products ;

        return $user->save();
    }


    public static function getMonthUsers($user)
    {
        $result = array();

        for ($i=1; $i<=12; $i++) {
            echo $count = self::whereMonth('created_at', '=', $i)->whereYear('created_at', '=', date('Y'))->count();
            echo ",";
          // array_push($result,$count);
        }
    }

    public static function getPackagedUsers($package_id)
    {
      
        return self::where('users.package', $package_id)
           ->join('sponsortree', 'sponsortree.user_id', '=', 'users.id')
           ->join('packages', 'packages.id', '=', 'users.package')
           ->join('users as sponsor', 'sponsor.id', '=', 'sponsortree.sponsor')
           ->select('users.*', 'sponsor.username as sponsorusername', 'packages.package as packagename')
           ->get();
    }





   

    public static function hoverCard($user_id)
    {

               
                $user =    User::where('id', $user_id)->with('point')->first();
        
                $username =   User::where('id', $user_id)->value('username');
                $accessid         = Crypt::encrypt($user_id);
                $package_id   = ProfileModel::where('user_id', $user_id)->value('package');
                $package_name = Packages::find($package_id)->value('package');

                $content = '' . Html::image(route('imagecache', ['template' => 'profile', 'filename' => self::profilePhoto($username)]), $username, array('style' => 'max-width:50px;','data-accessid'=>$accessid)) . '';

                $coverPhoto =  Html::image(route('imagecache', ['template' => 'large', 'filename' => self::coverPhoto($username)]), $username, array('style' => '','data-accessid'=>$accessid));

                

                $info    = "
                <div class='hovercardouter'>
                <div class='hovercardinner'>
                    
                            <div class='covercardholder'>
                                $coverPhoto
                                <div class='cardbackgroundgd'>
                            </div>
                            </div>
                            
                        
                    <div class='cardprimeinfo' >
                        <div class='cardprimeinfohold' >
                            
                                <div class='ellipsis cardusername'>
                                    {$user->username}
                                </div>
                           
                        </div>
                        <ul class='cardsecondaryinfo'>
                            <li class='cardrankname'>
                                <span class='cardkey'>Rank</span> :  <span class='cardvalue'>{$user->rank_name}</span>
                            </li class='cardpackagename'>                            
                            <li>
                                <span class='cardkey'>Package</span> : <span class='cardvalue'>{$package_name}</span>
                            </li>                            
                            <li class='cardtopupcount'>
                                <span class='cardkey'>Top Ups</span> : <span class='cardvalue'>".PurchaseHistory::where('user_id', '=', $user_id)->sum('count')."</span>
                            </li>                            
                            <li class='cardrsbalance'>
                                <span class='cardkey'>RS balance</span> : <span class='cardvalue'>{$user->revenue_share}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <table cellpadding='0' cellspacing='0' class='cardprofcontenttbl' >
                    <tbody>
                        <tr>
                            <td rowspan='2' valign='top'>
                               
                                    <div class='cardprofpicholder'>
                                        $content
                                    </div>
                              
                            </td>
                        </tr>
                        <tr valign='bottom'>
                            <td class='cardsecinfo-list-holder'>
                                <div class=''>
                                    <ul class='cardsecinfo-list'>
                                        <li>
                                            
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class='cardpillforholder'>
                </div>
                <div class='carddetails'>
             
                
                
      
                </div>
                </div>";


        return $info;
    }


    public static function profilePhoto($user_name)
    {
        $user  = User::where('username', $user_name)->with('profile_info')->first();
        $image = $user->profile_info->profile;
        if (!Storage::disk('images')->exists($image)) {
            $image = 'avatar-big.png';
        }
        if (!$image) {
            $image = 'avatar-big.png';
        }

        return $image;
    }

    public static function coverPhoto($user_name)
    {
        $user  = User::where('username', $user_name)->with('profile_info')->first();
        $image = $user->profile_info->cover;
        if (!Storage::disk('images')->exists($image)) {
            $image = 'cover.jpg';
        }
        if (!$image) {
            $image = 'cover.jpg';
        }
        return $image;
    }


 
    public static function add($data, $sponsor_id,$pending_id,$reg_type)
    {

        DB::beginTransaction();

        try {

            $userresult = self::create([
                'name'              => $data['firstname'],
                'lastname'          => $data['lastname'],
                'email'             => $data['email'],
                'username'          => $data['username'],
                'rank_id'           => '1',
                'register_by'       => $data['sponsor'],               
                'password'          => bcrypt($data['password']),
                'confirmation_code' => $data['confirmation_code'],
                'keyid'             => '',
                'sponsor_id'        => $sponsor_id,
                'user_type'         => $data['user_type'],
         
            ]);

            $userProfile = ProfileModel::create([
                'user_id'       => $userresult->id,
                'passport'      => $data['ic_number'],
                'id_file'       => $data['file_name'],
                'dateofbirth'   => $data['dateofbirth'],
                'mobile'        => $data['phone'],
                'country'       => $data['country'],
                'state'         => $data['state'],
                'city'          => $data['city'],
                'address1'      => $data['address'], 
                'address2'      => $data['address2'],
                'zip'           => $data['zip'],
                'package'       => $data['package'],
                'facebook'      => $data['facebook_username'],
                'wechat'        => $data['WeChat_id'],
                'instagram'     => $data['Instagram_Id'], 
                'tiktok'        => $data['tiktok_id'],
                'Shopee_Shop_Name'        => $data['Shopee_Shop_Name'],
                'Lazada_Shop_name'        => $data['Lazada_Shop_name'],
                'twitter'                 => $data['twitter_username'],
                'youtube'                 => $data['youtube_username'],


            ]);

            $seller_id=User::where('username',$data['purchase'])->select('id','status','p_sales_status')->first();
            $total_amount_without_extra_charges = 0;
            foreach($data['product'] as $products) {           

                $pur = PurchaseHistory::create([
                    'user_id'             => $userresult->id,
                    'product_name'        => $products['name'],
                    'purchase_user_id'    => $userresult->id,
                    'package_id'          => 1,
                    'package_purchase_id' => 1,
                    'seller_id'           => $seller_id->id,
                    'order_status'        => $data['order_id'],
                    'bv'                  => $data['package_count'],
                    'count'               => $products['quantity'],
                    'total_amount'        => $products['total_price'],
                    'invoice_id'          => $data['order_id'],
                    'pay_by'              => 'COD',
                    'purchase_type'       =>'registration',
                    'sales_status'        => "yes",
                    'payment_date'        => $data['payment_date'],
                    'shipping_country'    => $data['shipping_country'],
                    'type'                => $products['type'],
                    'tracking_id'         => $data['tracking_id'],
                    'courier_service'     => $data['courier_service'],
                ]);
                $total_amount_without_extra_charges+=$products['total_price']; //added by archana
            }

            PendingTransactions::where('id',$pending_id)->update(['Purchase_id' => $pur->id]);
            PointTable::addPointTable($userresult->id);
            Balance::addbalance($userresult->id);


            // if ($data['user_type'] == 'Member') {     //commented by archana          
            if ($data['user_type'] <> 'Customer') {       

                Sponsortree::where('user_id',$sponsor_id)->increment('member_count',1);
                $sponsortreeid = Sponsortree::where('sponsor', $sponsor_id)->where('type', 'vaccant')
                                ->orderBy('id', 'desc')->take(1)->value('id');
                $sponsortree          = Sponsortree::find($sponsortreeid);
                $sponsortree->user_id = $userresult->id;
                $sponsortree->sponsor = $sponsor_id;
                $sponsortree->type    = "yes";
                $sponsortree->save();

                $sponsorvaccant = Sponsortree::createVaccant($sponsor_id, $sponsortree->position);
                $uservaccant = Sponsortree::createVaccant($userresult->id, 0);

            }

            PointTable::where('user_id',$seller_id->id)->increment('pv',$data['total_price']);      
            PointHistory::addPointHistoryTable($seller_id->id,$seller_id->id, $data['total_price'], 'L','purchase');
            PointTable::updatePoint($data['total_price'],$seller_id->id);

            // if ($data['total_price'] > 0 && $seller_id->id > 1) { //commented by archana
            if ($total_amount_without_extra_charges > 0 && $seller_id->id > 1) { //added by archana

                $total_amount = 0; 
                $settings_data = Settings::find(1);
                if($seller_id->p_sales_status == 1)//if user reached the limit previously
                    // $total_amount = $products['total_price']; //commented by archana
                    $total_amount = $total_amount_without_extra_charges; //added by archana
                else//if user does'nt reached the minimum limit previously
                {
                    $min_p_sales = $settings_data->min_p_sales;
                    $amount = PurchaseHistory::where('seller_id',$seller_id->id)->sum('total_amount');
                    if ($amount >= $min_p_sales){
                        $total_amount = $amount;
                        $seller_id->p_sales_status = 1;
                        $seller_id->save();
                    } 
                }

                if($total_amount > 0)
                    Commission::personalSalesBonus($seller_id->id,$userresult->id,$total_amount,$settings_data->p_sales_per);

                SELF::lastmonthSales($seller_id,$settings_data->min_p_sales);
                $lev_settings = LevelCommissionSettings::first();
                Commission::levelBonusNew($seller_id->id,$userresult->id,$lev_settings);

                $value_array = ['seller' =>$seller_id->id,'user_id'=>$userresult->id,
                                'registration_type'=>$data['registration_type'],
                                'amount'=>$products['total_price'],'user_type'=>$data['user_type'],
                                'settings'=>$settings_data];

                Commission::userstatuUpgradeNew($value_array);

            }
            if ($sponsor_id > 1) {//no bonus to admin always
                Commission::referalBonus($sponsor_id,$userresult->id);
            }


         
            DB::commit();

            return $userresult;
        } 
        catch (Exception $e) {
            DB::rollback();
            $error1 = $e->getMessage();
            $line_number = $e->getLine();
            $error = ErrorLog::create([
                'from' =>"user.php - add function",
                'error'       => $error1,
                'line_number' => $line_number
            ]);
            return false;
        }
    }
    public static function lastmonthSales($seller_id,$min_sale)
    {
        $crnt_mnth_sale = PurchaseHistory::where('seller_id',$seller_id->id)
            ->whereYear('created_at',date('Y'))
            // ->whereMonth('created_at',date('m',strtotime('-0 months'))) //commented by archana
            ->whereBetween('created_at',[date('Y-m-d H:i:s', strtotime('-0 months')),date('Y-m-d H:i:s')]) //added by archana
            ->sum('total_amount');
        if ($crnt_mnth_sale >= $min_sale && $seller_id->status == 'inactive') { 
                User::where('id',$seller_id->id)->update(['status'=>'active']);
        }   
    }

     public static function influenceradd($data, $sponsor_id)
    {
        DB::beginTransaction();

        try
        {
            $total=0;
            // if coming user is a member or dealer save as a influencer
            if($data['user_type'] != 'Customer')
                $data['user_type']='Influencer';

            $userresult = self::create([
                'name'              => $data['firstname'],
                'lastname'          => $data['lastname'],
                'email'             => $data['email'],
                'username'          => $data['username'],
                'rank_id'           => '1',
                'register_by'       => $data['sponsor'],               
                'password'          => bcrypt($data['password']),
                'confirmation_code' => $data['confirmation_code'],
                'influencer_type'   => 'yes',
                'keyid'             => '',
                'sponsor_id'        => $sponsor_id,
                'user_type'         => $data['user_type'],

            ]);   
           
            $userProfile = ProfileModel::create([
                'user_id'       => $userresult->id,
                'passport'      => $data['ic_number'],
                'id_file'       => $data['file_name'],
                'dateofbirth'   => $data['dateofbirth'],
                'mobile'        => $data['phone'],
                'country'       => $data['country'],
                'state'         => $data['state'],
                'city'          => $data['city'],
                'address1'      => "address", 
                'address2'      => $data['address2'],
                'zip'           => $data['zip'],
                'package'       => $data['package'],
                'facebook'      => $data['facebook_username'],
                'wechat'        => $data['WeChat_id'],
                'instagram'     => $data['Instagram_Id'], 
                'tiktok'        => $data['tiktok_id'],
                'Shopee_Shop_Name'        => $data['Shopee_Shop_Name'],
                'Lazada_Shop_name'        => $data['Lazada_Shop_name'],
                'twitter'                 => $data['twitter_username'],
                'youtube'                 => $data['youtube_username'],


            ]);
            Balance::addbalance($userresult->id);

            //customer doesnot enter to tree
            if($data['user_type']=='Influencer')
            {
                InfluencerTree::where('user_id',$sponsor_id)->increment('member_count',1);
                $influencertreeid = InfluencerTree::where('sponsor', $sponsor_id)->where('type', 'vaccant')->orderBy('id', 'desc')->take(1)->value('id');
              
                $influencertree          = InfluencerTree::find($influencertreeid);
                $influencertree->user_id = $userresult->id;
                $influencertree->sponsor = $sponsor_id;
                $influencertree->type    = "yes";
                $influencertree->save();

                $sponsorvaccant = InfluencerTree::createVaccant($sponsor_id, $influencertree->position);
                $uservaccant = InfluencerTree::createVaccant($userresult->id, 0);

               // register through a influencer
                $sponsor_details = User::where('username',$data['sponsor'])->first();
                $sponsor_type = $sponsor_details->user_type;

                if($sponsor_id != 1 && $sponsor_type == 'Influencer') 
                    User::where('id',$sponsor_id)->update(['user_type'=>'InfluencerManager']);
            }


            // not register by admin. ie; register and purchase from oc
            if($data['purchase']!="") {

                $seller_id=User::where('username',$data['purchase'])->select('id','status')->first();
                $pckg_count = $data['package_count'];

                foreach($data['product'] as $products) {           
        
                    $pur = PurchaseHistory::create([
                        'user_id'             => $userresult->id,
                        'product_name'        => $products['name'],
                        'purchase_user_id'    => $userresult->id,
                        'package_id'          => 1,
                        'package_purchase_id' => 1,
                        'seller_id'           => $seller_id->id,
                        'order_status'        => $data['order_id'],
                        'bv'                  => $pckg_count,
                        // 'total_bv'         => $userProduct->bv * $data['quantity'],
                        'count'               => $products['quantity'],
                        'total_amount'        => $products['total_price'],
                        'invoice_id'          => $data['order_id'],
                        'pay_by'              => 'COD',
                        'purchase_type'       =>'registration',
                        'sales_status'        => "yes",
                        // 'billing_address_id'  => $bill->id,
                        // 'shipping_address_id' => $ship->id,
                        'payment_date'        => $data['payment_date'],
                        'shipping_country'    => $data['shipping_country'],
                        'type'                => $products['type'],
                        'tracking_id'         => $data['tracking_id'],
                        'courier_service'     => $data['courier_service'],
                    ]);
                    $total=$total+$products['total_price'];
                }
            Commission::influencercommission($seller_id->id,$userresult->id,$total);
            }
        DB::commit();
        return $userresult;
        } 
        catch (Exception $e) {
            DB::rollback();
            $error1 = $e->getMessage();
            $line_number = $e->getLine();
            $error = ErrorLog::create([
                'from' =>"user.php - add influencer",
                'error'       => $error1,
                'line_number' => $line_number
            ]);
            return false;
        }
    }
   public static function influencercheckout($data,$user_id)
    { 
        DB::beginTransaction();
        try {

            $total=0;
            $seller_id=User::where('username',$data['purchase'])->select('id','user_type')->first();
      
            foreach($data['product'] as $products) {

                if ($products['type'] == 'Product')
                    $pckg_count = 0;
                else
                    $pckg_count = $data['package_count'];

                $data['tracking_id']=isset($data['tracking_id']) ? $data['tracking_id'] : 'not_found';
                $data['courier_service'] = isset($data['courier_service']) ? $data['courier_service'] : 'not_found';

                $pur = PurchaseHistory::create([
                        'user_id'             => $user_id->id,
                        'purchase_user_id'    => $user_id->id,
                        'package_id'          => 1,
                        'package_purchase_id' => 1,
                        'order_status'        => $data['order_id'],
                        'product_name'        => $products['name'],
                        'seller_id'           => $seller_id->id,
                        'bv'                  => $pckg_count,
                        'total_bv'            => $data['package_count'],
                        'count'               => $products['quantity'],
                        'total_amount'        => $products['total_price'],
                        'invoice_id'          => $data['order_id'],
                        'pay_by'              => 'mlmadmin',
                        'purchase_type'       => 'purchase',
                        'sales_status'        => "yes",
                        'payment_date'        => $data['payment_date'],
                        'shipping_country'    => $data['shipping_country'],
                        'type'                => $products['type'],
                        'tracking_id'         => $data['tracking_id'],
                        'courier_service'     => $data['courier_service'],
                ]);
                $total=$total+$products['total_price'];
            }

            if($seller_id->user_type == 'Influencer' || $seller_id->user_type == 'InfluencerManager' )
                Commission::influencercommission($seller_id->id,$user_id->id,$total);

            //if a customer purchase 2 or more package through influencer purchase link customer become influencer
            $sponsor_id = $user_id->sponsor_id;
            $sponsor_type=User::where('id',$sponsor_id)->value('user_type');

            if ($user_id->user_type == "Customer" && $pckg_count >= 2 ) {
            // if this customers sponsor is not an influencer Dont want any change
                if($sponsor_type == 'Influencer' || $sponsor_type == 'InfluencerManager') {
                    InfluencerTree::where('user_id',$sponsor_id)->increment('member_count',1);
                    $influencertreeid = InfluencerTree::where('sponsor', $sponsor_id)->where('type', 'vaccant')->orderBy('id', 'desc')->take(1)->value('id');
                  
                    $influencertree          = InfluencerTree::find($influencertreeid);
                    $influencertree->user_id = $user_id->id;
                    $influencertree->sponsor = $sponsor_id;
                    $influencertree->type    = "yes";
                    $influencertree->save();

                    $sponsorvaccant = InfluencerTree::createVaccant($sponsor_id, $influencertree->position);
                    $uservaccant = InfluencerTree::createVaccant($user_id->id, 0);

                    User::where('id',$user_id->id)->update(['user_type'=>'Influencer']);
                  
                    if($sponsor_type == 'Influencer' ) 
                        User::where('id',$sponsor_id)->update(['user_type'=>'InfluencerManager']);

                }  
            }
        DB::commit();
        }
        catch (Exception $e) {
            DB::rollback();
            return false;
            $error = ErrorLog::create([
                'from' =>"user.php- influencer checkout",
                'error'       => $error1,
                'line_number' => $line_number
            ]);
        } 
    }
   

    public static function shoppurchase($data,$user,$sponsor)
    {

        DB::beginTransaction();

        try {

            $userdetails = User::find($user);
            $ship= Shippingaddress::create([
                'user_id'          => $user,
                'fname'            => $data['shipping_firstname'],
                'lname'            => $data['shipping_lastname'],
                'email'            => $userdetails->email,
                'state'            => $data['shipping_state'],
                'country'          => $data['shipping_country'],
                'pincode'          => $data['shipping_zip'],
                'city'             => $data['shipping_city'],
                'address'          => $data['shipping_address'],
                'address2'         => $data['shipping_address2'],
            ]);
            $bill= BillingAddress::create([
                'user_id'          => $user,
                'fname'            => $data['billing_firstname'],
                'lname'            => $data['billing_lastname'],
                'email'            => $userdetails->email,
                'state'            => $data['billing_state'],
                'country'          => $data['billing_country'],
                'pincode'          => $data['billing_zip'],
                'city'             => $data['billing_city'],
                'address'          => $data['billing_address'],
                'address2'         => $data['billing_address2'],
            ]);

        foreach ($data['quantity'] as $key => $value) {
           
            $userProduct = Product::find($key);

            $pur = PurchaseHistory::create([
                'user_id'             => $user,
                'purchase_user_id'    => $sponsor,
                'package_id'          => $userProduct->id,
                'bv'                  => $userProduct->bv,
                'total_bv'            => $userProduct->bv * $value,
                'count'               => $value,
                'total_amount'        => $userProduct->price * $value,
                'pay_by'              => $data['payment'],
                'purchase_type'       =>'shop_purchase',
                'sales_status'        => "yes",
                'billing_address_id'  => $bill->id,
                'shipping_address_id' => $ship->id,
                'shipping_country'    => $data['shipping_country'],
                'payment_date'        => isset($data['payment_date'])?$data['payment_date']:'',
                'type'                => 'product',
            ]);

            Product::where('id',$key)->decrement('quantity',$value);
            StockManagement::create([
                'user_id'       =>  $user,
                'product_id'    =>  1,
                'out'           =>  $value,
                'balance'       =>  Product::where('id',$userProduct->id)->value('quantity'),
            ]);
            if($userProduct->id == 1)
            {
                $today= date("Y-m-d");
                $after_a_year = date('Y-m-d', strtotime('1 year',strtotime($today)));
                User::where('id',$user)->update(['expiry_date'=>$after_a_year]);
            } 
            // point distribution
            if( $data['payment'] != 'register_point')
            {
                Tree_Table::$upline_users = [];
                Tree_Table::getAllUpline($user);
                $bv_update = $userProduct->bv * $value;
                PointTable::updatePoint($bv_update, $user);
            }
        }
    

            // end
            Packages::saveinvoice($user,$pur->id);
            DB::commit();
            return 1 ;
        } catch (Exception $e) {
            DB::rollback();

            return false;
        }
    }
    public static function uploadusers($users)
    {
      
     
        foreach ($users as $key => $user) {
            if ($key <> 0 && in_array(!null, $user)) {
                $transaction_pass = self::RandomString();
                $package=Packages::where('package', $user[8])->value('id');
                if ($user[10]=='Male') {
                    $gender = 'm';
                } else {
                    $gender = 'f';
                }
                if ($user[1]=='Left') {
                    $leg = 'L';
                } else {
                    $leg = 'R';
                }

                if (filter_var($user[9], FILTER_VALIDATE_EMAIL)) {
                    $valid_email=1;
                } else {
                    $valid_email=2;
                }


                $data                     = array();
                $data['reg_by']           = 'batch_upload';
                $data['firstname']        = $user[2];
                $data['lastname']         = $user[3];
                $data['email']            = $user[9];
                $data['reg_type']         = 'batch_upload';
                $data['username']         = $user[4];
                $data['gender']           = $gender;
                $data['country']          = 'US';
                $data['state']            = 'NY';
                $data['city']             = $user[7];
                $data['address']          = $user[6];
                $data['password']         = $user[5];
                $data['transaction_pass'] = $transaction_pass;
                $data['sponsor']          = $user[0];
                $data['package']          = $package;
                $data['leg']              = $leg;
                $data['confirmation_code']= str_random(40);
                $data['placement_user'] = $user[0];
                $data['cpf']           = '123456';
                $data['passport']           = '123456';
                $data['phone'] ='1234567891';
                $data['zip']           = 12345;
                $data['location']           = 'ny';
                $sponsor_id = User::checkUserAvailable($data['sponsor']);
                $placement_id = User::checkUserAvailable($data['placement_user']);
      
                $username=User::where('username', $user[4])->value('id');
                $email=User::where('email', $user[9])->value('id');

                if ($valid_email==1 && $username == null && $email == null && $package <> null && $sponsor_id <> null && $placement_id <> null) {
                    echo $data['leg'] .'---' ;
                    $placement_id = Tree_Table::getPlacementId($placement_id, $data['leg']);
                    $userresult = User::add($data, $sponsor_id, $placement_id);
                    if ($userresult) {
                        $userPackage = Packages::find($data['package']);
                        $sponsorname = $data['sponsor'];
                        $placement_username = $data['placement_user'];
                        $legname = $user[1];
              
                        Activity::add("Added user $userresult->username", "Added $userresult->username sponsor as $sponsorname and placement user as $placement_username in $legname Leg", $sponsor_id);
                        Activity::add("Joined as $userresult->username", "Joined in system as $userresult->username sponsor as $sponsorname and placement user as $placement_username in $legname Leg", $userresult->id);

                        // Activity::add("Package purchased", "Purchased package - $userPackage->package ", $userresult->id);

                        $email = Emails::find(1);
                        $app_settings = AppSettings::find(1);
                        $setting=Welcome::first();
             
                        $data['company_name'] =$app_settings->company_name ;
          
                  // SendEmail::dispatch($data,$data['email'],$data['firstname'],'register')->delay(now()->addSeconds(5));
                    }
                }
            }
        }
    }

    public static function RandomString()
    {
        $characters       = "23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
        $charactersLength = strlen($characters);
        $randstring       = '';
        for ($i = 0; $i < 11; $i++) {
            $randstring .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randstring;
    }

    
}


