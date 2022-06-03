<?php
namespace App\Http\Controllers\Admin\Marketing\Campaign;

use App\AutoResponse;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\User;
use App\CampaignGroup;
use Auth;
use Validator;
use Session;
use App\Models\Marketing\EmailCampaign;
use App\LeadCapture;
use App\Models\Marketing\Contact;

class CampaignController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title     = trans('campaign.campaigns');
        $sub_title = trans("campaign.view_and_manage_campaigns");
        $base   = trans('campaign.campaigns');
        $method = trans("campaign.view_and_manage_campaigns");
        $emailcampaignlist = EmailCampaign::all();
        // dd($emailcampaignlist);

        return view('app.admin.campaign.campaign.campaigns', compact('title', 'sub_title', 'base', 'method', 'emailcampaignlist'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $title     = trans('campaign.create_campaign');
        $sub_title = trans("campaign.create_campaign");
        $base   = trans('campaign.create_campaign');
        $method = trans("campaign.create_campaign");
        $group = CampaignGroup::all();
        
      
        return view('app.admin.campaign.campaign.create_campaign', compact('title', 'sub_title', 'base', 'method', 'group'));
    }


    public function store(Request $request)
    {
  // dd($request->all());
 
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required',
            'customer_group' => 'bail|required',
            'first_name' => 'bail|required',
            'last_name' => 'bail|required',
            'from_email' => 'bail|required|email',
            'subject' => 'bail|required',
            'datetime' => 'bail|required',
            'campaignemail' => 'bail|required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            EmailCampaign::create([
                'name' => $request->name,
                'customer_group' => $request->customer_group,
                'first_name' => $request->first_name ,
                'last_name' => $request->last_name,
                'from_email' => $request->from_email,
                'subject' => $request->subject,
                'datetime' => date('Y-m-d', strtotime($request->datetime)),
                'campaignemail' => trim($request->campaignemail)
            ]);

             Session::flash('flash_notification', array('level' => 'success', 'message' => trans('campaign.campaign_created')));

              return redirect('admin/campaign/lists');
        }
    }



    public function edit(Request $request, $id)
    {
      // dd($request->all());

        $emailcampaign = EmailCampaign::findOrFail($id);
        
        $group = CampaignGroup::all();
        $use_group=CampaignGroup::find($emailcampaign->customer_group)->name;

        $title     = trans('campaign.edit_campaign');
        $sub_title = trans("campaign.edit_campaign");
        $base   = trans('campaign.edit_campaign');
        $method = trans("campaign.edit_campaign");
        return view('app.admin.campaign.campaign.edit_campaign', compact('title', 'sub_title', 'base', 'method', 'emailcampaign', 'group', 'use_group'));
    }
    public function view(Request $request, $id)
    {

        $emailcampaign = EmailCampaign::findOrFail($id);

        $group = CampaignGroup::all();
        $title     = trans('campaign.view_campaign');
        $sub_title = trans("campaign.view_campaign");
        $base   = trans('campaign.view_campaign');
        $method = trans("campaign.view_campaign");
        return view('app.admin.campaign.campaign.view_campaign', compact('title', 'sub_title', 'base', 'method', 'emailcampaign', 'group'));
    }

    public function save(Request $request, $id)
    {


 
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required',
            'customer_group' => 'bail|required',
            'first_name' => 'bail|required',
            'last_name' => 'bail|required',
            'from_email' => 'bail|required|email',
            'subject' => 'bail|required',
            'datetime' => 'bail|required',
            'campaignemail' => 'bail|required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            $item = EmailCampaign::findOrFail($id);
            $item->name = $request->name;
            $item->customer_group = $request->customer_group;
            $item->first_name = $request->first_name ;
            $item->last_name = $request->last_name;
            $item->from_email = $request->from_email;
            $item->subject = $request->subject;
            $item->datetime = date('Y-m-d', strtotime($request->datetime));
            $item->campaignemail = $request->campaignemail ;
            $item->save();

            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('campaign.campaign_updated')));
            return redirect('admin/campaign/lists');
        }
    }
    public function editcampaign(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'bail|required',
            'customer_group' => 'bail|required',
            'first_name' => 'bail|required',
            'last_name' => 'bail|required',
            'from_email' => 'bail|required|email',
            'subject' => 'bail|required',
            'datetime' => 'bail|required',
            'campaignemail' => 'bail|required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            EmailCampaign::where('id', $request->id)->update([
                'name' => $request->name,
                'customer_group' => $request->customer_group,
                'first_name' => $request->first_name ,
                'last_name' => $request->last_name,
                'from_email' => $request->from_email,
                'subject' => $request->subject,
                'datetime' => date('Y-m-d', strtotime($request->datetime)),
                'campaignemail' => trim($request->campaignemail)
            ]);

             Session::flash('flash_notification', array('level' => 'success', 'message' => trans('campaign.campaign_updated')));

              return redirect('admin/campaign/lists');
        }
    }

    public function changestatus(Request $request)
    {
       // dd($request->all());

        $item = EmailCampaign::find($request->id);
        $item->status = $request->status;
        $item->save();
    }
    public function delete($id)
    {

        $item = EmailCampaign::find($id);
        $item->delete();
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('campaign.campaign_deleted_successfully')));

                  return redirect('admin/campaign/lists');
    }


  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autorespondersIndex()
    {
        $autoresponse =AutoResponse::all();
        $title     = trans('campaign.auto_responders');
        $sub_title = trans("campaign.view_and_manage_autoresponders");
        $base   = trans('campaign.auto_responders');
        $method = trans("campaign.view_and_manage_autoresponders");
        return view('app.admin.campaign.autoresponder.autoresponders', compact('title', 'sub_title', 'base', 'method', 'autoresponse'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAutoResponder()
    {
        $title     = trans('autoresponder.autoresponder');
        $sub_title = trans("autoresponder.view_and_manage_autoresponder");
        $base   = trans('autoresponder.autoresponder');
        $method = trans("autoresponder.view_and_manage_autoresponder");
        $autoresponse= AutoResponse::all();
        $campaign=EmailCampaign::all();
       
        return view('app.admin.campaign.autoresponder.create_autoresponders', compact('title', 'sub_title', 'base', 'method', 'autoresponse', 'campaign'));
    }

    public function create_autoresp(Request $request)
    {

         $validator = Validator::make($request->all(), [
                'subject'            => 'required',
                'autoresponderemail' => 'required',
                'date'               => 'required',
                'campaign'           => 'required',
            ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            AutoResponse::create([
                    'subject' => $request->subject,
                    'content' => trim($request->autoresponderemail),
                    'date' => $request->date ,
                    'campaign' =>$request->campaign,
                        
                        
            ]);

                 Session::flash('flash_notification', array('level' => 'success', 'message' => trans('campaign.autoresponse_created')));

                  return redirect()->back();
        }
    }
    public function edit_autoresponder($id)
    {
        $autoresponse = AutoResponse::findOrFail($id);
       // dd($autoresponse);
     
        $title     = trans('campaign.edit_autoresponder');
        $sub_title = trans("campaign.edit_autoresponder");
        $base   = trans('campaign.edit_autoresponder');
        $method = trans("campaign.edit_autoresponder");
        return view('app.admin.campaign.autoresponder.edit_autoresponders', compact('title', 'sub_title', 'base', 'method', 'autoresponse'));
    }
    public function editautoresponder(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'subject' => 'required',
           'summernoteInput' => 'required',
           'date' =>'required',
                     
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            AutoResponse::where('id', $request->id)->update([
                    'subject' => $request->subject,
                    'content' => $request->summernoteInput,
                    'date' => $request->date,
                    
            ]);

                 Session::flash('flash_notification', array('level' => 'success', 'message' => trans('campaign.autoresponse_updated')));

                  return redirect('admin/campaign/autoresponders');
        }
    }
    public function delete_autorespnse($id)
    {
      // dd($id);
        $autoresponse = AutoResponse::find($id);

        $autoresponse->delete();

        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('campaign.autoresponse_deleted_successfully')));

        return redirect()->back();
    }



    public function campaign_manager()
    {
        $title     = trans('campaign_manager.campaign_manager');
        $sub_title = trans("campaign_manager.campaign_manager");
        $base   = trans('campaign_manager.campaign_manager');
        $method = trans("campaign_manager.campaign_manager");
        $group = CampaignGroup::all();
        return view('app.admin.control_panel.campaign-manager.index', compact('title', 'sub_title', 'base', 'method', 'group'));
    }



    public function delete_group($id)
    {
      // dd($id);
        $group = CampaignGroup::find($id);

        $group->delete();

        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('campaign.group_deleted_successfully')));

        return redirect()->back();
    }
    public function edit_group($id)
    {
      
        $group = CampaignGroup::findOrFail($id);
     
        $title     = trans('campaign.edit_group');
        $sub_title = trans("campaign.edit_group");
        $base   = trans('campaign.edit_group');
        $method = trans("campaign.edit_group");
        return view('app.admin.control_panel.campaign-manager.edit_group', compact('title', 'sub_title', 'base', 'method', 'group'));
    }
    public function editgroup(Request $request)
    {
       // dd($request->all());
      
       
        $validator = Validator::make($request->all(), [
            'group_name' => 'required',
            'group_description' => 'required',
                     
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            $old_name='default';
            CampaignGroup::where('id', $request->id)->update([
                    'name' => $request->group_name,
                    'description' => $request->group_description,
                    
            ]);

          

                 Session::flash('flash_notification', array('level' => 'success', 'message' => trans('campaign.group_updated')));

                  return redirect('admin/control-panel/campaign-manager');
        }
    }

    public function campaigngroup_create(Request $request)
    {
// dd($request->all());
        $validator = Validator::make($request->all(), [
            'group_name'          => 'required',
            'group_description'          => 'required',
           
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            CampaignGroup::create([
                'name'          => $request->group_name,
                'description'   => $request->group_description,
                
            ]);
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('campaign.group_created_successfully')));
            return redirect()->back();
        }
    }
}
