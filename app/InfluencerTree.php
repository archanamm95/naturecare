<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Crypt;
use DB;
use Auth;
use Html;
use Storage;
use Illuminate\Database\Eloquent\SoftDeletes;



class InfluencerTree extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table="influencer_tree";
    protected $fillable=['user_id','sponsor','position','type','member_count'];
    public static $downlineIDArray=array();
    public static $downlineIDArrayId=array();
    public static $downline=array();

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function createVaccant($user_id, $position)
    {

        return self::create([
        'user_id'=>0,
        'sponsor'=>$user_id,
        'position'=>$position +1 ,
        'type'=>'vaccant'
        ]);
    }
    public static function getTree($root = true, $sponsor = "", $treedata = array(), $level = 0)
    {
        // echo $root;

        if ($level == 3) {
            return false ;
        }
        if ($root) {
            // echo "aa";
            $data= self::where('influencer_tree.user_id', $sponsor)
                   ->leftJoin('users', 'influencer_tree.user_id', '=', 'users.id')
                   ->leftjoin('profile_infos', 'profile_infos.user_id', '=', 'influencer_tree.user_id')
                   ->select('influencer_tree.*', 'users.username','users.email', 'users.name', 'users.active','users.created_at', 'users.lastname','users.status', 'users.user_type', 'profile_infos.image','influencer_tree.member_count')
                   ->get();
        } else {
            // echo "bb";
            $data= self::where('influencer_tree.sponsor', $sponsor)
                 ->where('type', '!=', 'vaccant')
                 ->orderBy('position', 'ASC')
                 ->leftJoin('users', 'influencer_tree.user_id', '=', 'users.id')
                 
                 ->leftjoin('profile_infos', 'profile_infos.user_id', '=', 'influencer_tree.user_id')
                 ->select('influencer_tree.*', 'users.username', 'users.name', 'users.created_at', 'users.lastname','users.status', 'users.user_type', 'users.active','influencer_tree.member_count')
                 ->get();
        }

// echo $data;
        $currentuserid = Auth::user()->id;
        $treearray=array();
        // dd($data);
        foreach ($data as $value) {

// dd($value->user_id);
            if ($value->type =="yes" || $value->type =="no") {
                     $push = self::getTree(false, $value->user_id, $treearray, $level + 1);
                     
                if ($root) {
                  
                    $class = 'up';
                    $usertype = 'root';
                    if ($value['status']=='active') {
                         $user_active_class = 'active';
                    } elseif ($value['status']=='inactive') {
                         $user_active_class = 'inactive';
                    }
                } else {
                  
                    $class='down';
                    $usertype = 'child';
                    if ($value['status']=='active') {
                         $user_active_class = 'active';
                    } elseif ($value['status']=='inactive') {
                         $user_active_class = 'inactive';
                    }
                }
                     $username         = $value->username;
                     $email         = $value->email;
                     $name         = $value->name;
                     $lastname         = $value->lastname;
                     $rank_name         = $value->rank_name;
                     $id         = $value->user_id;
                     $accessid         = Crypt::encrypt($value->user_id);
                if (Auth::user()->id == 1) {
                    $inbox='admin';
                } else {
                    $inbox='user';
                }

                   
                     $member_type = $value->user_type;
                   
                     $balance = round(Balance::where('user_id', '=', $value->user_id)->value('balance'),4);
                     
                     $member_count = $value->member_count;
                     $user_photo = '' . Html::image(route('imagecache', ['template' => 'profile', 'filename' => self::profilePhoto($username)]), $username, array('class'=>$class.' tree-user ','style' => 'max-width:50px;','data-accessid'=>$accessid)) . '';
           

                     $currentuserid = Auth::user()->id;
                     $class_name = $user_active_class;
                     $treearray[$value->id]['class_name'] = $class_name;

                     $treearray[$value->id]['member_count'] =  $member_count;
                     $treearray[$value->id]['id']      = $id;
                     $treearray[$value->id]['current_user_id'] = $currentuserid;
                     $treearray[$value->id]['access_id']      = $accessid ;
     
                     $treearray[$value->id]['user_name']       =$username;
                     $treearray[$value->id]['email']       =$email;
                     
                     $treearray[$value->id]['user_photo']       = route('imagecache', ['template' => 'profile', 'filename' => self::profilePhoto($username)]);
                     $treearray[$value->id]['user_cover_photo']       = route('imagecache', ['template' => 'large', 'filename' => self::coverPhoto($username)]);
     
                     $treearray[$value->id]['first_name']       = $value->name;
                     $treearray[$value->id]['last_name']       = $value->lastname;
                     $treearray[$value->id]['date_of_joining'] = date('Y-m-d', strtotime($value->created_at));
     
                     
                     $treearray[$value->id]['rank_name'] = $value->user->rank->rank_name;
                    
                     
                     $treearray[$value->id]['balance'] = $balance;
     
                     
                     $treearray[$value->id]['user_type'] = $usertype;
                     $treearray[$value->id]['member_type'] = $member_type;

                         if (Auth::user()->id == 1) {
                      $treearray[$value->id]['user_role'] ='admin';
                     } else {
                     $treearray[$value->id]['user_role'] ='user';
                      }


                if (!empty(array_first($push)) || !empty(array_last($push))) {
                    $treearray[$value->id]['children'] = array_values($push);
                }
            } else {
            
            }
        }
           $treedata = $treearray;
           // dd($treedata);
           return $treedata;
    }
     public static function generateTree($users, $level = 0, $tree_structure = "")
    {
        $x = collect(collect($users)->first());
        return $x->toJson();
    }
     public static function profilePhoto($user_name)
    {
        $user  = User::where('username', $user_name)->with('profile_info')->first();
        $image = $user->profile_info->profile;
        
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

     public static function getSponsorID($user_id)
    {


        return self::where('user_id', $user_id)->value('sponsor');
    }
     public static function getDownlines($root = true, $sponsor = "", $treearray = array(), $level = 0)
    {
// dd(10);

        $max_level = 2 ;
     

        // if($level == $max_level) {
        //  return  ;
        // }
        if ($root) {
             $data= self::where('influencer_tree.user_id', $sponsor)
             ->join('users', 'influencer_tree.user_id', '=', 'users.id')
             ->select('influencer_tree.id', 'influencer_tree.user_id', 'influencer_tree.type', 'users.username', 'users.username as userid')
             ->get();
        } else {
             $data= self::where('influencer_tree.sponsor', $sponsor)
             ->where('type', '!=', 'vaccant')
             ->orderBy('position', 'ASC')
             ->join('users', 'influencer_tree.user_id', '=', 'users.id')
             ->select('influencer_tree.id', 'influencer_tree.user_id', 'influencer_tree.type', 'users.username', 'users.username as userid')
             ->get();
        }
        // dd($data);
        foreach ($data as $value) {
            if ($value->type =="yes"  || $value->type =="no") {
                 self::$downline[$value->id]['user_id'] =$value->userid;
                 self::$downline[$value->id]['username'] =$value->username;
                 self::$downline[$value->id]['id'] =$value->user_id;
                 self::$downlineIDArray[] =$value->user_id;
                 self::getDownlines(false, $value->user_id, $treearray, $level+1);
            } else {
                self::$downline[$value->id]['user_id'] =$value->userid;
                self::$downline[$value->id]['username'] =$value->username;
                self::$downline[$value->id]['id'] =$value->user_id;
                self::$downlineIDArray[] =$value->user_id;
            }
        }
        return  1 ;
    }
    public static function checkUserinTeam($user_id, $sponsor)
    {
           
           ITR:
        if (self::whereIn('sponsor', $sponsor)->where('user_id', $user_id)->exists()) {
            return true;
        } else {
            $sponsor = self::whereIn('sponsor', $sponsor)->where('user_id', '>', 0)->pluck('user_id') ;
            if ($sponsor->count()) {
                goto ITR;
            }
        }
            return false;
    }

    public static function getMyReferals($user_id)
    {
        return ProfileInfo::select('profile_infos.*', 'users.username as username', 'users.email as email', 'users.name as name', 'users.lastname as lastname', 'packages.package as packagename')
                    ->join('users', 'users.id', '=', 'profile_infos.user_id')
                    ->join('influencer_tree', 'influencer_tree.user_id', '=', 'profile_infos.user_id')
                    ->join('packages', 'packages.id', '=', 'profile_infos.package')
                    ->where('influencer_tree.sponsor', $user_id)
                    ->get();
    }

}