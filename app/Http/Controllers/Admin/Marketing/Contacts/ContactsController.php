<?php

namespace App\Http\Controllers\Admin\Marketing\Contacts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Admin\AdminController;

use App\User;
use Auth;
use Validator;
use Session;
use Datatables;
use Response;
use App\Models\Marketing\ContactList;
use App\Models\Marketing\Contact;
use App\LeadCapture;
use App\CampaignGroup;

class ContactsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title         = trans('contacts.contact');
        $sub_title     = trans("contacts.view_and_manage_contacts");
        $base          = trans('contacts.contact');
        $method        = trans("contacts.view_and_manage_contacts");
        $contact_lists = CampaignGroup::pluck('name', 'id');

        return view('app.admin.campaign.contact.index', compact('title', 'sub_title', 'base', 'method', 'contact_lists'));
    }
    public function store(Request $request)
    {
        $validator =Validator::make($request->all(), [
            'name'     => 'bail|required',
            'lastname' => 'bail|required',
            'email'    => 'required|email|unique:email_marketing_contacts,email',
            'mobile'   => 'sometimes|unique:email_marketing_contacts,mobile|digits:10',
            'address'  => 'bail|sometimes',
            'list_id'  => 'bail|exists:email_marketing_contact_lists,id',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            Contact::create([
                'email'    =>$request->email,
                'name'     =>$request->name,
                'lastname' =>$request->lastname,
                'address'  =>$request->address,
                'mobile'   =>$request->mobile,
                'list_id'  =>$request->list,
            ]);
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('contacts.contacts_created')));
            return redirect()->back()->withSuccess('Contacts added');
        }
    }

     

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $validator =Validator::make($request->all(), [
            'name'      => 'bail|required',
            'lastname'  => 'bail|required',
            'email'     => 'required|email|unique:email_marketing_contacts,email,' . $id,
            'mobile'    => 'required|unique:email_marketing_contacts,mobile,' . $id,
            'address'   => 'bail|sometimes',
            'list_id'   => 'bail|exists:email_marketing_contacts,id' . $request->id,
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            $lead=LeadCapture::where('email', $request->email)->where('id', $id)->first();
            if ($lead != null) {
                //dd('lead');
                $leads = LeadCapture::findOrFail($id);
                $leads->email       = $request->email;
                $leads->name        = $request->name;
                $leads->lastname    = $request->lastname;
                $leads->address     = $request->address;
                $leads->mobile      = $request->mobile;
                $leads->list_id     = $request->list_id;
                $leads->save();
            } else {
                 //dd('contact');
                $contact = Contact::findOrFail($id);
                $contact->email     = $request->email;
                $contact->name      = $request->name;
                $contact->lastname  = $request->lastname;
                $contact->address   = $request->address;
                $contact->mobile    = $request->mobile;
                $contact->list_id   = $request->list_id;
                $contact->save();
            }
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('contacts.contacts_created')));
            return redirect()->back()->withSuccess('Contacts added');
        }
    }
    public function edit($id)
    {
        // dd($id);
   
        $title          = trans('contact.contact');
        $sub_title      = trans("contact.edit_contact");
        $base           = trans('contact.contact');
        $method         = trans("contact.view_and_manage_contact");
       
          $contact_lists = CampaignGroup::pluck('name', 'id');
    
        $lead=LeadCapture::where('email', $id)->first();
        $contact=Contact::where('email', $id)->first();
        if ($lead == null) {
        // dd($contact);
            $contact_list_current_id = $contact->listid;
            if ($contact_list_current_id === null) {
                $contact_list_current_id = ContactList::find($id);
                return view('app.admin.campaign.contact.edit', compact('title', 'sub_title', 'base', 'method', 'id', 'contact', 'contact_lists', 'contact_list_current_id'));
            }
        } elseif ($contact==null) {
            $contact=LeadCapture::where('email', $id)->first();
            $contact_list_current_id = $contact->listid;
            if ($contact_list_current_id === null) {
                $contact_list_current_id = ContactList::first()->id;
                return view('app.admin.campaign.contact.edit', compact('title', 'sub_title', 'base', 'method', 'id', 'contact', 'contact_lists', 'contact_list_current_id'));
            }
        }
    }
    public function show($id)
    {

        $title        = trans('contact.contact');
        $sub_title    = trans("contact.view_and_manage_contact");
        $base         = trans('contact.contact');
        $method       = trans("contact.view_and_manage_contact");
        $contactgroup = CampaignGroup::findOrFail($id);
        return view('app.admin.campaign.contact.contactlist', compact('title', 'sub_title', 'base', 'method', 'id', 'contactgroup'));
    }


    public function destroy($id)
    {
        $lead    = LeadCapture::where('email', $id)->first();
        $contact = Contact::where('email', $id)->first();
        if ($lead !=null) {
            $boolean = LeadCapture::where('email', $id)->exists();
            if ($boolean === false) {
                return Response::json([
                'error' => true,
                'message' => 'Record not found!',
                'code' => 404
                ], 404);
            }
            $lead->delete();
            return Response::json([
            'error' => false,
            'message' => 'Contact successfully deleted',
            'code' => 200
            ], 200);
        } else {
            $boolean =  Contact::where('email', $id)->exists();
            if ($boolean === false) {
                return Response::json([
                    'error' => true,
                    'message' => 'Record not found!',
                    'code' => 404
                ], 404);
            }
            $contact = Contact::where('email', $id)->first();
            $contact->delete();
            return Response::json([
                'error' => false,
                'message' => 'Contact successfully deleted',
                'code' => 200
                ], 200);
        }
    }

    public function contactListIndex()
    {
        $title      = trans('contacts.contact_lists');
        $sub_title  = trans("contacts.view_and_manage_contact_lists");
        $base       = trans('contacts.contact_lists');
        $method     = trans("contacts.view_and_manage_contact_lists");
        
        return view('app.admin.campaign.contact.contactlists_index', compact('title', 'sub_title', 'base', 'method'));
    }




    public function createContactList(Request $request)
    {

         $validator =Validator::make($request->all(), [
            'name'        => 'bail|required',
            'description' => 'bail|required',
                      
          ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            CampaignGroup::create([
            'name'=>$request->name,
            'description'=>$request->description,
            ]);

            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('contacts.contacts_list_created')));
            return redirect()->back()->withSuccess('New list created!');
        }
    }


    public function editContactList($id)
    {
        $title       = trans('contact.contact_list');
        $sub_title   = trans("contact.edit_contact_list");
        $base        = trans('contact.contact_list');
        $method      = trans("contact.edit_contact_list");
        $contactlist = CampaignGroup::findOrFail($id);

        return view('app.admin.campaign.contact.contactlists_edit', compact('title', 'sub_title', 'base', 'method', 'contactlist'));
    }


    public function destroyContactList($id)
    {
        if ($id == 1) {
            Session::flash('flash_notification', array('level' => 'error', 'message' => trans('contacts.sorry_you cannot_delete_this_contact')));
            return redirect('admin/campaign/contactlist');
        }

        $contacts = CampaignGroup::findOrFail($id);
        $contacts->delete();

        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('contacts.contacts_deleted')));
        return redirect('admin/campaign/contactlist');
    }
    public function saveContactList(Request $request, $id)
    {
         $validator =Validator::make($request->all(), [
            'name' => 'bail|required',
            'description' => 'bail|required',
                      
         ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
               $contacts       = CampaignGroup::findOrFail($id);
               $contacts->name = $request->name;
               $contacts->description = $request->description;
               $contacts->save();

               Session::flash('flash_notification', array('level' => 'success', 'message' => trans('contacts.contacts_updated')));
               return redirect('admin/campaign/contactlist');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ShowContactList($id)
    {
        $title         = trans('contacts.contact_list');
        $sub_title     = trans("contacts.view_contact_list");
        $base          = trans('contacts.contact');
        $method        = trans("contacts.view_and_manage_contact_list");
         $contact_lists = CampaignGroup::pluck('name', 'id');
        $contact       =CampaignGroup::findOrFail($id);
        
        return view('app.admin.campaign.contact.contactlists_show', compact('title', 'sub_title', 'base', 'method', 'contact_lists', 'contact'));
    }

    public function singleListContactData(Request $request)
    {
        // dd($request->all());
        $listid     = null;
        $categories = Contact::where('list_id', $request->listid)->select('id', 'name', 'lastname', 'email', 'address', 'mobile');
        $lead       =LeadCapture::where('list_id', $request->listid)->select('id', 'name', 'lastname', 'email', 'address', 'mobile');
        $contacts   = $categories->union($lead)->get();
        return Datatables::of($contacts)
            ->removeColumn('id')
            ->editColumn('firstname', function ($model) {
                return $model->name;
            })
            ->editColumn('lastname', function ($model) {
                return $model->lastname;
            })
            ->editColumn('email', function ($model) {
                return $model->email;
            })
            ->editColumn('address', function ($model) {
                return $model->address;
            })
            ->editColumn('mobile', function ($model) {
                return $model->mobile;
            })
            ->addColumn('action', function ($model) {
                return ' &nbsp; <a href="'.url('admin/campaign/contacts/'.$model->email."/edit/").'" class="btn btn-success" data-id="'.$model->email.'"> Edit </a>
                    &nbsp;
                <button class="btn btn-warning btn-delete-contactgroup" data-id="'.$model->email.'"> delete </button>';
            })
            ->escapeColumns([])
            ->make();
    }
    public function data(Request $request)
    {

        $category  = new Contact();
        $categories = Contact::select('id', 'name', 'lastname', 'email', 'address', 'mobile');
        $lead=LeadCapture::select('id', 'name', 'lastname', 'email', 'address', 'mobile');
        $contacts= $categories->union($lead)->get();
        return Datatables::of($categories)
            ->removeColumn('id')
            ->editColumn('firstname', function ($model) {
                return $model->name;
            })
            ->editColumn('lastname', function ($model) {
                return $model->lastname;
            })
            ->editColumn('email', function ($model) {
                return $model->email;
            })
            ->editColumn('address', function ($model) {
                return $model->address;
            })
            ->editColumn('mobile', function ($model) {
                return $model->mobile;
            })
            ->addColumn('action', function ($model) {
                  
                return ' &nbsp; <a href="'.url('admin/campaign/contacts/'.$model->email."/edit/").'" class="btn btn-success" data-id="'.$model->email.'"> Edit </a>
                                    &nbsp;
                <button class="btn btn-warning btn-info btn-xs btn-delete-contact" data-id="'.$model->email.'"> delete </button>';
            })

                ->escapeColumns([])
                ->make();
    }


    public function ContactListData(Request $request)
    {
        try {
            $category  = new CampaignGroup();
            $categories = $category->select('id', 'name', 'description')->get();
            // dd($category);
            return Datatables::of($categories)
                ->removeColumn('id')
                ->editColumn('name', function ($model) {
                    return $model->name;
                })->editColumn('description', function ($model) {
                    return $model->description;
                })
                ->addColumn('action', function ($model) {
                     return ' <a href="'.url('admin/campaign/contactlist/'.$model->id).'/show" class="btn btn-success btn-info btn-xs btn-view-category" data-id="'.$model->id.'"> View  </a> &nbsp; <a href="'.url('admin/campaign/contactlist/'.$model->id."/edit/").'" class="btn btn-success btn-info btn-xs btn-edit-category" data-id="'.$model->id.'"> Edit </a>
                                    &nbsp;
                    <button class="btn btn-warning btn-info btn-xs btn-delete-contactlist" data-id="'.$model->id.'"> Delete </button>';
                })
                ->escapeColumns([])
                ->make();
        } catch (Exception $ex) {
            return redirect()->back()->with('fails', $ex->getMessage());
        }
    }
}
