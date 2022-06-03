<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\LeadCapture;
use Illuminate\Http\Request;
use Redirect;
use Response;
use Session;
use DataTables;
use DB;

class LeadviewController extends AdminController
{
 
    public function leadview()
    {

        $title     = trans('ticket_config.lead');
        $sub_title = trans('ticket_config.lead');
        $base      = trans('ticket_config.lead');
        $method    = trans('ticket_config.lead');

        //$data = LeadCapture::paginate(10);
        $data = LeadCapture::join('users', 'users.username', '=', 'lead_capture.username')->select('lead_capture.*', 'users.username')->paginate(10);

        return view('app.admin.lead.leadview', compact('title', 'sub_title', 'base', 'method', 'data'));
    }
    public function updatelead(Request $request)
    {

        if ($request->status == 'pending') {
            $status = 0;
        } else {
            $status = 1;
        }
        $settings = LeadCapture::where('id', '=', $request->id)->update(['status'=>$status]);
        Session::flash('flash_notification', array('level' => 'success', 'message' => 'lead details updated successfully'));
        return redirect()->back();
    }

    public function getstatus()
    {

        $settings = LeadCapture::all();

        $response[0] = "pending";

        $response[1] = "complete";

        return json_encode($response, false);
    }

    public function deletelead(Request $request)
    {
        // dd($request->all());
        
        $requestid = $request->id;

        $res = LeadCapture::where('id', $requestid)->delete();
        Session::flash('flash_notification', array('level' => 'success', 'message' => 'lead details deleted successfully'));

        return Redirect::action('Admin\LeadviewController@leadview');
    }


    public function data(Request $request)
    {

         DB::statement(DB::raw('set @rownum=0'));
        $data = LeadCapture::join('users', 'users.username', '=', 'lead_capture.username')->select(DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'lead_capture.id', 'users.username', 'lead_capture.name', 'lead_capture.email', 'lead_capture.mobile', 'lead_capture.created_at', 'lead_capture.status')->get();


        return DataTables::of($data)
     

         ->addColumn('actions', '<div class="list-icons">
                      <div class="list-icons-item dropdown">
                      <a href="#" class="list-icons-item" data-toggle="dropdown"><i 
                      class="icon-menu7"></i></a>
                      <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end"
                      style="position: absolute; will-change: transform;top: 0px;left:
                      0px;transform: translate3d(-164px, 16px, 0px);">

                         <?php if($status ==0){ ?>
                        <a  data-id="{{$id}}" href="{{URL::to(\'admin/lead-update\')}}"  class="dropdown-item leadcomplete" > <i class="fa fa-trash "></i> {{trans("users.complete")}} </a>
                             <?php }else{ ?>
                        <a data-id="{{$id}}" href="{{URL::to(\'admin/lead-update\')}}"  class=" dropdown-item leadpending" > <i class="fa fa-check"></i>{{trans("users.pending")}} </a>
                              <?php } ?> 
                          
                             <div class="dropdown-divider"></div><br>
                   
                       <a data-id="{{$id}}" href="{{{ URL::to(\'admin/deletelead/\'.$id) }}}"  class="dropdown-item leaddelete" > <i class="fa fa-trash "></i> {{trans("users.delete")}}   </a>
                        
                      
                        </div>
                      </div>
                    </div>')

           ->editColumn('status', '@if($status==0) {{trans("users.incomplete")}}  @else {{trans("users.completed")}}  @endif')
           ->escapeColumns([])
           ->make();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
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
        //
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
}
