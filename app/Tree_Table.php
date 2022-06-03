<?php

namespace App;

use DB;
use Html;
use Auth;
use Crypt;
use Storage;

use Illuminate\Database\Eloquent\Model;

class Tree_Table extends Model
{
    public static $downline_users = '';
    public static $downline_users_count = '';

    public static $upline_users   = array();
    public static $upline_id_list = array();
    public static $downline_id_list = array();
    public static $downline = array();
    public static $downline_id_list_data = array();

    public static $MODEL_NOT_FOUND = '-1';

    protected $table = 'tree_table';

    protected $fillable = ['user_id', 'sponsor', 'placement_id', 'leg', 'position', 'level'];
    public static function getRefferalCount($user_id,$leg)
    {
       
        $leg_users = Tree_Table::where('placement_id',$user_id)->where('leg','=',$leg)->where('type','<>','vaccant')->pluck('user_id');
        if($leg_users != '[]'){
          Tree_Table::$downline_id_list_data = [];
          Tree_Table::getAllTreeDownlinesAutocomplete($leg_users);
          $downline_id_list = Tree_Table::$downline_id_list_data;

        $users = count($downline_id_list)+1;
       }
       else
        $users = 0;
        return $users;
    }  
    public static function getAllTreeDownlinesAutocomplete($placement_id)
    {
     
        $data= Tree_Table::whereIn('placement_id', $placement_id)->get();

        $placement_id =[];
        foreach ($data as $value) {
            if ($value->type=="yes" || $value->type=="no") {
                   self::$downline_id_list_data[] = $value->user_id;

                array_push($placement_id, $value->user_id);
            }
        }

        if (count($placement_id)) {
              self::getAllTreeDownlinesAutocomplete($placement_id);
        }
            return 1 ;
    }
    public static function getmaxid()
    {
        $users = DB::table('users')->max('user_id');
        return $users;
    }
    public static function getSponsorName($user_id)
    {
        return $sponsor_id = DB::table('tree_table')->where('user_id', $user_id)->value('sponsor');
    }

    public static function getSponsorVaccantId($sponsor_id){
        $id =Tree_Table::where("type","=","vaccant")->whereIn('placement_id',$sponsor_id)->orderBy('position')->where('user_id','=',0)->value('placement_id');
        if(!isset($id)){
            $sponsor_list = Tree_Table::whereIn('placement_id',$sponsor_id)->where('user_id','!=',0)->orderBy('updated_at')->pluck('user_id');
           return self::getSponsorVaccantId($sponsor_list);   
        }
        return $id;   
    }
    public static function getPlacementId($sponsor_id, $leg)
    {
        $user_id = self::where('placement_id', $sponsor_id)->where("type", "<>", "vaccant")->where("leg", $leg)->value('user_id');
        if (!$user_id) {
            return $sponsor_id;
        }
        return self::getPlacementId($user_id, $leg);
      //   $id =Tree_Table::where("type","=","vaccant")->whereIn('placement_id',$sponsor_id)->where('user_id','=',0)->value('placement_id');
      //   if(!isset($id)){   

      //   $sponsor_list = Tree_Table::whereIn('placement_id',$sponsor_id)->where('user_id','!=',0)->pluck('user_id');
      //  return self::getPlacementId($sponsor_list, $leg);
           
      // }

      //  return $id;   
    }
    public static function vaccantId($placement_id, $leg)
    {

        $data = self::where('placement_id', $placement_id)->where("leg", $leg)->where("type", "=", "vaccant")->value('id');

        return $data;
    }
    public static function getSponsorVaccantTreeId($placement_id)
    {
        $data = self::where('placement_id', $placement_id)->where("type", "=", "vaccant")->value('id');
        return $data;
    }
   public static function createVaccant($placement_id)
    {
        $n     = Tree_Table::where('user_id',$placement_id)->value('position');
        $level = Tree_Table::where('user_id',$placement_id)->value('level');
        
        Tree_Table::create([
            'sponsor'      => 0,
            'user_id'      => '0',
            'placement_id' => $placement_id,
            'leg'          => 'L',
            'type'         => 'vaccant',
            'position'     =>  2*$n,
            'level'        => $level+1,
        ]);

        Tree_Table::create([
            'sponsor'      => 0,
            'user_id'      => '0',
            'placement_id' => $placement_id,
            'leg'          => 'R',
            'type'         => 'vaccant',
            'position'     => 2*$n+1,
            'level'        => $level+1,
        ]);

        //  Tree_Table::create([
        //     'sponsor'      => 0,
        //     'user_id'      => '0',
        //     'placement_id' => $placement_id,
        //     'leg'          => '3',
        //     'type'         => 'vaccant',
        // ]);

    }
    public static function takeUserId($user_name)
    {
        return DB::table('users')->where('username', $user_name)->value('id');
    }


