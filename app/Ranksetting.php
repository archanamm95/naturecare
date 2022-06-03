<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ranksetting extends Model
{
    protected $table="rank_setting";

    protected $fillable=['rank_name','top_up','quali_rank_id','quali_rank_count','rank_bonus'];


    public static function idToRankname($id)
    {
        return  self::where('id', $id)->value('rank_name');
    }
    public static function getUserRank($id)
    {
        $rank_id=User::where('id', $id)->value('rank_id');
        return $rank_id;
    }
    public static function maxRankId()
    {
        return  self::max('id');
    }
    public static function updateRankSettings($cloumn_name, $rank_id, $value)
    {
        if ($cloumn_name == 'rank_name') {
            self::where('id', '=', $rank_id)->update(['rank_name' => $value]);
        } elseif ($cloumn_name == 'top_up') {
            self::where('id', '=', $rank_id)->update(['top_up' => $value]);
        } elseif ($cloumn_name == 'quali_rank_id') {
            self::where('id', '=', $rank_id)->update(['quali_rank_id' => $value]);
        } elseif ($cloumn_name == 'quali_rank_count') {
            self::where('id', '=', $rank_id)->update(['quali_rank_count' => $value]);
        } elseif ($cloumn_name == 'rank_bonus') {
            self::where('id', '=', $rank_id)->update(['rank_bonus' => $value]);
        } elseif ($cloumn_name == 'left_puser_count') {
            self::where('id', '=', $rank_id)->update(['left_puser_count' => $value]);
        } elseif ($cloumn_name == 'right_puser_count') {
            self::where('id', '=', $rank_id)->update(['right_puser_count' => $value]);
        }
    }
    public static function checkRankupdate($user_id, $current_rank, $level = 1)
    {
        
        if ($current_rank == self::maxRankId()) {
            return true;
        }


        
        $next_rank_details=self::find($current_rank+1);
        $quali_rank_count =0;
        
        /* Total top up*/
        $total_top_up =PurchaseHistory::where('user_id', '=', $user_id)->count();
        
        /* direct enrolls rank and count*/
        if ($next_rank_details->quali_rank_id and  $next_rank_details->quali_rank_count) {
            $quali_rank_count=Tree_Table::where('sponsor', $user_id)
                                    ->join('users', 'tree_table.user_id', '=', 'users.id')
                                    ->where('users.rank_id', '>=', $next_rank_details->quali_rank_id)
                                    ->count();
        }

        ;
      
        
        /* check for rank upgrade */

        if (($total_top_up >= $next_rank_details->top_up )  && ($quali_rank_count >= $next_rank_details->quali_rank_count)) {
            $user=User::find($user_id);
            $user->rank_id=$next_rank_details->id;
            $user->save();

            $sponsor = User::find(Tree_Table::where('user_id', '=', $user_id)->value('sponsor'));

            if ($sponsor->id > 1 && $level == 1) {
                return self::checkRankupdate($sponsor->id, $sponsor->rank_id, 2);
            }
        }
        
        
        return true;
    }

    public static function updateUserRank($rank_id, $last_rank, $user_id, $remarks)
    {
       
         return self::insertRankHistory($user_id, $rank_id, $last_rank, $remarks);
    }
    public static function insertRankHistory($user_id, $rank_id, $last_rank, $remarks)
    {
        return Rankhistory::create([
                "user_id"=>$user_id,
                "rank_id"=>$last_rank,
                "rank_updated"=>$rank_id,
                "remarks"=>$remarks,
                    ]);
    }



    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    
    public static function newRankupdate($user_id)
    {   
        $uplines = Tree_Table::$upline_users;
        foreach ($uplines as $key => $value) {
            $current_rank=self::getUserRank($value['user_id']);
            if ($current_rank != self::maxRankId()) {
                $next_rank=self::find($current_rank+1);
                $point_details=PointTable::where('user_id',$value['user_id'])->first();
                if(($point_details->left_user >= $next_rank->quali_rank_id) && ($point_details->right_user >= $next_rank->quali_rank_count) && 
                   ($point_details->left_puser >= $next_rank->left_puser_count) && ($point_details->right_puser >= $next_rank->right_puser_count))
                {    
                    if($next_rank->top_up > 0)
                    {
                        $leftreq = User::where('sponsor_id',$value['user_id'])->where('rank_id',$next_rank->top_up)->where('leg','L')->count();
                        if($leftreq >= $next_rank->left_puser_count){
                            $righttreq = User::where('sponsor_id',$value['user_id'])->where('rank_id',$next_rank->top_up)->where('leg','R')->count();
                            if($righttreq >= $next_rank->right_puser_count){
                                $user=User::find($value['user_id']);
                                $user->rank_id=$next_rank->id;
                                $user->save();
                                self::insertRankHistory($value['user_id'],$next_rank->id,$current_rank,'update');         
                            }
                        }
                    }else{
                        $user=User::find($value['user_id']);
                        $user->rank_id=$next_rank->id;
                        $user->save();
                        self::insertRankHistory($value['user_id'],$next_rank->id,$current_rank,'update');      
                    }
                }
            }
        }
        return 1;
    }
    // public static function poolBonus()
    // {
    //     $purchase_history=PurchaseHistory::get();
    //     $total_bv=PurchaseHistory::sum('bv');
    //     $total_count=PurchaseHistory::sum('count');
    //     $poolbonus=($total_bv * $total_count) *0.3 ;
    //     $max_rank_id=self::maxRankId();
    //     for ($i=2; $i <= $max_rank_id ; $i++) {
    //     $users_{$i} =User::where('rank_id','=',$i)
    //     ->join('rank_setting','rank_setting.id','=','users.rank_id')
    //     ->select('rank_setting.pool_share','users.id','users.username','users.rank_id')
    //     ->get();
    //     $user_count[$i]=count($users_{$i});
    //     }
    //     $total_usercount=array_sum($user_count);
    //     $shares=$poolbonus / $total_usercount;
    //     foreach ($user_count as $key => $value) {
    //         $leadership_pool_bonus[$key]=$shares * $value  ;
    //     }
    //     for ($i=2; $i <=$max_rank_id ; $i++) { 
    //         $rank=Ranksetting::where('id','=',$i)->value('pool_share');
    //         $pool_amount=$rank * $leadership_pool_bonus[$i];
    //         $users=User::where('rank_id',$i)->get();
    //         foreach ($users as $key => $value) {
    //             Commission::create([
    //                 'user_id'        => $value->id,
    //                 'from_id'        => 1,
    //                 'total_amount'   => $pool_amount,
    //                 'tds'            => 0,
    //                 'service_charge' => 0,
    //                 'payable_amount' => $pool_amount,
    //                 'payment_type'   => 'leadership_pool_bonus',
    //                 'payment_status' => 'Yes',
    //             ]);
    //             PoolHistory::create([
    //                 'total_bv'            =>$total_bv,
    //                 'total_count'         =>$total_count,
    //                 'poolbonus'           =>$poolbonus,
    //                 'qualified_user_count'=>$total_usercount,
    //                 'share_amount'        =>$shares,

    //             ]);
    //             Balance::where('user_id', $value->id)->increment('balance', $pool_amount);
    //         }
            
    //     }
    //     echo "done";
    // }     

    public static function poolBonus($data){

        $rank_settings = Ranksetting::where('id','>',1)->where('id','<>',5)->get();

        $total_bv      = ($data['pool_balance']*100)/$data['pool_percentage'];
        $pool_history  = PoolHistory::create([
            'total_bv'            =>$total_bv,
            'total_count'         =>$data['total_users'],
            'poolbonus'           =>$data['pool_balance'],
            'qualified_user_count'=>$data['total_share'],
            'share_amount'        =>$data['one_share'],
        ]);

        $total_users = 0;
        $total_share = 0;
        $user_rank_data = array();

        foreach ($rank_settings as $key => $value) {
            $user_data = User::join('profile_infos','profile_infos.user_id','users.id')->where('profile_infos.country','MY')->where('rank_id',$value->id)->get();
            if(count($user_data) > 0){
                $pool_amount = $data['one_share'] * $value->pool_share;
                foreach ($user_data as $key1 => $value1) {
                    if($pool_amount > 0){

                        Commission::create([
                            'user_id'        => $value1->id,
                            'from_id'        => 1,
                            'total_amount'   => $pool_amount,
                            'tds'            => 0,
                            'service_charge' => $pool_history->id,
                            'payable_amount' => $pool_amount,
                            'payment_type'   => 'leadership_pool_bonus',
                            'payment_status' => 'Yes',
                            'note'           => $value1->rank_id,
                        ]);
                        Balance::where('user_id', $value1->id)->increment('balance', $pool_amount); 
                    }
                }               
            }
        }
        PurchaseHistory::where('pool_status','no')->update(['pool_status'=>'yes']);
    }         
}
