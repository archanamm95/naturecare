<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Crypt;
use DB;
use Auth;
use Html;
use Storage;
use Illuminate\Database\Eloquent\SoftDeletes;



class Sponsortree extends Model
{
    use SoftDeletes;

    protected $table="sponsortree";

    public static $downline=array();
    public static $downlineIDArray=array();
    public static $downlineIDArrayId=array();
    public static $downlineid=array();

    public static $upline_users=array();

    protected $dates = ['deleted_at'];

    protected $fillable=['user_id','sponsor','position','type','member_count'];

    public static function createVaccant($user_id, $position)
    {

        return self::create([
        'user_id'=>0,
        'sponsor'=>$user_id,
        'position'=>$position +1 ,
        'type'=>'vaccant'
        ]);
    }




    public static function getAllDownlines($root = true, $sponsor = "")
    {

        if ($root) {
             $data= self::where('sponsortree.user_id', $sponsor)
             ->join('users', 'sponsortree.user_id', '=', 'users.id')
             ->select('sponsortree.id', 'sponsortree.user_id', 'sponsortree.type', 'users.username', 'users.username as userid')
             ->get();
        } else {
             $data= self::where('sponsortree.sponsor', $sponsor)->where('type', 'yes')->orderBy('position', 'ASC')
             ->join('users', 'sponsortree.user_id', '=', 'users.id')
             ->select('sponsortree.id', 'sponsortree.user_id', 'sponsortree.type', 'users.username', 'users.username as userid')
             ->get();
        }

        foreach ($data as $value) {
            if ($value->type=="yes") {
                 self::$downline[$value->id]['user_id'] =$value->userid;
                 self::$downline[$value->id]['username'] =$value->username;
                 self::$downline[$value->id]['id'] =$value->user_id;
                 self::getDownlines(false, $value->user_id);
            } else {
                self::$downline[$value->id]['user_id'] =$value->userid;
                self::$downline[$value->id]['username'] =$value->username;
                self::$downline[$value->id]['id'] =$value->user_id;
            }
        }
        return  1 ;
    }


