<?php

namespace App\Http\Controllers\user;

use DB;
use Auth;
use Redirect;
use Session;
use App\Mail;
use App\User;
use App\AppSettings;
use App\MailSubject;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\user\UserAdminController;
use Response;
use Crypt;

class MailController extends UserAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title = trans('mail.inbox_mails');
        $sub_title =  trans('mail.inbox_mails');
        $base = trans('mail.inbox_mails');
        $method = trans('mail.inbox_mails');

        $all_mail = Mail::getMyMail(Auth::id());
        $limit_mail = count($all_mail);
        $unread_count = Mail::unreadMailCount(Auth::id());
        $unread_mail  = Mail::unreadMail(Auth::id());
        $users = User::getUserDetails(Auth::id());
        $user = $users[0];
        Mail::chageMailStatus(1);
        $app      = AppSettings::find(1);
        $logo_ico = $app->logo_ico;
        $logo     = $app->logo;
        $all_out_mail     = Mail::getOutBoxMail(Auth::id());
        //dd($all_out_mail);
        $limit_out_mail   = count($all_out_mail);
         $from=1;
        // echo $all_out_mail[0]['message'] ;
        // die();
        $limit_out_mail   = count($all_out_mail);
        // dd($limit_out_mail);
        $all_count=Mail::where('from_id', Auth::id())->count();
        $div_mail=$all_count/10;
        $page_num_out=ceil($div_mail); 
        return view('app.user.mail.inbox', compact('title', 'all_mail', 'all_out_mail', 'limit_mail', 'limit_out_mail', 'unread_count', 'unread_mail', 'user', 'logo', 'logo_ico', 'sub_title', 'base', 'method', 'from', 'page_num_out'));
    }

    public function compose()
    {
        $title =  trans('mail.compose');
        $sub_title =  trans('mail.compose');
        $base =  trans('mail.email');
        $method =  trans('mail.compose');
        $all_out_mail     = Mail::getOutBoxMail(Auth::id());
        $limit_out_mail   = count($all_out_mail);
        $all_mail     = Mail::getMyMail(Auth::id());
        
        $limit_mail   = count($all_mail);
        return view('app.user.mail.composenew', compact('title', 'user', 'base', 'method', 'sub_title', 'all_out_mail', 'limit_out_mail', 'all_mail', 'limit_mail'));
    }

    public function fetch_data(Request $request)
    {
        // dd($request->all());

        $all_out_mail     = Mail::getOutBoxMail(Auth::id());
       // $limit_out_mail   = count($all_out_mail);
        $pg=$request->page-1;
        $p=$pg.'0';
       

        $id=Auth::id();

        $allMessages =  Mail::select('profile_infos.image', 'users.username', 'mail_table.*')
          ->join('users', 'users.id', '=', 'mail_table.to_id')
          ->join('profile_infos', 'profile_infos.user_id', '=', 'mail_table.to_id')
          ->whereNull('mail_table.deleted_at')->where('mail_table.from_id', [$id])->orderBy('mail_table.created_at', 'desc')->skip($p)->take(10)->get();
        $message_count = count($allMessages);
        for ($i = 0; $i < $message_count; $i++) {
            $allMessages[$i]->from_id = User::userIdToName($allMessages[$i]->from_id);
            $allMessages[$i]->full_message = substr($allMessages[$i]->message, 0, 30);
            $allMessages[$i]->encryt_id=Crypt::encrypt($allMessages[$i]->id);
            $allMessages[$i]->rep_subject = preg_replace('/(\>)\s*(\<)/m', '$1$2', $allMessages[$i]->message_subject);
            $allMessages[$i]->repmessage = preg_replace('/(\>)\s*(\<)/m', '$1$2', $allMessages[$i]->message);
            $allMessages[$i]->editcreate =  Date('h:i A', strtotime($allMessages[$i]->created_at));
            $allMessages[$i]->litsub=str_limit(strip_tags($allMessages[$i]->message_subject), $limit = 40, $end = '...');
             $allMessages[$i]->litmsg=str_limit(strip_tags($allMessages[$i]->message), $limit = 40, $end = '...');
        }
     
     

   
        return response()->json(['data' => $allMessages,'count' => $message_count]);
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
    public function save(Request $request)
    {
            $data = array();
        $all_users_comma  = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $request->to);
        $subject    = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $request->subject);
        $message    = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $request->message);


        $all_users = explode(',', $all_users_comma);
        $user_count = count($all_users);


        if($message=="" || $subject==""){
              return Response::json([
                'error' => true,
                'message' => 'Something went wrong, Please check recipients',
                'code' => 400
                 ], 400);
        }

        for ($i = 0; $i < $user_count; $i++) {
            if($all_users[$i] == 'Customer Support')
                $to_id = 1;
            else  
                $to_id = User::userNameToId($all_users[$i]);
            if (!$to_id) {
                 return Response::json([
                'error' => true,
                'message' => 'Something went wrong, Please check recipients',
                'code' => 400
                 ], 400);
            }
            $mailsubject =  MailSubject::create([
                                'message'         => $message,
                                'message_subject' => $subject,
                            ]);
            Mail::create([
                'from_id'         => Auth::id(),
                'to_id'           => $to_id,
                'message'         => $mailsubject->id,
            ]);
        }

         return Response::json([
                'error' => false,
                'code'  => 200,
             ], 200);
    }
    public function mark_as_read(Request $request)
    {
        Mail::chageMailStatus(Crypt::decrypt($request->msg_id));
    }

    public function destroy(Request $request)
    {
      

        $email_ids = $request->mailids;
        if (!is_array($email_ids)) {
            $all_email_ids = explode(',', $email_ids);
        } else {
            $all_email_ids = $email_ids;
        }
        $mail_count = count($all_email_ids);
        for ($i = 0; $i < $mail_count; $i++) {
            $message = Mail::find(Crypt::decrypt($all_email_ids[$i]));
            $message->delete();
        }
        if ($message) {
            return Response::json([
                    'error' => false,
                    'message' => 'Mail deleted!',
                    'code'  => 200,
            ], 200);
        } else {
            return Response::json([
            'error' => true,
            'message' => 'Something went wrong, Please contact admin',
            'code' => 400
                ], 400);
        }
    }
    public function reply($from)
    {

        $from_user=$from;
        $title = trans('mail.compose');
        $sub_title = trans('mail.text_your_message');
        $base =  trans('mail.email');
        $method = trans('mail.compose');
        $users = User::getUserDetails(Auth::id());
        $user = $users[0];
        $app = AppSettings::find(1);
        $logo_ico = $app->logo_ico;
        $logo = $app->logo;
        return view('app.user.mail.composenew', compact('title', 'user', 'logo', 'logo_ico', 'sub_title', 'base', 'method', 'from_user'));
    }
    public function save1(Request $request)
    {
        
        $data = array();
        $data['username'] = (explode(",", $request->tags));
        $count=count($data['username']);
        $subject = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $request->subject);
        $message = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $request->message);
      //$user_count = count($all_users);
//dd($all_users);
        for ($i = 0; $i < $count; $i++) {
            $to_id =  User::userNameToId($data['username'][$i]);
  //dd($to_id);
            Mail::create([
            'from_id' => Auth::id(),
            'to_id' => $to_id,
            'message' => $message,
            'message_subject' => $subject
            ]);
        }
        Session::flash('flash_notification', array('level'=>'success','message'=>trans('mail.msg_send')));
        return Redirect::action('user\MailController@compose');
    }
}
