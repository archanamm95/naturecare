<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\treeRequest;
use App\Mail;
use App\Sponsortree;
use App\InfluencerTree;
use App\Tree_Table;
use App\User;
use Auth;
use Crypt;
use Illuminate\Http\Request;

class TreeController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {

        $title     = trans('tree.binary_genealogy');
        $sub_title = trans('tree.binary_genealogy');
        $base      = trans('tree.binary_genealogy');
        $method    = trans('tree.binary_genealogy');

        $tree         = Tree_Table::getTree(false, Auth::user()->id);
        $tree         = Tree_Table::generateTree($tree);
        $unread_count = Mail::unreadMailCount(Auth::id());
        $unread_mail  = Mail::unreadMail(Auth::id());
        $users        = User::getUserDetails(Auth::id());
        $user         = $users[0];

        return view('app.admin.tree.index', compact('tree', 'title', 'unread_count', 'unread_mail', 'user', 'sub_title', 'base', 'method'));
    }

    public function getTree(treeRequest $request)
    {

        $user_id = $request->data;

        $tree = Tree_Table::getTree(true, $user_id);

        return $tree = Tree_Table::generateTree($tree);
    }


    public function treeUp(treeRequest $request)
    {
        $user_id = $request->data;
        if (Auth::user()->id != $request->data) {
            $user_id = Tree_Table::getFatherID($request->data);
        }

        $tree = Tree_Table::getTree(true, $user_id);

        return $tree = Tree_Table::generateTree($tree);
    }



    /**
     * Sponsor tree
     */

    public function sponsortree()
    {

        $tree = Sponsortree::getTree(true, Auth::user()->id);


        $tree = Sponsortree::generateTree($tree);
        $title     = trans('tree.sponsor_tree');
        $sub_title = trans('tree.your_sponsor_genealogy');

        $method = trans('tree.sponsor_tree');
        $base   = trans('tree.title');
         

        $type = ['Member','Dealer','Share Partner'];
 
 
        $count = [];
        foreach ($type as $key => $value) {

            $count[$value] = User::where('user_type','LIKE',$value.'%')
                             ->groupBy('user_type')
                             ->count('id');

        }

// dd($count);
        return view('app.admin.tree.sponsortree', compact('tree', 'title', 'sub_title', 'base', 'method','count'));
    }
    public function postSponsortree(treeRequest $request)
    {

         $user_id = $request->data;

        if ($request->data != 1) {
            $user_id =User:: where('username', $request->data)->value('id');
        }
        if ($user_id == null) {
            $user_id = Auth::user()->id;
        }

        $tree = Sponsortree::getTree(true, $user_id);

        return $tree = Sponsortree::generateTree($tree);
    }
      public function postinfluencertree(treeRequest $request)
    {

         $user_id = $request->data;
        // dd($user_id);

        if ($request->data != 1) {
            $user_id =User:: where('username', $request->data)->value('id');
        }
        if ($user_id == null) {
            $user_id = Auth::user()->id;
        }

        $tree = InfluencerTree::getTree(true, $user_id);
            
        return $tree = InfluencerTree::generateTree($tree);
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

        $tree = Sponsortree::getTree(true, $user_id);

        return $tree = Sponsortree::generateTree($tree);
    }

    public function sponsortreeUp($id)
    {


        $user_id = Crypt::decrypt($id);
        if (Auth::user()->id != $user_id) {
            $user_id = Sponsortree::getSponsorID($user_id);
        }
        $tree = Sponsortree::getTree(true, $user_id);
        return $tree = Sponsortree::generateTree($tree);
    }

    public function sponsortreeChild($id)
    {
           

         $user_id = urldecode(Crypt::decrypt($id));
        $tree = Sponsortree::getTree(true, $user_id);
        return $tree = Sponsortree::generateTree($tree);
    }

    public function tree()
    {
        $title        = trans('tree.your_tree_genealogy');
        $root         = Crypt::encrypt('root');
        $sub_title    = trans('tree.your_tree_genealogy');
        $unread_count = Mail::unreadMailCount(Auth::id());
        $unread_mail  = Mail::unreadMail(Auth::id());
        $users        = User::getUserDetails(Auth::id());
        $base         = trans('tree.your_tree_genealogy');
        $method       = trans('tree.binary_genealogy');
        $user         = $users[0];

        return view('app.admin.tree.tree', compact('title', 'root', 'unread_count', 'unread_mail', 'user', 'sub_title', 'base', 'method'));
    }

    public function treedata(Request $request)
    {
        $icon="icon-user text-muted  fa-lg";
        $decrypted = Crypt::decrypt($request->id);
        // dd($decrypted);
        if ($decrypted == "root") {
            return '[{
                        "id": "' . Crypt::encrypt(Auth::user()->id) . '",
                        "text": "' . Auth::user()->username . ' ' . Auth::user()->name . ' ' . Auth::user()->lastname . '",
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


    /**
     * [getChildrenGenealogy]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getChildrenGenealogy($id)
    {
         return json_encode(Sponsortree::getTreeJson($id));
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
        
        return view('app.admin.tree.sponsortable', compact('data', 'title', 'sub_title', 'base', 'method'));
    }
    public function influencertree()
    {
        // dd(1);
        $tree = Influencertree::getTree(true, Auth::user()->id);


        $tree = InfluencerTree::generateTree($tree);
        $title     = trans('tree.influencer_tree');
        $sub_title = trans('tree.your_influencer_genealogy');

        $method = trans('tree.influencer_tree');
        $base   = trans('tree.title');


        return view('app.admin.tree.influencertree', compact('tree', 'title', 'sub_title', 'base', 'method'));
    }
    public function getinfluencerchildrenByUserName(treeRequest $request, $username, $levellimit=4)
    {
        $user_id = User::where('username', $username)->value('id');

        $tree = InfluencerTree::getTree(true, $user_id);

        return $tree = InfluencerTree::generateTree($tree);
    }
    
     public function influencertreeChild($id)
    {

         $user_id = urldecode(Crypt::decrypt($id));
        $tree = InfluencerTree::getTree(true, $user_id);
        return $tree = InfluencerTree::generateTree($tree);
    }

    public function influencertreeUp($id)
    {


        $user_id = Crypt::decrypt($id);
        if (Auth::user()->id != $user_id) {
            $user_id = InfluencerTree::getSponsorID($user_id);
        }
        $tree = InfluencerTree::getTree(true, $user_id);
        return $tree = InfluencerTree::generateTree($tree);
    }
    
}
