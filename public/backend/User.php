<?php

namespace App;
use DB;
use Commission;
use Auth;
use Cache;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Crypt;
use Html;
use Storage;
use Profileinfo;
use Illuminate\Notifications\Notifiable;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use SoftDeletes, Notifiable;

    protected $dates = ['deleted_at'];
    

    use Authenticatable, CanResetPassword;

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
    protected $fillable = ['user_id','email', 'password','username','sponsor','sponsor_id','approved_status','rank_id','register_by','name','lastname','transaction_pass','created_at','admin','citizen','authorized_to_work','felony','felony_explanation'];

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
        return Cache::get('user-is-online-' . $id);
    }


    //RELATIONSHIPS - Added By Aslam
    public function profile_info()
    {
        return $this->hasOne('App\ProfileInfo','user_id','id');
    }

 

    public function sponsor_tree()
    {
        return $this->hasOne('App\Sponsortree','user_id','id');
    }


    public function tree_table()
    {
        return $this->hasOne('App\Tree_Table','user_id','id');
    }


    public function purchase_history()
    {
        return $this->hasMany('App\PurchaseHistory','user_id','id');
    }

    public function packages()
    {
        return $this->hasOne('App\Packages','user_id','id');
    }

    public function activity()
    {
        return $this->hasMany('App\Activity','user_id','id');
    }




    public function ticket()
    {
        return $this->hasMany('App\Models\Helpdesk\Ticket\Ticket','user_id','id');
    }

    public function reply()
    {
        return $this->hasMany('App\Models\Helpdesk\Ticket\TicketReply','user_id','id');
    }

    public function point()
    {
        return $this->hasOne('App\PointTable','user_id','id');
    }



    public static function createUserID(){

      $user_id = "ID". str_random(7);

      if(self::where('user_id',$user_id)->count()  == 0){
        return $user_id ;
      }
      return self::createUserID();
    }

     public static function checkUserAvailable($username){
      $users = DB::table('users')->where('username', $username)->get();
      // dd($users[0]->id);
      return $users[0]->id;
    }
    public function getSponsor($user_id){
         $user_id =  Tree_Table::where('sponsor', $sponsor_id)->where("leg",$leg)->value('user_id');
    }
    public static function getSponsorId($sponsor_name){
         return SELF::where('username', $sponsor_name)->value('id');
    }

    public static function takeUserId($user_name){
         return SELF::where('username', $user_name)->value('id');
    }

    public static function  getSponsorName($user_id){
        $sponsor_id =  Tree_Table::where('user_id', $user_id)->value('sponsor');
        return self::userIdToName($sponsor_id);
    }
    public static function userIdToName($user_id){
        $user_name =  SELF::where('id', $user_id)->value('username');
        return $user_name;
    }
    
    public static function userNameToId($username){
        $user_id =  SELF::where('username', $username)->value('id');
        return $user_id;
    }  
   public static function getStates($id){
          $countries = DB::select('select * from life_state where country_id = '+$id);
          
   }
   public static function countryIdToName($country_id){
          $country_name =  DB::table('countries')->where('id', $country_id)->value('name');
          return $country_name;
          
   }
    public static function stateIdToName($state_id){
          $state_name =  DB::table('life_state')->where('State_Id', $state_id)->value('State_Name');
          return $state_name;
          
   }
   public static function getPassword($user_id){
         $password = DB::table('users')->where('user_id',$user_id)->value('password');
         return $password;
   }
   public static function updatePassword($user_id,$new_password){
         DB::table('users')->where('id', $user_id)->update(array('password' => $new_password));
       
   }
   
   
   public static function checkUserType($user_id){
         $type_id = SELF::where('id', $user_id)->value('admin');
         if($type_id == 1)
              return "admin";
          else
            return "user";
   }
   public static function getNewUsers(){
        $user_type = SELF::checkUserType(Auth::user()->id);
        $admin_flag = 0;
        if($user_type == 'admin'){
          
        $new_users = DB::table('users')
                            ->join('profile_infos', 'profile_infos.user_id', '=', 'users.id')
                           ->where('admin', $admin_flag)
                           ->orderBy('created_at', 'desc')
                           ->limit(8)
                           ->get();
        }else{
          $new_users = DB::table('users')
                              ->join('profile_infos', 'profile_infos.user_id', '=', 'users.id')
                              ->join('tree_table', 'tree_table.user_id', '=', 'users.id')
                              ->where('tree_table.sponsor', '=', Auth::user()->id)
                              ->limit(8)
                              ->get();
        }
        //print_r($new_users);die();
        $loop = count($new_users);
        for($i = 0;$i < $loop;$i ++){
          //echo $new_users[$i]->country;die();
         $new_users[$i]->country_name =  NULL ;//self::getCitizen($new_users[$i]->country);
        }
        return $new_users;
   }
   public static function getCitizen($id){
    return DB::table('countries')->where('id', $id)->pluck('citizenship');
   }
   public static function insertToBalance($user_id){
        DB::table('user_balance')->insert(array('user_id'=>$user_id,'balance' => 0));
   }
   public static function upadteUserBalance($user_id,$sponsor_commisions){
        DB::table('user_balance')->where('user_id',$user_id)->increment('balance',$sponsor_commisions);

   }

    public static function getUserDetails($id){
      return DB::table('users')->where('id', $id)->get();
    }
    public static function getAdminEmail(){
      return DB::table('users')->where('admin', 1)->pluck('email');
    }
    public static function getAdminId(){
      return DB::table('users')->where('admin', 1)->pluck('id');
    }
    public static function checkEmailAvailable($email){
      $user_email = DB::table('users')->where('email', $email)->pluck('email');
      if(!$user_email)
        return 'available';
    }
    public static function getUserId($username){
      $user_id = DB::table('users')->where('username',$username)->pluck('id');
      if(!$user_id){
        return 'available';
      }
    }
    public static function getUsersForDashboardGraph(){
      //return Self::getDownlineUsers(Auth::user()->id);
      $downline_users = array();
      return Self::getDownlineUsers(1,1,$downline_users);
      //return Auth::user()->id;
    }
    public static function getDownlineUsers($user_id,$index,$downline_users=array()){
      //$u = self::usersDownline(1,1);
      //print_r($u);die();
      $users = DB::table('tree_table')->where('sponsor',$user_id)->where('type','yes')->get();
      for($i=0;$i<count($users);$i++){
            $downline_users[$index]['user_id'] = $users[$i]->user_id;
            $downline_users[$index]['join_month'] = date("m", strtotime($users[$i]->created_at));
            $index++;
            //$d =date("m", strtotime($downline_users[$index-1]['join_date'] ));
    }
    $count_users = count($downline_users);
    $month_count;
    for($k=1;$k<13;$k++){$month_count[$k]=0;}
    for($j = 1; $j <= $count_users; $j++){
        if($downline_users[$j]['join_month'] == 1){$month_count[1] += 1;}
        else if($downline_users[$j]['join_month'] == 2){$month_count[2] += 1;}
        else if($downline_users[$j]['join_month'] == 3){$month_count[3] += 1;}
        else if($downline_users[$j]['join_month'] == 4){$month_count[4] += 1;}
        else if($downline_users[$j]['join_month'] == 5){$month_count[5] += 1;}
        else if($downline_users[$j]['join_month'] == 6){$month_count[6] += 1;}
        else if($downline_users[$j]['join_month'] == 7){$month_count[7] += 1;}
        else if($downline_users[$j]['join_month'] == 8){$month_count[8] += 1;}
        else if($downline_users[$j]['join_month'] == 9){$month_count[9] += 1;}
        else if($downline_users[$j]['join_month'] == 10){$month_count[10] += 1;}
        else if($downline_users[$j]['join_month'] == 11){$month_count[11] += 1;}
        else {$month_count[$j] += 1;}
    }
    print_r($downline_users);die();
    $month = $month_count[1].",".$month_count[2].",".$month_count[3].",".$month_count[4].",".$month_count[5].",".$month_count[6]
      .",".$month_count[7].",".$month_count[8].",".$month_count[9].",".$month_count[10].",".$month_count[11].",".$month_count[12];
    print_r($month);//die();
    } 
    public static function getUserPercentage(){
      $user_id = Auth::user()->id;
     $all_usercount = SELF::count();
      $ref_usercount = Tree_Table::where('sponsor',$user_id)->where('type','yes')->count();
      $per_user = ($ref_usercount/$all_usercount)*100;
      return $per_user;
    }
    #getmeber data
    public static function getAllMemberDetails($uname){
     return  DB::table('users')->select("*")->where('username','%like%',$uname)->get();
    }

    public static function addCredits($user_id){

      $user = self::find($user_id); 

      $package = Packages::find($user->package) ;

      $user->credits =  $package->stock_products ;

      return $user->save();

    }


    public static function getMonthUsers($user){
      $result = array();

      for($i=1;$i<=12;$i++){
       echo $count = self::whereMonth('created_at','=',$i)->whereYear('created_at', '=', date('Y'))->count();
       echo ",";
        // array_push($result,$count);
      }

      
    }

     public static function getPackagedUsers($package_id){
      
      return self::where('users.package',$package_id)
            ->join('sponsortree','sponsortree.user_id','=','users.id')
            ->join('packages','packages.id','=','users.package')
            ->join('users as sponsor','sponsor.id','=','sponsortree.sponsor')
            ->select('users.*','sponsor.username as sponsorusername','packages.package as packagename')
            ->get();

    }





   

    public static function hoverCard($user_id)
    {

               
                $user =    User::where('id', $user_id)->with('point')->first();
                // dd($user);
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
             
                
                <table class='table table-condensed'>
                <thead>
                <tr>
                    <td>Total left</td>
                    <td>Total right</td>
                    <td>Left point</td>
                    <td>Right point</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{$user->point->total_left}</td>
                    <td>{$user->point->total_right}</td>
                    <td>{$user->point->left_carry}</td>
                    <td>{$user->point->right_carry}</td>
                </tr>
                </tbody>
                </table>
      
                </div>
                </div>";


        return $info;
    }


    public static function profilePhoto($user_name)
    {
        $user  = User::where('username', $user_name)->with('profile_info')->first();
        $image = $user->profile_info->profile;
        if (!Storage::disk('images')->exists($image)){
            $image = 'avatar-big.png';
        }
        if(!$image){
            $image = 'avatar-big.png';
        }

        return $image;
    }

    public static function coverPhoto($user_name)
    {
        $user  = User::where('username', $user_name)->with('profile_info')->first();
        $image = $user->profile_info->cover;
        if (!Storage::disk('images')->exists($image)){
            $image = 'cover.jpg';
        }
        if(!$image){
            $image = 'cover.jpg';
        }
        return $image;
    }



    public static function add($data,$sponsor_id,$placement_id){

            DB::beginTransaction();

            try {



            /**
             * Creates a user with provided data and stores it for temperory usage
             * @var [type]
             */            
            $userresult = SELF::create([
                'name'             => $data['firstname'],
                'lastname'         => $data['lastname'],
                'email'            => $data['email'],
                'username'         => $data['username'],
                'rank_id'          => '1',
                'sponsor_id'       => $sponsor_id,
                // 'register_by'      => $data['reg_by'],
                'cpf'              => $data['cpf'],
                'transaction_pass' => $data['transaction_pass'],
                'password'         => bcrypt($data['password']),
                'citizen'          => $data['citizen'],
                
                'authorized_to_work'  => $data['shippingcheck'],
                'felony'            => $data['checkbox'],
                'felony_explanation' => $data['felony'],



            ]);


            /**
             * Creates Profile info for the created User
             * @var [type]
             */
            $userProfile = ProfileModel::create([
                'user_id'  => $userresult->id,
                'passport' => $data['passport'],
                'mobile'   => $data['phone'],
               
                'country'  => $data['country'],
                'state'    => $data['state'],
                'city'     => $data['city'],
                'address1' => $data['address'],
                'zip'      => $data['zip'],
                'location' => $data['location'],
                'dateofbirth' =>$data['dob'],
                // 'package'  => $data['package'],
            ]);


            /**
             * Create purchase history for the user, as it is passed from form
             * Checks against the packages here for the amount and volumes
             * @var [collection]
             */


            // $userPackage = Packages::find($data['package']);


            // PurchaseHistory::create([
            //     'user_id'          => $userresult->id,
            //     'purchase_user_id' => isset(Auth::user()->id)?Auth::user()->id:$userresult->id,
            //     'package_id'       => $data['package'],
            //     'pv'               => $userPackage->pv,
            //     'count'            => 1,
            //     'total_amount'     => $userPackage->amount,
            //     'pay_by'           => 0,
            //     'sales_status'     => 0,                
            // ]);

             /**
             * Get sponsor tree id where there is a vacant under specified sponsor
             * @var [string]
             */
            $sponsortreeid = Sponsortree::where('sponsor', $sponsor_id)->where('type', 'vaccant')->orderBy('id', 'desc')->take(1)->value('id');
            /**
             * Updates sponsor record linked the sponsor and user
             * @var [Function]
             */
         
            $sponsortree          = Sponsortree::find($sponsortreeid);
            $sponsortree->user_id = $userresult->id;
            $sponsortree->sponsor = $sponsor_id;
            $sponsortree->type    = "yes";
            $sponsortree->save();
            /**
             * Creates vacant for sponsor
             * @var [collection]
             */
            $sponsorvaccant = Sponsortree::createVaccant($sponsor_id, $sponsortree->position);
            /**
             * Creates vacants for user
             * @var [collection]
             */
            $uservaccant = Sponsortree::createVaccant($userresult->id, 0);


            /**
             * returns placement id, to where user to be added,
             * if placement id didnt do well, returns sponsor id and will be placed under sponsor
             * @var [userid]
             */
            $placement_id = Tree_Table::getPlacementId($placement_id, $data['leg']);
            /**
             * Finds the Vaccant Id adn set as tree id
             * @var [type]
             */
            $tree_id = Tree_Table::vaccantId($placement_id, $data['leg']);
            /**
             * updates the tree table with user id and sponsor, with type yes.
             * @var [function]
             */
            $tree          = Tree_Table::find($tree_id);
            $tree->user_id = $userresult->id;
            $tree->sponsor = $sponsor_id;
            $tree->type    = 'yes';
            $tree->save();

             /**
             * All application specific settings, like commission and packages settings
             * @var [collection]
             */
              /**
             * Here goes all the commissions calculations on the successful registration
             */

            Tree_Table::getAllUpline($userresult->id);
            // PointTable::updatePoint($userPackage->pv, $userresult->id);
            // Transactions::sponsorcommission($sponsor_id,$userresult->id);
            // $sponsor_id
            // LeadershipBonus::allocateCommission($sponsor_id,Sponsortree::where('user_id',$sponsor_id)->value('sponsor'),$userPackage->pv / 10);
            // // RsHistory::create([
            //         'user_id'=>$userresult->id,                   
            //         'from_id'=>$userresult->id,
            //         'rs_credit'=>$userPackage->rs,
            // ]);

            PointTable::addPointTable($userresult->id);
            Tree_Table::createVaccant($tree->user_id);
            /**
             * adding user to balance table
             */
            // $balanceupdate = SELF::insertToBalance($userresult->id);

            DB::commit();

            return $userresult ;

              
            } catch (Exception $e) {

              DB::rollback();

              return false;
              
            }
           


    }

    public static function activeUser($user_id){

      $active = User::find($user_id)->active;

      if($active == 'yes')
        return 1;
      else
        return 0;

    }




} 