    // public static function getTree_old($root = true, $placement_id = "", $treedata = array(), $level = 0, $levellimit)
    // {


    //     if ($level == $levellimit) {
    //         return false;
    //     }
    //     if ($root) {
    //         $data = self::where('tree_table.user_id', $placement_id)
    //             ->leftJoin('users', 'tree_table.user_id', '=', 'users.id')
    //             ->leftJoin('profile_infos', 'profile_infos.user_id', '=', 'tree_table.user_id')
    //             ->leftJoin('rank_setting', 'rank_setting.id', '=', 'users.rank_id')
    //             ->leftJoin('point_table', 'point_table.user_id', '=', 'tree_table.user_id')
    //             ->select('tree_table.*', 'users.username', 'users.name', 'users.lastname', 'profile_infos.image', 'profile_infos.package', 'point_table.left_carry', 'point_table.right_carry', 'point_table.total_left', 'point_table.total_right', 'rank_setting.rank_name', 'users.active', 'users.email', 'users.created_at')
    //             ->get();
    //     } else {
    //         $data = self::where('placement_id', $placement_id)->orderBy('leg', 'ASC')
    //             ->leftJoin('users', 'tree_table.user_id', '=', 'users.id')
    //             ->leftJoin('profile_infos', 'profile_infos.user_id', '=', 'tree_table.user_id')
    //             ->leftJoin('rank_setting', 'rank_setting.id', '=', 'users.rank_id')
    //             ->leftJoin('point_table', 'point_table.user_id', '=', 'tree_table.user_id')
    //             ->select('tree_table.*', 'users.username', 'users.name', 'profile_infos.image', 'profile_infos.package', 'point_table.left_carry', 'point_table.right_carry', 'point_table.total_left', 'point_table.total_right', 'rank_setting.rank_name', 'users.active', 'users.email', 'users.created_at')
    //             ->get();
    //     }

    //     $currentuserid = Auth::user()->id;
    //     $treearray = [];
    //     // print_r($data);
    //     foreach ($data as $key => $value) {
    //         if ($value->type == "yes" || $value->type == "no") {
    //             if ($root) {
    //                 $push = self::getTree(false, $value->user_id, $treearray, $level + 1, $levellimit);
    //                 $class = 'up';
    //                 $usertype = 'root';
    //                 $user_active_class = 'active';
    //             } else {
    //                 $push = self::getTree(false, $value->user_id, $treearray, $level + 1, $levellimit);
    //                 $class='down';
    //                 $usertype = 'child';
    //                 if ($value['active']=='yes') {
    //                     $user_active_class = 'active';
    //                 } elseif ($value['active']=='no') {
    //                     $user_active_class = 'inactive';
    //                 }
    //             }
                
    //             $username         = $value->username;
    //             $name         = $value->name;
    //             $lastname         = $value->lastname;
    //             $rank_name         = $value->rank_name;
    //             $id         = $value->user_id;
    //             $email=$value->email;
    //             $datofjoining=date('Y-m-d', strtotime($value->created_at));
    //             $accessid         = Crypt::encrypt($value->user_id);
    //             $balance = Balance::where('user_id', '=', $value->user_id)->value('balance');
    //             $balance = round($balance, 4);
 
    //                $package_name = Packages::where('id', '=', $value->package)->value('package');
    //             $user_photo = '' . Html::image(route('imagecache', ['template' => 'profile', 'filename' => self::profilePhoto($username)]), $username, array('class'=>$class.' tree-user  ','style' => 'max-width:50px;','data-accessid'=>$accessid)) . '';
    //             if (Auth::user()->id == 1) {
    //                 $inbox='admin';
    //             } else {
    //                 $inbox='user';
    //             }
                
