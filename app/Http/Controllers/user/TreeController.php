<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Auth;
use Crypt;
use App\Tree_Table;
use App\Mail;
use App\User;
use App\Sponsortree;
use App\InfluencerTree;
use App\Http\Requests;
use App\Http\Requests\user\treeRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\user\UserAdminController;

class TreeController extends UserAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tree=Tree_Table::getTree(true, Auth::user()->id, array(), 0, 5);

        $tree=Tree_Table::generateTree($tree);

        $title =  trans('tree.binary_genealogy');
        $userss = User::getUserDetails(Auth::id());
        $user = $userss[0];
        $base = trans('tree.binary_genealogy');
        $method = trans('tree.binary_genealogy');
        $sub_title = trans('tree.binary_genealogy');

        return view('app.user.tree.index', compact('tree', 'title', 'user', 'method', 'base', 'sub_title'));
    }
    public function indexPost(treeRequest $request, $levellimit)
    {

        $user_id = $request->data;

        if ($request->data = 1) {
            $user_id =Auth::user()->id;
        }

        if ($request->data != 1) {
            $user_id =User:: where('username', $request->data)->value('id');
        }
        if ($user_id == null) {
            $user_id = Auth::user()->id;
        }
        $tree = Tree_Table::getTree(true, $user_id, array(), 0, $levellimit);
        return $tree = Tree_Table::generateTree($tree);


        $user_id=$request->data;
        $tree=Tree_Table::getTree(true, $user_id, array(), 0, 5);
        return $tree=Tree_Table::generateTree($tree);
    }

    public function treeUp(treeRequest $request, $levellimit)
    {
        $user_id = $request->data ;
        if (Auth::user()->id != $request->data) {
            $user_id =Tree_Table::getFatherID($request->data);
        }
        $tree=Tree_Table::getTree(true, $user_id, array(), 0, $levellimit);
        return $tree=Tree_Table::generateTree($tree);
    }

    public function sponsortree()
    {
        $tree=Sponsortree::getTree(true, Auth::user()->id);
       
        $tree=Sponsortree::generateTree($tree);
        $title =trans('tree.sponsor_tree');
        $userss = User::getUserDetails(Auth::id());
        $user = $userss[0];
        $base = trans('tree.sponsor_tree');
        $method = trans('tree.sponsor_tree');
        $sub_title = trans('tree.sponsor_tree');

        return view('app.user.tree.sponsortree', compact('tree', 'title', 'user', 'base', 'method', 'sub_title'));
    }

    public function postSponsortree(treeRequest $request)
    {

        $user_id=($request->data == 1)?Auth::user()->id:0;

        $tree=Sponsortree::getTree(true, $user_id);
       
        return $tree=Sponsortree::generateTree($tree);
    }
     public function postInfluencertree(treeRequest $request)
    {

        $user_id=($request->data == 1)?Auth::user()->id:0;

        $tree=InfluencerTree::getTree(true, $user_id);
       
        return $tree=InfluencerTree::generateTree($tree);
    }
    public function getsponsortreeurl(treeRequest $request)
    {


        $user_id = $request->data;

        $tree = Sponsortree::getTree(true, $user_id);

        return $tree = Sponsortree::generateTree($tree);
    }
   
    public function getsponsorchildrenByUserName(treeRequest $request, $username, $levellimit=4)
    {


        $user_id = User::where('username', $username)->value('id');


        if (Sponsortree::checkUserinTeam($user_id, [Auth::user()->id]) || $user_id == Auth::user()->id) {
            $tree = Sponsortree::getTree(true, $user_id);
        } else {
            $tree = Sponsortree::getTree(true, Auth::user()->id);
        }

        return $tree = Sponsortree::generateTree($tree);
    }

    public function getinfluencerchildrenByUserName(treeRequest $request, $username, $levellimit=4)
    {

        $user_id = User::where('username', $username)->value('id');

        if (InfluencerTree::checkUserinTeam($user_id, [Auth::user()->id]) || $user_id == Auth::user()->id) {
            $tree = InfluencerTree::getTree(true, $user_id);
        } else {
            $tree = InfluencerTree::getTree(true, Auth::user()->id);
        }

        // $tree = InfluencerTree::getTree(true, $user_id);

        return $tree = InfluencerTree::generateTree($tree);
    }
    public function sponsortreeUp(treeRequest $request, $base64)
    {
          $user_id = Crypt::decrypt($base64) ;
        if (Auth::user()->id != $user_id) {
            $user_id =Sponsortree::getSponsorID($user_id);
        }

        
        $tree=Sponsortree::getTree(true, $user_id);
       
        return $tree=Sponsortree::generateTree($tree);
    }
     public function influencertreeUp(treeRequest $request, $base64)
    {
          $user_id = Crypt::decrypt($base64) ;
        if (Auth::user()->id != $user_id) {
            $user_id =Sponsortree::getSponsorID($user_id);
        }

        
        $tree=InfluencerTree::getTree(true, $user_id);
       
        return $tree=InfluencerTree::generateTree($tree);
    }

    public function sponsortreechild(treeRequest $request, $base64)
    {
         $user_id = Crypt::decrypt($base64) ;
        // if(Auth::user()->id != $request->data)
        //     $user_id =Sponsortree::getSponsorID($request->data);

        
        $tree=Sponsortree::getTree(true, $user_id);
       
        return $tree=Sponsortree::generateTree($tree);
    }
    public function influencertreeChild(treeRequest $request, $base64)
    {
         $user_id = Crypt::decrypt($base64) ;
        // if(Auth::user()->id != $request->data)
        //     $user_id =Sponsortree::getSponsorID($request->data);

        
        $tree=InfluencerTree::getTree(true, $user_id);
       
        return $tree=InfluencerTree::generateTree($tree);
    }
    public function tree()
    {
        $title =trans('tree.tree');
        $sub_title = trans('tree.tree');
        $root = Crypt::encrypt('root');
        $userss = User::getUserDetails(Auth::id());
        $user = $userss[0];
        $base = trans('tree.tree');
        $method = trans('tree.tree');
        return view('app.user.tree.tree', compact('title', 'root', 'user', 'base', 'method', 'sub_title'));
    }
   
   public function influencertree()
    {
        $tree=InfluencerTree::getTree(true, Auth::user()->id);
       
        $tree=InfluencerTree::generateTree($tree);
        $title =trans('tree.influencer_tree');
        $userss = User::getUserDetails(Auth::id());
        $user = $userss[0];
        $base = trans('tree.influencer_tree');
        $method = trans('tree.influencer_tree');
        $sub_title = trans('tree.influencer_tree');

        return view('app.user.tree.influencertree', compact('tree', 'title', 'user', 'base', 'method', 'sub_title'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
    public function treedata(Request $request)
    {

       


        $decrypted = Crypt::decrypt($request->id);
        // dd($decrypted);
        $type= Auth::user()->user_type;
        if ($decrypted == "root") {
            if ($type=='Member') {
                        $icon="icon-user   fa-lg  text-danger";
                    }
                    elseif ($type =='Dealer') {
                        $icon="icon-user   fa-lg  text-info";
                    }
                    elseif ($type =='Share Partner') {
                       $icon="icon-user text-success  fa-lg  ";
                    }

                return '[{ 
                        "id": "'.Crypt::encrypt(Auth::user()->id).'", 
                        "text": "'.Auth::user()->username.' '.Auth::user()->name.' '.Auth::user()->lastname.'", 
                        "children": true, 
                        "type": "root",
                        "file": "treedata",
                        "icon":"'.$icon.'",                   
                        "state": {
                            "opened": true
                        }
                    }]';
        } 
       
        return json_encode(Sponsortree::getTreeJson($decrypted));
    }
    public function sponsortable(){
        $title     = trans('menu.genealogy');
        $sub_title = trans('menu.sponsor-table');
        $base      = trans('menu.genealogy');
        $method    = trans('menu.genealogy');

        
        $data= Sponsortree::where('sponsortree.sponsor', Auth::user()->id)
                ->where('sponsortree.type', '!=', 'vaccant')
                ->orderBy('sponsortree.position', 'ASC')
                ->leftJoin('users', 'sponsortree.user_id','users.id')
                ->leftjoin('profile_infos', 'profile_infos.user_id', '=', 'sponsortree.user_id')
                ->leftjoin('packages', 'packages.id','profile_infos.package')
                ->leftjoin('tree_table', 'tree_table.user_id','users.id')
                ->leftjoin('users as placement', 'placement.id','tree_table.placement_id')
                ->select('users.username', 'users.name','users.lastname','packages.package','packages.pv','users.leg','placement.username as placement_username')
                ->get();
        
        return view('app.user.tree.sponsortable', compact('data', 'title', 'sub_title', 'base', 'method'));
    }

}