    public static function getDownlines($root = true, $sponsor = "", $treearray = array(), $level = 0)
    {


        $max_level = 2 ;
     

        // if($level == $max_level) {
        //  return  ;
        // }
        if ($root) {
             $data= self::where('sponsortree.user_id', $sponsor)
             ->join('users', 'sponsortree.user_id', '=', 'users.id')
             ->select('sponsortree.id', 'sponsortree.user_id', 'sponsortree.type', 'users.username', 'users.username as userid')
             ->get();
        } else {
             $data= self::where('sponsortree.sponsor', $sponsor)
             ->where('type', '!=', 'vaccant')
             ->orderBy('position', 'ASC')
             ->join('users', 'sponsortree.user_id', '=', 'users.id')
             ->select('sponsortree.id', 'sponsortree.user_id', 'sponsortree.type', 'users.username', 'users.username as userid')
             ->get();
        }
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

    public static function getDownlinesId($root = true, $sponsor = "", $treearray = array(), $level = 0)
    {


        $max_level = 2 ;
     

        // if($level == $max_level) {
        //  return  ;
        // }
        if ($root) {
             $data= self::where('sponsortree.user_id', $sponsor)
             ->join('users', 'sponsortree.user_id', '=', 'users.id')
             ->select('sponsortree.id', 'sponsortree.user_id', 'sponsortree.type', 'users.username', 'users.username as userid')
             ->get();
        } else {
             $data= self::where('sponsortree.sponsor', $sponsor)
             ->where('type', '!=', 'vaccant')
             ->orderBy('position', 'ASC')
             ->join('users', 'sponsortree.user_id', '=', 'users.id')
             ->select('sponsortree.id', 'sponsortree.user_id', 'sponsortree.type', 'users.username', 'users.username as userid')
             ->get();
        }
        foreach ($data as $value) {
            if ($value->type =="yes"  || $value->type =="no") {
                 self::$downlineid[$value->user_id] =$value->user_id;
                 self::$downlineIDArrayId[] =$value->user_id;
                 self::getDownlinesId(false, $value->user_id, $treearray, $level+1);
            } else {
                self::$downlineid[$value->user_id] =$value->user_id;
                self::$downlineIDArrayId[] =$value->user_id;
            }
        }
        return  1 ;
    }

    // public static function getTreeOLD($root = true, $sponsor = "", $treedata = array(), $level = 0)
    // {

    //     if ($level == 3) {
    //         return false ;
    //     }
    //     if ($root) {
    //         $data= self::where('sponsortree.user_id', $sponsor)
    //                ->leftJoin('users', 'sponsortree.user_id', '=', 'users.id')
    //                ->leftJoin('point_table', 'sponsortree.user_id', '=', 'point_table.user_id')
    //                 ->leftJoin('rank_setting', 'rank_setting.id', '=', 'users.rank_id')
    //                ->leftjoin('profile_infos', 'profile_infos.user_id', '=', 'sponsortree.user_id')
    //                ->select('sponsortree.*', 'users.username', 'users.name', 'users.lastname', 'profile_infos.image', 'profile_infos.package', 'point_table.pv', 'users.active', 'point_table.left_carry', 'point_table.right_carry', 'point_table.total_left', 'point_table.total_right', 'rank_setting.rank_name')
    //                ->get();
    //     } else {
    //         $data= self::where('sponsortree.sponsor', $sponsor)
    //              ->where('type', '!=', 'vaccant')
    //              ->orderBy('position', 'ASC')
    //              ->leftJoin('users', 'sponsortree.user_id', '=', 'users.id')
    //              ->leftJoin('point_table', 'sponsortree.user_id', '=', 'point_table.user_id')
    //               ->leftJoin('rank_setting', 'rank_setting.id', '=', 'users.rank_id')
    //              ->leftjoin('profile_infos', 'profile_infos.user_id', '=', 'sponsortree.user_id')
    //              ->select('sponsortree.*', 'users.username', 'users.name', 'users.lastname', 'profile_infos.image', 'profile_infos.package', 'point_table.pv', 'users.active', 'point_table.left_carry', 'point_table.right_carry', 'point_table.total_left', 'point_table.total_right', 'rank_setting.rank_name')
    //              ->get();
    //     }

    //            $currentuserid = Auth::user()->id;
    //            $treearray=array();

    //     foreach ($data as $value) {
    //         if ($value->type =="yes" || $value->type =="no") {
    //                  $push = self::getTree(false, $value->user_id, $treearray, $level + 1);
    //             if ($root) {
    //                 $class = 'up';
    //                 $usertype = 'root';
    //                  $user_active_class = 'active';
    //             } else {
    //                 $class='down';
    //                 $usertype = 'child';
    //                 if ($value['active']=='yes') {
    //                      $user_active_class = 'active';
    //                 } elseif ($value['active']=='no') {
    //                      $user_active_class = 'inactive';
    //                 }
    //             }
    //                  $username         = $value->username;
    //                  $name         = $value->name;
    //                  $lastname         = $value->lastname;
    //                  $rank_name         = $value->rank_name;
    //                  $id         = $value->user_id;
    //                  $accessid         = Crypt::encrypt($value->user_id);
    //             if (Auth::user()->id == 1) {
    //                 $inbox='admin';
    //             } else {
    //                 $inbox='user';
    //             }


    //                  $package_name = Packages::where('id', '=', $value->package)->value('package');
    //             // echo "  ---  $value->username   --- $value->package  ,   </br>";
    //             // $content = '' . Html::image('http://randomuser.me/api/portraits/men/'.$imgname.'.jpg', $username, array('class'=>$class.' tree-user','style' => 'max-width:50px;cursor:pointer;','data-accessid'=>$accessid)) . '';
    //                  $user_photo = '' . Html::image(route('imagecache', ['template' => 'profile', 'filename' => self::profilePhoto($username)]), $username, array('class'=>$class.' tree-user ','style' => 'max-width:50px;','data-accessid'=>$accessid)) . '';
                
    //                  $content = '
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
    //                                 <span class="font-weight-semibold">'.trans('dashboard.full_name').': </span>
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
    //                 <a href="#" class="list-icons-item flex-fill p-1 bg-slate-700 text-white toggle-more-content btn" data-popup="" data-container="body" title="" data-original-title="'.trans('dashboard.more_details').'" data-target="#more-'.$username.'">
    //                     <i class="icon-profile"></i>
    //                 </a>  
    //                   <a href="'.url($inbox.'/inbox#/u/mail/compose/?usnm='.$username).'" target="_blank" class="list-icons-item flex-fill p-1 btn bg-brown text-white" data-popup="tooltip" data-container="body" title="" data-original-title="'.trans('tree.send_mail').'">                                   
    //                     <i class="icon-mail5"></i>
    //                 </a> 
    //                 <button class="list-icons-item flex-fill p-1 btn bg-indigo-400 text-white btn-copy" data-popup="tooltip" data-container="body" title="" data-original-title="'.trans('tree.copy_username_to_clipboard').'" data-clipboard-content="'.$username.'">                                   
    //                     <i class="icon-paste"></i>
    //                 </button>
                                        
    //             </div>
    //            ';

            


    //                  $coverPhoto = '' . Html::image(route('imagecache', ['template' => 'large', 'filename' => self::coverPhoto($username)]), $username, array('class'=>$class.' tree-user','style' => '','data-accessid'=>$accessid)) . '';

                

    //                  $info    = "
    //             <div class='hoverouter'>
    //             <div class='hoverinner'>
                    
    //                         <div class='coverholder'>
    //                             $coverPhoto
    //                         </div>
    //                         <div class='backgroundgd'>
    //                         </div>
                        
    //                 <div class='primeinfo' >
    //                     <div class='primeinfohold' >
                            
    //                             <div class='ellipsis username'>
    //                                 $value->username
    //                             </div>
                           
    //                     </div>
    //                     <ul class='secondaryinfo'>
    //                         <li class='rankname'>
    //                             <span class='key'>Rank</span> :  <span class='value'>$value->rank_name</span>
    //                         </li class='packagename'>                            
    //                         <li>
    //                             <span class='key'>Package</span> : <span class='value'>$package_name</span>
    //                         </li>                            
    //                         <li class='topupcount'>
    //                             <span class='key'>Top Ups</span> : <span class='value'>".PurchaseHistory::where('user_id', '=', $value->user_id)->sum('count')."</span>
    //                         </li>                            
    //                         <li class='rsbalance'>
    //                             <span class='key'>RS balance</span> : <span class='value'>".RsHistory::where('user_id', '=', $value->user_id)->sum('rs_credit')."</span>
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
                
    //                 </tbody>
    //             </table>
    //             <div class='pillforholder'>
    //             </div>
    //             <div class='details'>
             
                
    //             <table class='table table-condensed'>
    //             <thead>
    //             <tr>
    //                 <td>Total left</td>
    //                 <td>Total right</td>
    //                 <td>Left point</td>
    //                 <td>Right point</td>
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

               


    //                  $className = $user_active_class;


    //             //         $package_name = Packages::where('id','=',$value->package)->value('package');
                        
    //             //         $content = '' . Html::image(route('imagecache', ['template' => 'profile', 'filename' => self::profilePhoto($username)]), $username, array('class'=>$class.' tree-user','style' => 'max-width:50px;','data-accessid'=>$accessid)) . '';

    //             //         $coverPhoto = '' . Html::image(route('imagecache', ['template' => 'large', 'filename' => self::coverPhoto($username)]), $username, array('class'=>$class.' tree-user','style' => '','data-accessid'=>$accessid)) . '';

                

    //             //         $info    = "<div class='hoverouter'>
    //             //                         <div class='hoverinner'>
    //             //                             <div class='coverholder'>
    //             //                               $coverPhoto
    //             //                             </div>
    //             //                             <div class='backgroundgd'>
    //             //                             </div>
    //             //                             <div class='primeinfo' >
    //             //                                 <div class='primeinfohold' >
    //             //                                     <div class='ellipsis username'>
    //             //                                         $value->username
    //             //                                     </div>
    //             //                                 </div>
    //             //                                 <ul class='secondaryinfo'>
    //             //                                     <li class='rankname'>
    //             //                                         <span class='key'>Rank</span> :  <span class='value'>$value->rank_name</span>
    //             //                                     </li>
    //             //                                     <li  class='packagename'>
    //             //                                         <span class='key'>Package</span> : <span class='value'>$package_name</span>
    //             //                                     </li>
    //             //                                     <li class='topupcount'>
    //             //                                         <span class='key'>Top Ups</span> : <span class='value'>".PurchaseHistory::where('user_id', '=', $value->user_id)->sum('count')."</span>
    //             //                                     </li>
    //             //                                     <li class='rsbalance'>
    //             //                                         <span class='key'>RS balance</span> : <span class='value'>$value->revenue_share</span>
    //             //                                     </li>
    //             //                                 </ul>
    //             //                             </div>
    //             //                         </div>

    //             //                         <table cellpadding='0' cellspacing='0' class='profcontenttbl' >
    //             //                             <tbody>
    //             //                                 <tr>
    //             //                                     <td rowspan='2' valign='top'>
                                                       
    //             //                                             <div class='profpicholder'>
    //             //                                                 $content
    //             //                                             </div>
                                                      
    //             //                                     </td>
    //             //                                 </tr>
    //             //                                 <tr valign='bottom'>
    //             //                                     <td class='secinfo-list-holder'>
    //             //                                         <div class=''>
    //             //                                             <ul class='secinfo-list'>
    //             //                                                 <li>
    //             //                                                     1 new post
    //             //                                                 </li>
    //             //                                             </ul>
    //             //                                         </div>
    //             //                                     </td>
    //             //                                 </tr>
    //             //                             </tbody>
    //             //                         </table>
    //             //                         <div class='pillforholder'></div>
    //             //                         <div class='details'>
             
                
    //             //                         <table class='table table-condensed'>
    //             //                             <thead>
    //             //                                 <tr>
    //             //                                     <td>Total left</td>
    //             //                                     <td>Total right</td>
    //             //                                     <td>Left point</td>
    //             //                                     <td>Right point</td>
    //             //                                 </tr>
    //             //                             </thead>
    //             //                             <tbody>
    //             //                                 <tr>
    //             //                                     <td>$value->total_left</td>
    //             //                                     <td>$value->total_right</td>
    //             //                                     <td>$value->left_carry</td>
    //             //                                     <td>$value->right_carry</td>
    //             //                                 </tr>
    //             //                             </tbody>
    //             //                         </table>
      
    //             //                         </div>
    //             //                 </div>";
    //             // $className = "active";
    //                  $treearray[$value->id]['id']      =  $id;
    //                  $treearray[$value->id]['name']      = $username;
    //                  $treearray[$value->id]['content']   = $content;
    //                  $treearray[$value->id]['accessid']      =  $accessid;
    //                  $treearray[$value->id]['currentuserid'] = $currentuserid;
    //                  $treearray[$value->id]['info']      = $info;
    //                  $treearray[$value->id]['className'] = $className;
    //                  $treearray[$value->id]['usertype'] = $usertype;
    //             // echo "  <br/> start $value->id  -- " ;
    //             if (!empty(array_first($push)) || !empty(array_last($push))) {
    //                 $treearray[$value->id]['children'] = array_values($push);
    //             }
    //         } else {
    //          // $placement_accessid = Crypt::encrypt(Sponsortree::where('sponsor',$value->sponsor)->value('id'));

    //          // $username      = "<span class='enroll'>Add here</span>";
    //          // $content   = "<img class='' data-accessid='$placement_accessid' style='max-width:50px;cursor:pointer;' src='/files/images/users/profile_photos/thumbs/plus.png'>";
    //          // $info      = "<a href='/add'>Add</a>";
    //          // $className = "vacant";
    //          // $treearray[$value->id]['name']      = $username;
    //          // $treearray[$value->id]['content']   = $content;
    //          // $treearray[$value->id]['info']      = $info;
    //          // $treearray[$value->id]['className'] = $className;
    //          // $treearray[$value->id]['usertype'] = 'server';
    //          // $treearray[$value->id]['placement_accessid'] = $placement_accessid;
    //          // // $treearray[$value->id]['placement_username'] = $placement_username;
    //         }
    //     }
    //        $treedata = $treearray;
    //        return $treedata;
    // }

    public static function getTree($root = true, $sponsor = "", $treedata = array(), $level = 0)
    {

        if ($level == 3) {
            return false ;
        }
        if ($root) {
            $data= self::where('sponsortree.user_id', $sponsor)
                   ->leftJoin('users', 'sponsortree.user_id', '=', 'users.id')
                   ->leftJoin('point_table', 'sponsortree.user_id', '=', 'point_table.user_id')
                    
                   ->leftjoin('profile_infos', 'profile_infos.user_id', '=', 'sponsortree.user_id')
                   ->select('sponsortree.*', 'users.username','users.email', 'users.name','users.created_at', 'users.lastname','users.status', 'users.user_type', 'profile_infos.image', 'profile_infos.package', 'point_table.pv', 'users.active', 'point_table.left_carry', 'point_table.right_carry', 'point_table.total_left', 'point_table.total_right','sponsortree.member_count')
                   ->get();
        } else {
            $data= self::where('sponsortree.sponsor', $sponsor)
                 ->where('type', '!=', 'vaccant')
                 ->orderBy('position', 'ASC')
                 ->leftJoin('users', 'sponsortree.user_id', '=', 'users.id')
                 ->leftJoin('point_table', 'sponsortree.user_id', '=', 'point_table.user_id')
                 
                 ->leftjoin('profile_infos', 'profile_infos.user_id', '=', 'sponsortree.user_id')
                 ->select('sponsortree.*', 'users.username', 'users.name', 'users.created_at', 'users.lastname','users.status', 'users.user_type', 'profile_infos.image', 'profile_infos.package', 'point_table.pv', 'users.active', 'point_table.left_carry', 'point_table.right_carry', 'point_table.total_left', 'point_table.total_right','sponsortree.member_count')
                 ->get();
        }

        $currentuserid = Auth::user()->id;
        $treearray=array();
        // dd($data);
        foreach ($data as $value) {


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

                     // $left_member_count=PointTable::where('user_id','=',$value->user_id)->value('left_user');
                     // $right_member_count=PointTable::where('user_id','=',$value->user_id)->value('right_user');

                     // $package_name = Packages::where('id', '=', $value->package)->value('package');
                     $member_type = $value->user_type;
                     // dd($member_type);
                     $balance = round(Balance::where('user_id', '=', $value->user_id)->value('balance'),4);
                     // $member_count =  self::where('sponsor','=',$value->sponsor)->value('member_count');
                     $member_count = $value->member_count;


                    // dd($username);
                     $user_photo = '' . Html::image(route('imagecache', ['template' => 'profile', 'filename' => self::profilePhoto($username)]), $username, array('class'=>$class.' tree-user ','style' => 'max-width:50px;','data-accessid'=>$accessid)) . '';
                
            //          $content = '
            //     <div class="container tree-node-box">
            //         <div class="">
            //             <div class="tree-img-holder">'.$user_photo.'</div>
            //             <div class="pt-1 pb-1 col-md-12 text-center userName" title="'.$username.'">
            //                 <strong>'.$username.'</strong>
            //             </div>
            //             <div class="tree-user-more-details" id="more-'.$username.'">
            //                 <div class="card " style="padding: 0;margin: 0;width: 100%;">
            //                 <div class="card-body pl-0 pr-0 pb-0 pt-0 text-center">    

            //                 <ul class="list-group list-group-flush border-top">
            //                     <li class="list-group-item">
            //                         <span class="font-weight-semibold">'.trans('dashboard.full_name').': </span>
            //                         <div class="ml-auto font-weight-bold">'.$name.' '.$lastname.'</div>
            //                     </li>                          
            //                     <li class="list-group-item">
            //                         <span class="font-weight-semibold">'.trans('tree.rank').' : </span>
            //                         <div class="ml-auto font-weight-bold">'.$rank_name.'</div>
            //                     </li>
            //                     <li class="list-group-item">
            //                         <span class="font-weight-semibold">'.trans('tree.package').' : </span>
            //                         <div class="ml-auto font-weight-bold">'.$package_name.'</div>
            //                     </li>
            //                 </ul>                          


                               
                                
            //                 </div>
            //             </div>
            //             </div>
            //         </div>
            //     </div>
            //     <div class="d-flex justify-content-around text-center p-0 btn-group tree-node-box-tools">
            //         <a href="#" class="list-icons-item flex-fill p-1 bg-slate-700 text-white toggle-more-content btn" data-popup="" data-container="body" title="" data-original-title="'.trans('dashboard.more_details').'" data-target="#more-'.$username.'">
            //             <i class="icon-profile"></i>
            //         </a>  
            //           <a href="'.url($inbox.'/inbox#/u/mail/compose/?usnm='.$username).'" target="_blank" class="list-icons-item flex-fill p-1 btn bg-brown text-white" data-popup="tooltip" data-container="body" title="" data-original-title="'.trans('tree.send_mail').'">                                   
            //             <i class="icon-mail5"></i>
            //         </a> 
            //         <button class="list-icons-item flex-fill p-1 btn bg-indigo-400 text-white btn-copy" data-popup="tooltip" data-container="body" title="" data-original-title="'.trans('tree.copy_username_to_clipboard').'" data-clipboard-content="'.$username.'">                                   
            //             <i class="icon-paste"></i>
            //         </button>
                                        
            //     </div>
            //    ';

            


                 

               

                     $currentuserid = Auth::user()->id;
                     // $class_name = "active";



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
                     $treearray[$value->id]['pv']       = $value->pv;
                     $treearray[$value->id]['last_name']       = $value->lastname;
                     $treearray[$value->id]['date_of_joining'] = date('Y-m-d', strtotime($value->created_at));
     
                     
                     $treearray[$value->id]['rank_name'] = $value->user->rank->rank_name;
                     // $treearray[$value->id]['package_name'] = $package_name;
                     
                     $treearray[$value->id]['balance'] = $balance;
     
                     // $treearray[$value->id]['left_carry'] = $value->user->point->left_carry;
                     // $treearray[$value->id]['right_carry'] = $value->user->point->right_carry;
                     // $treearray[$value->id]['total_left'] = $value->user->point->total_left;
                     // $treearray[$value->id]['total_right'] = $value->user->point->total_right;
                     // $treearray[$value->id]['left_user'] = $left_member_count;
                     // $treearray[$value->id]['right_user'] = $right_member_count;
                     
                     $treearray[$value->id]['user_type'] = $usertype;
                     $treearray[$value->id]['member_type'] = $member_type;

                         if (Auth::user()->id == 1) {
                      $treearray[$value->id]['user_role'] ='admin';
                     } else {
                     $treearray[$value->id]['user_role'] ='user';
                      }



                    //  $treearray[$value->id]['id']      =  $id;
                    //  $treearray[$value->id]['name']      = $username;
                    //  $treearray[$value->id]['content']   = $content;
                    //  $treearray[$value->id]['accessid']      =  $accessid;
                    //  $treearray[$value->id]['currentuserid'] = $currentuserid;
                    //  $treearray[$value->id]['info']      = $info;
                    //  $treearray[$value->id]['className'] = $className;
                    //  $treearray[$value->id]['usertype'] = $usertype;
 
                if (!empty(array_first($push)) || !empty(array_last($push))) {
                    $treearray[$value->id]['children'] = array_values($push);
                }
            } else {
            
            }
        }
           $treedata = $treearray;

           return $treedata;
    }
    public static function userImage($user_name)
    {
        $image =  DB::table('users')->where('username', $user_name)->pluck('image');
        return $image;
    }