    //             $content = '
    //             <div class="container tree-node-box">
    //                 <div class="">
    //                     <div class="tree-img-holder">'.$user_photo.'</div>
    //                     <div class="pt-1 pb-1 col-md-12 text-center userName" title="'.$username.'">
    //                         <strong>'.$username.'</strong>
    //                     </div>
    //                     <div class="tree-user-more-details" id="more-'.$username.'">
    //                         <div class="card " style="padding: 0;margin: 0;width: 100%;">
    //                         <div class="card-body pl-0 pr-0 pb-0 pt-0 text-center">    

    //                         <ul class="list-group list-group-flush border-top">
    //                             <li class="list-group-item">
    //                                 <span class="font-weight-semibold">'.trans('tree.full_name').' : </span>
    //                                 <div class="ml-auto font-weight-bold">'.$name.' '.$lastname.'</div>
    //                             </li>                          
    //                             <li class="list-group-item">
    //                                 <span class="font-weight-semibold">'.trans('tree.rank').' : </span>
    //                                 <div class="ml-auto font-weight-bold">'.$rank_name.'</div>
    //                             </li>
    //                             <li class="list-group-item">
    //                                 <span class="font-weight-semibold">'.trans('tree.package').' : </span>
    //                                 <div class="ml-auto font-weight-bold">'.$package_name.'</div>
    //                             </li>
    //                         </ul>                          


                               
                                
    //                         </div>
    //                     </div>
    //                     </div>
    //                 </div>
    //             </div>
    //             <div class="d-flex justify-content-around text-center p-0 btn-group tree-node-box-tools">
    //                 <a href="#" class="list-icons-item flex-fill p-1 bg-slate-700 text-white toggle-more-content btn" data-popup="tooltip" data-container="body" title="" data-original-title="'.trans('tree.more_details').'" data-target="#more-'.$username.'">
    //                     <i class="icon-profile"></i>
    //                 </a>   
    //                 <a href="'.url($inbox.'/inbox#/u/mail/compose/?usnm='.$username).'" target="_blank" class="list-icons-item flex-fill p-1 btn bg-brown text-white" data-popup="tooltip" data-container="body" title="" data-original-title="'.trans('tree.send_mail').'">                                   
    //                     <i class="icon-mail5"></i>


    //                 </a> 
    //                 <button class="list-icons-item flex-fill p-1 btn bg-indigo-400 text-white btn-copy" data-popup="tooltip" data-container="body" title="" data-original-title="'.trans('tree.copy_username_to_clipboard').'" data-clipboard-content="'.$username.'">                                   
    //                     <i class="icon-paste"></i>
    //                 </button>
                                        
    //             </div>
    //            ';


    //             $coverPhoto = '' . Html::image(route('imagecache', ['template' => 'large', 'filename' => self::coverPhoto($username)]), $username, array('class'=>$class.' tree-user','style' => '','data-accessid'=>$accessid)) . '';

                

    //             $info    = "
    //             <div class='hoverouter'>
    //             <div class='hoverinner'>
                    
    //                         <div class='coverholder'>
    //                             $coverPhoto
    //                         </div>
    //                         <div class='background'>
    //                         </div>
                        
    //                 <div class='primeinfo' >
    //                     <div class='primeinfohold' >
                            
    //                             <div class='ellipsis username'>
    //                               ".trans('tree.username').":$value->username
    //                             </div>
                           
    //                     </div>
    //                     <ul class='secondaryinfo'>
    //                        <li>
    //                             <span class='value'>".trans('tree.fullname')."</span> : <span class='value'>$name $lastname</span>
    //                         </li>  
    //                          <li>
    //                             <span class='value'>".trans('tree.email')."</span> : <span class='value'>$email</span>
    //                         </li>   

    //                          <li>
    //                             <span class='value'>".trans('tree.date_of_joining')."</span> : <span class='value'>$datofjoining</span>
    //                         </li>                            
                                   
    //                         <li class='rankname'>
    //                             <span class='value'>".trans('tree.rank')."</span> :  <span class='value'>$value->rank_name</span>
    //                         </li class='packagename'>                            
    //                         <li>
    //                             <span class='value'>".trans('tree.package')."</span> : <span class='value'>$package_name</span>
    //                         </li>                            
                                                       
