<?php

namespace App\Http\Controllers\user;

use App\Http\Requests\Admin\treeRequest;
use App\Mail;
use App\Sponsortree;
use App\InfluencerTree;
use App\Tree_Table;
use App\User;
use Auth;
use Crypt;
use Input;
use DB;
use Response;


use App\Http\Controllers\Controller;
use App\Http\Controllers\user\UserAdminController;

use Illuminate\Http\Request;

class GenealogyTreeController extends UserAdminController
{
     /**
     * Display the page with tree holder.
     *
     * @return Response
     */

    public function index()
    {

        $title     = trans('tree.binary_genealogy');
        $sub_title = trans('tree.binary_genealogy');
        $base      = trans('tree.binary_genealogy');
        $method    = trans('tree.binary_genealogy');
        return view('app.admin.tree.index', compact('tree', 'title', 'unread_count', 'unread_mail', 'user', 'sub_title', 'base', 'method'));
    }


    public function getTree(treeRequest $request, $levellimit)
    {

        $user_id = $request->data;
        
        //Get level limit from ajax options, if not specified, fall back to 5.
        $levellimit = isset($request->levellimit) ? $request->levellimit : 5;
        //If someone alternate levellimit to consume memory, dont allow that, fall back to 10 if its greater than 10.
        if ($levellimit > 10) {
            $levellimit = 10;
        }

        if ($request->data == 1) {
            $user_id = Auth::user()->id;
        }
        if ($request->data != 1) {
            $user_id =User:: where('username', $request->data)->value('id');
        }
        if ($user_id == null) {
            $user_id = Auth::user()->id;
        }
        $tree = Tree_Table::getTree(true, $user_id, array(), 0, $levellimit);
        return $tree = Tree_Table::generateTree($tree);
    }


    
    /**
     * getChildrenGenealogy
     * @param  [var] $id [id of user]
     * @return [json]     [returns json data with children wrapper]
     */
    public function getChildrenGenealogyByUserName($username, $levellimit)
    {
        if($username == 'lowestleftuser')
            $user_id = Tree_Table::getPlacementId(Auth::user()->id,'L');
        elseif ($username == 'lowestrightuser')
            $user_id = Tree_Table::getPlacementId(Auth::user()->id,'R');
        else
            $user_id = User::where('username', $username)->value('id');
        
        $tree = Tree_Table::getTree(true, $user_id, array(), 0, $levellimit);
        return $tree = Tree_Table::generateTree($tree);
    }

    /**
     * getChildrenGenealogy
     * @param  [var] $id [id of user]
     * @return [json]     [returns json data with children wrapper]
     */
    public function getChildrenGenealogy($id, $levellimit)
    {
        $user_id = urldecode(Crypt::decrypt($id));
        $tree = Tree_Table::getTree(true, $user_id, array(), 0, $levellimit);
        return $tree = Tree_Table::generateTree($tree);
    }
    
    /**
     * getParentGenealogy
     * @param  [var] $id [id of user]
     * @return [json]     [returns json data with children wrapper]
     */
    public function getParentGenealogy($id, $levellimit)
    {
        $user_id = Crypt::decrypt($id);
        if (Auth::user()->id != $user_id) {
            $user_id = Tree_Table::getFatherID($user_id);
        }
        $tree = Tree_Table::getTree(true, $user_id, array(), 0, $levellimit);
        return $tree = Tree_Table::generateTree($tree);
    }
    

    public static function autocomplete(Request $request)
    {
    
        $term = $request->get('term');
    // dd($term);
        $results = array();
    
        $queries = DB::table('users')
        ->where('username', 'LIKE', '%'.$term.'%')
        ->orWhere('name', 'LIKE', '%'.$term.'%')
        ->orWhere('lastname', 'LIKE', '%'.$term.'%')
        // ->select('id')
        ->take(5)->get();
    
        foreach ($queries as $query) {
            $results[] = [ 'id' => $query->id, 'value' => $query->username. ' : '.$query->name.' '.$query->lastname,'user_id' => Crypt::encrypt($query->id),'username' => $query->username ];
        }
        return Response::json($results);
    }    

    public static function userautocomplete(Request $request)
    {
    
        $term = $request->get('term');
        $users = Sponsortree::getDownlines(true, Auth::user()->id);
        $users = Sponsortree::$downlineIDArray;
        $results = array();
    
        $queries = DB::table('users')
        ->whereIn('id', $users)
        ->where('username', 'LIKE', '%'.$term.'%')
        ->orWhere('name', 'LIKE', '%'.$term.'%')
        ->orWhere('lastname', 'LIKE', '%'.$term.'%')
        ->take(5)->get();
        
        foreach ($queries as $query) {
            // if($query->id==1)
            $results[] = [ 'id' => $query->id, 'value' => $query->username. ' : '.$query->name.' '.$query->lastname,'user_id' => Crypt::encrypt($query->id),'username' => $query->username ];
        }
        return Response::json($results);
    }
     public static function userautocompleteinfluencer(Request $request)
    {  

     $term = $request->get('term');
     $users = InfluencerTree::getDownlines(true, Auth::user()->id);
     $users = InfluencerTree::$downlineIDArray;
     $results = array();
     $queries = User::where('influencer_type','yes')->take(5)
                      ->whereIn('id', $users)
                       ->where(function ($querys)use($term) {
                           $querys->where('username', 'LIKE', '%'.$term.'%')
                                  ->orWhere('name', 'LIKE', '%'.$term.'%')
                                  ->orWhere('lastname', 'LIKE', '%'.$term.'%');})
                                  ->get();    
        foreach ($queries as $query) {
            $results[] = [ 'id' => $query->id, 'value' => $query->username. ' : '.$query->name.' '.$query->lastname,'user_id' => Crypt::encrypt($query->id),'username' => $query->username ];
        }
        return Response::json($results);
    }
    public static function autocompletebinary(Request $request)
    {
    
        $term = $request->get('term');
        $results = array();
    
        Tree_Table::$downline_id_list = [];
        Tree_Table::getAllDownlinesAutocomplete([Auth::user()->id]);
        $downline_id_list = Tree_Table::$downline_id_list;

        $downline_user= array();
        foreach ($downline_id_list as $key => $value) {
                         $downline_user[]=$value;
        }
        $queries = DB::table('users')
        ->whereIn('id', $downline_user)
        ->where('username', 'LIKE', '%'.$term.'%')
        ->take(5)->get();
     // dd($queries);

    
        foreach ($queries as $query) {
            $results[] = [ 'id' => $query->id, 'value' => $query->username. ' : '.$query->name.' '.$query->lastname,'user_id' => Crypt::encrypt($query->id),'username' => $query->username ];
        }
        return Response::json($results);
    }
}