    public static function generateTree($users, $level = 0, $tree_structure = "")
    {
         
        $x = collect(collect($users)->first());
        return $x->toJson();
    }


    public static function getTreeJson($user_id)
    {

            

        $result_arr=[];
        $result=self::where('sponsortree.sponsor', '=', $user_id)
            ->where('type', '!=', 'vaccant')
            ->orderBy('position', 'ASC')
            ->leftJoin('users', 'sponsortree.user_id', '=', 'users.id')
            ->select('sponsortree.*', 'users.username', 'users.name', 'users.lastname', 'users.active','users.user_type')
            ->get();
        foreach ($result as $key => $user) {
              $child_count = count(self::getMyReferals($user->user_id));
              
            if ($child_count) {
                $children=true ;
                $type="root";
            } else {
                $type="folder";
                $children=false ;
            }
              $icon="icon-user text-warning  fa-lg  ";
          
                    if ($user->user_type =='Member') {
                        $icon="icon-user   fa-lg  text-danger";
                    }
                    elseif ($user->user_type =='Dealer') {
                        $icon="icon-user   fa-lg  text-info";
                    }
                    elseif ($user->user_type =='Shop_Partner') {
                       $icon="icon-user text-success  fa-lg  ";
                    }

              $user->username= (($user->username == null)?  "server"   :  $user->username);

            
            $result_arr[]=array(
              'id'=>Crypt::encrypt($user->user_id),
              'text'=>"$user->username $user->name $user->lastname",
              'children'=>$children,
              'type'=>$type,
              'file'=>'treedata',
              'icon'=>$icon,
              "state"=> array("opened"=> false)
              );
        }

            return $result_arr;
    }