    //                         <li class='rsbalance'>
    //                             <span class='value'>".trans('tree.user_balance')."</span> : <span class='value'>$balance</span>
    //                         </li>
    //                     </ul>
    //                 </div>
    //             </div>
    //             <table cellpadding='0' cellspacing='0' class='profcontenttbl' >
    //                 <tbody>
    //                     <tr>
    //                         <td rowspan='2' valign='top'>
                               
    //                                 <div class='profpicholder'>
    //                                     $user_photo
    //                                 </div>
                              
    //                         </td>
    //                     </tr>
    //                     <tr valign='bottom'>
    //                         <td class='secinfo-list-holder'>
                              
    //                         </td>
    //                     </tr>
    //                 </tbody>
    //             </table>
    //             <div class='pillforholder'>
    //             </div>
    //             <div class='details'>
             
                
    //             <table class='table table-condensed'>
    //             <thead>
    //             <tr>
    //                 <td>".trans('tree.total_left')."</td>
    //                 <td>".trans('tree.total_right')."</td>
    //                 <td>".trans('tree.left_point')."</td>
    //                 <td>".trans('tree.right_point')."</td>
    //             </tr>
    //             </thead>
    //             <tbody>
    //             <tr>
    //                 <td>$value->total_left</td>
    //                 <td>$value->total_right</td>
    //                 <td>$value->left_carry</td>
    //                 <td>$value->right_carry</td>
    //             </tr>
    //             </tbody>
    //             </table>
      
    //             </div>
    //             </div>";

               


    //             $className = $user_active_class;
    //             $treearray[$value->id]['name']      = $username;
    //             $treearray[$value->id]['content']   = $content;
    //             $treearray[$value->id]['accessid']      =  $accessid;
    //             $treearray[$value->id]['id']      =  $id;
    //             $treearray[$value->id]['currentuserid'] = $currentuserid;
    //             $treearray[$value->id]['info']      = $info;
    //             $treearray[$value->id]['className'] = $className;
    //             $treearray[$value->id]['usertype'] = $usertype;
    //             if (!empty(array_first($push)) || !empty(array_last($push))) {
    //                 $treearray[$value->id]['children'] = [array_first($push), array_last($push)];
    //             }
    //         } else {
    //             // $placement_accessid = Crypt::encrypt(Tree_Table::where('placement_id',$value->placement_id)->where('type','=',"vaccant")->value('id'));
    //             $placement_accessid = Crypt::encrypt($value->id);
                

    //             $username      = "<span class='enroll'>Add here</span>";
    //             $content   = "<img class='' data-accessid='$placement_accessid' style='max-width:50px;cursor:pointer;' src='/files/images/users/profile_photos/thumbs/plus.png'>";
    //             $info      = "<a href='/add'>Add</a>";
    //             $className = "vacant";
    //             $treearray[$value->id]['name']      = $username;
    //             $treearray[$value->id]['content']   = $content;
    //             $treearray[$value->id]['info']      = $info;
    //             $treearray[$value->id]['className'] = $className;
    //             $treearray[$value->id]['usertype'] = 'vacant';
    //             $treearray[$value->id]['placement_accessid'] = $placement_accessid;
    //         }
    //     }
    //     $treedata = $treearray;
    //     return $treedata;
    // }


    public static function getTree($root = true, $placement_id = "", $treedata = array(), $level = 0, $levellimit)
    {
        if ($level == $levellimit) {
            return false;
        }
        if ($root) {
                    $data = Tree_Table::
                    with(array('user'=>function($q1){
                        $q1->with(array( 
                        'profile_info'=>function($q2){
                            $q2->select('user_id','image','package');
                        },
                        'rank'=>function($q4){
                            $q4->select('id','rank_name');
                        } 
                        ))
                        ->select('id','username','name','lastname','active','email','rank_id');
                    }))
                    ->where('user_id',$placement_id)
                    ->get();
        } else {

            $data = Tree_Table::
            with(array('user'=>function($q1){
                $q1->with(array( 
                'profile_info'=>function($q2){
                    $q2->select('user_id','image','package');
                },
                'rank'=>function($q4){
                    $q4->select('id','rank_name');
                } 
                ))
                ->select('id','username','name','lastname','active','email','rank_id');
            }))
            ->where('placement_id',$placement_id)
            ->orderBy('leg', 'ASC')
            ->get();
        }

        $currentuserid = Auth::user()->id;
        $treearray = [];
        foreach ($data as $key => $value) {
            if ($value->type == "yes" || $value->type == "no") {
                if ($root) {
                    $push = self::getTree(false, $value->user_id, $treearray, $level + 1, $levellimit);
                    $class = 'up';
                    $user_type = 'root';
                    $user_active_class = 'active';
                } else {
                    $push = self::getTree(false, $value->user_id, $treearray, $level + 1, $levellimit);
                    $class='down';
                    $user_type = 'child';
                    if ($value->user->user_type =='yes') {
                        $user_active_class = 'active';
                    }
                    elseif ($value->user->user_type =='no') {
                        $user_active_class = 'inactive';
                    }
                }

                $total_right_users = SELF::getRefferalCount($value->user->profile_info->user_id,'R');
                $total_left_users  = SELF::getRefferalCount($value->user->profile_info->user_id,'L');

                $treearray[$value->id]['total_right_users']       =$total_right_users;
                $treearray[$value->id]['total_left_users']       =$total_left_users;
                              
                $class_name = $user_active_class;
                $treearray[$value->id]['class_name'] = $class_name;

                $treearray[$value->id]['id']      =  $value->user_id;
                $treearray[$value->id]['current_user_id'] = $currentuserid;
                $treearray[$value->id]['access_id']      = Crypt::encrypt($value->user_id);;

                $treearray[$value->id]['user_name']       =$value->user->username;
                $treearray[$value->id]['email']       =$value->user->email;
                
                $treearray[$value->id]['user_photo']       = route('imagecache', ['template' => 'profile', 'filename' => self::profilePhoto($value->user->username)]);
                $treearray[$value->id]['user_cover_photo']       = route('imagecache', ['template' => 'large', 'filename' => self::coverPhoto($value->user->username)]);

                $treearray[$value->id]['first_name']       = $value->user->name;
                $treearray[$value->id]['last_name']       = $value->user->lastname;
                $treearray[$value->id]['date_of_joining'] = date('Y-m-d', strtotime($value->created_at));

                
                $treearray[$value->id]['rank_name'] = $value->user->rank->rank_name;
                $treearray[$value->id]['package_name'] = Packages::where('id', '=', $value->user->profile_info->package)->value('package');
                
                $treearray[$value->id]['balance'] = round(Balance::where('user_id', '=', $value->user_id)->value('balance'),4);

                $treearray[$value->id]['left_carry'] = $value->user->point->left_carry;
                $treearray[$value->id]['right_carry'] = $value->user->point->right_carry;
                // $treearray[$value->id]['total_left'] = $value->user->point->total_left;
                // $treearray[$value->id]['total_right'] = $value->user->point->total_right;
                
                $treearray[$value->id]['user_type'] = $user_type;

                if (Auth::user()->id == 1) {
                    $treearray[$value->id]['user_role'] ='admin';
                } else {
                    $treearray[$value->id]['user_role'] ='user';
                }
                if (!empty(array_first($push)) || !empty(array_last($push))) {
                    // $treearray[$value->id]['children'] = [array_first($push), array_last($push)];
                    $treearray[$value->id]['children'] = array_values($push);
                }
            } else {
                if (Auth::user()->id == 1) {
                    $treearray[$value->id]['user_role'] ='admin';
                } else {
                    $treearray[$value->id]['user_role'] ='user';
                }
                $treearray[$value->id]['class_name'] =  "vacant";
                $treearray[$value->id]['current_user_id'] = $currentuserid;
                $treearray[$value->id]['placement_accessid']      = Crypt::encrypt($value->id);;
            }
        }
        $treedata = $treearray;
        return $treedata;
    }