    public static function getSponsorID($user_id)
    {


        return self::where('user_id', $user_id)->value('sponsor');
    }

    public static function getSponsorUsername($user_id)
    {


        return self::where('user_id', $user_id)
                  ->join('users', 'users.id', '=', 'sponsortree.sponsor')
                  ->value('username');
    }
    public static function profilePhoto($user_name)
    {
        $user  = User::where('username', $user_name)->with('profile_info')->first();
        $image = $user->profile_info->profile;
        //if (!Storage::disk('images')->exists($image)){
         //   $image = 'avatar-big.png';
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

    public static function getMyReferals($user_id)
    {
        return ProfileInfo::select('profile_infos.*', 'users.username as username', 'users.email as email', 'users.name as name', 'users.lastname as lastname')
                    ->join('users', 'users.id', '=', 'profile_infos.user_id')
                    ->join('sponsortree', 'sponsortree.user_id', '=', 'profile_infos.user_id')
                    ->where('sponsortree.sponsor', $user_id)
                    ->get();
    }



    public static function getNearestGold($user_id)
    {

        $variable =  self::join('users', 'users.id', '=', 'sponsortree.sponsor')
            ->where('sponsortree.user_id', '=', $user_id)
            ->select('sponsortree.*', 'users.package')
            ->take(1)
            ->get();

        foreach ($variable as $key => $value) {
            if ($value->package  == 4  && ( $value->type == 'yes' || $value->type == 'no')) {
                return $value->sponsor ;
            } else {
                return self::getNearestGold($value->sponsor);
            }
        }

            return 1 ;
    }

    public static function getAllUpline($user_id, $level = 0)
    {

    

        $result = self::where('sponsortree.user_id', $user_id)
                      ->select('sponsortree.sponsor')
                      ->take(1)
                      ->get();


        foreach ($result as $key => $value) {
            self::$upline_users[]=['user_id'=>$value->sponsor];
            if ($value->sponsor) {
                  self::getAllUpline($value->sponsor, $level++);
            }
        }

            return true;
    }



    public static function getAllUplineX($user_id, $level = 0)
    {

    

        $result = self::where('sponsortree.user_id', $user_id)
                    ->join('tree_table', 'tree_table.user_id', '=', 'sponsortree.sponsor')
                    ->join('users', 'users.id', '=', 'sponsortree.sponsor')
                      ->select('sponsortree.sponsor', 'tree_table.type')
                      ->take(1)
                      ->get();

        foreach ($result as $key => $value) {
            self::$upline_users[]=['user_id'=>$value->sponsor,'type'=>$value->type,'package'=>$value->package];
            if ($value->sponsor) {
                  self::getAllUplineX($value->sponsor, $level++);
            }
        }

            return true;
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


    //RELATIONSHIPS - Added By Aslam
    public function user()
    {
        return $this->belongsTo('App\User');
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
            $oldsponsor = self::where('user_id',$user_id)->value('sponsor');

            self::$downlineid =[];
            self::getDownlinesId(FALSE,$user_id);
            $getdownline_users=self::$downlineid;
// dd($getdownline_users);
            if((in_array($sponsor_id, $getdownline_users)) || $sponsor_id==$user_id || $user_id==1)
                return redirect()->back()->withErrors('Unable To Change Sponsor');
        // dd(self::where('user_id',$user_id)->count());
            if(self::where('user_id',$user_id)->count() !=0 && self::where('user_id',$sponsor_id)->count() !=0 && $user_id != $sponsor_id)
            {
              // dd(3);
              self::where('user_id',$user_id)->delete();

              $sponsortreeid = self::where('sponsor', $sponsor_id)->where('type', 'vaccant')->orderBy('id', 'desc')->take(1)->value('id');
              // dd($sponsortreeid);
              $sponsortree          = self::find($sponsortreeid);
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

              $sponsorvaccant = self::createVaccant($sponsor_id,$sponsortree->position);
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