    public static function profilePhoto($user_name)
    {
        
        $user  = User::where('username', $user_name)->with('profile_info')->first();
        // dd($user);
        $image = $user->profile_info->profile;
        //if (!Storage::disk('images')->exists($image)){
        //    $image = 'avatar-big.png';
        //}
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


    public static function generateTree($users, $level = 0, $tree_structure = "")
    {
        $x = collect(collect($users)->first());
        return $x->toJson();
    }

    public static function getMyReferals($sponsor_id)
    {
        $users      = DB::table('tree_table')->where('sponsor', $sponsor_id)->get();
        $index      = 0;
        $user_array = array();
        foreach ($users as $user) {
            $user_array[$index] = self::getUserDetails($user->user_id);
            $index++;
        }
        return $user_array;
    }

    public static function getUserDetails($user_id)
    {
        return DB::table('users')->where('id', $user_id)->get();
    }
    public static function getDownlines($index, $root = true, $placement_id = "", $downline_user, $level = 0, $count = 0)
    {
        $data  = self::where('placement_id', $placement_id)->where('type', 'yes')->get();
        $count = $count + count($data);

        foreach ($data as $value) {
            if ($value->type == "yes") {
                $downline_user[$index]['user_id']             = $value->id;
                static::$downline_users[$index]['user_id']    = $value->user_id;
                static::$downline_users[$index]['join_month'] = date("m", strtotime($value->created_at));
                $index++;
                self::getDownlines($index, false, $value->id, $downline_user, $level + 1, $count);
            }
        }
    }
    public static function getDownlineCount($user_id, $index = 0, $downline_users = array())
    {
        $users = self::where('placement_id', $user_id)->where('type', 'yes')->get();

        for ($i = 0; $i < count($users); $i++) {
            $index                  = $index + ($i + 1);
            $downline_users_count[$index] = $users[$i]->user_id;
            self::getDownlineCount($users[$i]->user_id, $index, $downline_users);
        }
    }
    public static function getDown()
    {
        $count_users = count(static::$downline_users);
        $month_count;
        for ($k = 1; $k < 13; $k++) {
            $month_count[$k] = 0;
        }
        for ($j = 1; $j <= $count_users; $j++) {
            if (!empty(static::$downline_users)) {
                if (static::$downline_users[$j]['join_month'] == 1) {
                    $month_count[1] += 1;
                } elseif (static::$downline_users[$j]['join_month'] == 2) {
                    $month_count[2] += 1;
                } elseif (static::$downline_users[$j]['join_month'] == 3) {
                    $month_count[3] += 1;
                } elseif (static::$downline_users[$j]['join_month'] == 4) {
                    $month_count[4] += 1;
                } elseif (static::$downline_users[$j]['join_month'] == 5) {
                    $month_count[5] += 1;
                } elseif (static::$downline_users[$j]['join_month'] == 6) {
                    $month_count[6] += 1;
                } elseif (static::$downline_users[$j]['join_month'] == 7) {
                    $month_count[7] += 1;
                } elseif (static::$downline_users[$j]['join_month'] == 8) {
                    $month_count[8] += 1;
                } elseif (static::$downline_users[$j]['join_month'] == 9) {
                    $month_count[9] += 1;
                } elseif (static::$downline_users[$j]['join_month'] == 10) {
                    $month_count[10] += 1;
                } elseif (static::$downline_users[$j]['join_month'] == 11) {
                    $month_count[11] += 1;
                } else {
                    $month_count[$j] += 1;
                }
            }
        }
        $month = $month_count[1] . "," . $month_count[2] . "," . $month_count[3] . "," . $month_count[4] . "," . $month_count[5] . "," . $month_count[6]
            . "," . $month_count[7] . "," . $month_count[8] . "," . $month_count[9] . "," . $month_count[10] . "," . $month_count[11] . "," . $month_count[12];
        // print_r($month);
    }

    public static function getAllUpline($user_id)
    {

        $result = self::join('profile_infos', 'profile_infos.user_id', '=', 'tree_table.placement_id')
            ->where('tree_table.user_id', $user_id)
            ->select('tree_table.leg', 'tree_table.placement_id', 'tree_table.type', 'profile_infos.package')
            ->get();

        foreach ($result as $key => $value) {
            if ($value->type != 'vaccant' ) {
                self::$upline_users[]   = ['user_id' => $value->placement_id, 'leg' => $value->leg, 'package' => $value->package];
                self::$upline_id_list[] = $value->placement_id;
            }

            if ($value->placement_id > 0) {
                self::getAllUpline($value->placement_id);
            }
        }

        return $result;
    }

    public static function getUserLeg($user_id)
    {

        return self::where('user_id', $user_id)->value('leg');
    }

    public static function getFatherID($user_id)
    {

        return self::where('user_id', $user_id)->value('placement_id');
    }

    //RELATIONSHIPS - Added By Aslam
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public static function getDownlineuser($root = true, $placement_id = "", $level = 0)
    {

             $data= self::where('placement_id', $placement_id)->get();
        foreach ($data as $value) {
            if ($value->type=="yes" || $value->type=="no") {
                 self::$downline_id_list[] = $value->user_id;
                 self::$downline[$value->id]['user_id'] =$value->user_id;
                 self::$downline[$value->id]['id'] =$value->user_id;
                 self::$downline[$value->id]['rank'] =$value->rank_id;
                 self::$downline[$value->id]['placement'] =$value->placement_id;
                 self::$downline[$value->id]['sponsor'] =$value->sponsor;
                 self::getDownlineuser(false, $value->user_id, $level+1);
            }
        }
    }

     //binarydownlines

    public static function getAllDownlinesAutocomplete($placement_id)
    {

        
        $data= self::whereIn('placement_id', $placement_id)->get();
           
        $placement_id =[];
        foreach ($data as $value) {
            if ($value->type=="yes" || $value->type=="no") {
                self::$downline_id_list[] = $value->user_id;

                array_push($placement_id, $value->user_id);
            }
        }

        if (count($placement_id)) {
              self::getAllDownlinesAutocomplete($placement_id);
        }
            return 1 ;
    }
    public static function updateLegCount($user_id,$sponsor_id)
    {   
        Tree_Table::$upline_users = [];
        Tree_Table::getAllUpline($user_id);
        $variable = Tree_Table::$upline_users;
        foreach ($variable as $key => $value) {
            if ($value['leg'] == 'L') {
                PointTable::where('user_id',$value['user_id'])->increment('left_user',1);
                if($value['user_id'] == $sponsor_id)
                    PointTable::where('user_id',$sponsor_id)->increment('left_puser',1);
            }
            else{
                PointTable::where('user_id',$value['user_id'])->increment('right_user',1);
                if($value['user_id'] == $sponsor_id)
                    PointTable::where('user_id',$sponsor_id)->increment('right_puser',1);
            }

        }
    }
    public static function gettreePlacementId($sponsor_id,$level =1 )
    {


        if($level ==1 ){
            $down_line = Tree_Table::whereIn('placement_id',$sponsor_id)->where('type','vaccant')->orderBy('leg')->first();

             if($down_line){
                return $down_line->id;
            }else{
                $sponsor_list = Tree_Table::whereIn('placement_id',$sponsor_id)->orderBy('leg')->pluck('user_id');
                return self::gettreePlacementId($sponsor_list,2);
            }
        }else{

            $down_line = Tree_Table::whereIn('placement_id',$sponsor_id)
                                    ->select('placement_id',DB::raw('COUNT(`placement_id`) as CNT'))
                                    ->where('user_id','=',0)
                                    ->groupBy('placement_id')
                                    ->get();

                                    // print_r($down_line->toArray()) ;
            if($down_line->count() ==0 ){
                 $sponsor_list = Tree_Table::whereIn('placement_id',$sponsor_id)->orderBy('leg')->pluck('user_id');
                return self::gettreePlacementId($sponsor_list,++$level);
            }else{
               

                // dd($down_line);
                 $placement = $down_line[0]->placement_id ;
                // echo  "  ...  " ;
                  $cnt = $down_line[0]->CNT ;

                foreach ($down_line as $key => $value) {
                             // echo "</br> " .$value->placement_id .'   ... ' . $value->cnt ;
                     if($cnt < $value->CNT){
                        $placement = $value->placement_id;
                     }

                }



                // dd($placement);
                return $down_line = Tree_Table::where('placement_id',$placement)
                                            ->where('type','vaccant')
                                            ->orderby('leg')
                                            ->first()
                                            ->id;

                    // dd($down_line) ;

            }
        }
    }
}
