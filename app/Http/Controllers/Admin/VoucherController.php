<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Admin\AdminController;
use App\User;
use App\Voucher;
use App\Settings;
use Auth;
use Illuminate\Http\Request;
use Redirect;
use Session;
use Validator;

class VoucherController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       

        $title     = trans('voucher.view_voucher');
        $sub_title = trans('voucher.all_voucher_request');
        $base      = trans('voucher.voucher');
        $method    =trans('voucher.view_vouchers');

        //$unread_count  = Mail::unreadMailCount(Auth::id());
        //$unread_mail  = Mail::unreadMail(Auth::id());
        $users          = User::getUserDetails(Auth::id());
        $user           = $users[0];
        $vouchers       = Voucher::select('vouchers.*', 'users.username')->join('users', 'users.id', '=', 'vouchers.user_id')->get();

        // dd($vouchers);
        $vouchers_count = count($vouchers);
        return view('app.admin.voucher.index', compact('title', 'vouchers', 'user', 'vouchers_count', 'sub_title', 'base', 'method'));
    }

    public function voucherlist()
    {

        $title     = trans('voucher.create_voucher');
        $sub_title = trans('voucher.text_your_message');
        $base      = trans('voucher.email');
        $method    = trans('voucher.voucher');
 
        $vhr   = Voucher::orderBy('created_at', 'desc')
                            ->paginate(10);

       // phpinfo();
        return view('app.admin.voucher.voucher_list', compact('title', 'sub_title', 'base', 'method', 'user', 'base', 'method', 'vhr'));
    }

    public function create(Request $request)
    {
       
         $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'count'   => 'required|numeric|min:1',
            
         ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $voucher_daily_limit=Settings::find(1)->voucher_daily_limit;
            $daily_voucher=Voucher::where('created_at', '>', date('Y-m-d 00:00:00'))->where('created_at', '<', date('Y-m-d 23:59:59'))->count();
            $total_today_voucher=$daily_voucher+$request->count;
            if ($total_today_voucher > $voucher_daily_limit) {
                  return redirect()->back()->withErrors(trans('voucher.your_daily_limit_is_exceeded_please_try_tomorrow'));
            }


            $count = $request->count;
        
            while ($count) {
                $voucher = self::RandomString();
                $res     = Voucher::create([

                'voucher_code'   => $voucher,
                'total_amount'   => $request->amount,
                'balance_amount' => $request->amount,

                ]);
                $count--;
            }
            if ($res) {
                Session::flash('flash_notification', array('level' => 'success', 'message' => trans('voucher.voucher_created')));
                // $vocherrquest->status="complete";
                // $vocherrquest->save();
            } else {
                Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('voucher.details_updated')));
            }

            return redirect()->back();
        }
    }

    public function RandomString()
    {
        $characters       = "23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
        $charactersLength = strlen($characters);
        $randstring       = '';
        for ($i = 0; $i < 11; $i++) {
            $randstring .= $characters[rand(0, $charactersLength - 1)];
        }
        $count = Voucher::where('voucher_code', $randstring)->count();
        if ($count > 0) {
            return self::RandomString();
        }

        return $randstring;
    }

    public function editvoucher(Request $request, $id)
    {
        $response = Voucher::where('id', $id)->get();

        $title     = trans('voucher.voucher');
        $sub_title = trans('voucher.text_your_message');
        //$unread_count  = Mail::unreadMailCount(Auth::id());
        //$unread_mail  = Mail::unreadMail(Auth::id());
        $base   = trans('voucher.voucher');
        $method = trans('voucher.voucher');
        $count  = $request->count;
        //dd($count);
        $users = User::getUserDetails(Auth::id());
        $user  = $users[0];

        return view('app.admin.Voucher.voucheredit', compact('title', 'user', 'base', 'method', 'response'));
    }

    public function updatevoucher(Request $request)
    {
        $requestid = $request->requestid;
        // $requestid=$request->id;
        //dd($requestid);

        Voucher::where('id', $requestid)->update(array('total_amount' => $request->amount,'balance_amount' =>$request->amount ));
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('voucher.voucher_updated')));
        return redirect()->back();
    }

    // public function deletevoucher($id)
    // {

    //     $title = 'Voucher';
    //     // $sub_title = "Text your message";
    //     $base     = 'Voucher';
    //     $method   = 'Voucher';
    //     $users    = User::getUserDetails(Auth::id());
    //     $user     = $users[0];
    //     $response = Voucher::where('id', $id)->get();

    //     return view('app.admin.Voucher.Voucherdelete', compact('title', 'user', 'base', 'method', 'response'));
    // }

    public function deleteconfirm(Request $request)
    {

        $requestid = $request->requestid;

        $res = Voucher::where('id', $requestid)->delete();
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('voucher.voucher_deleted')));
        return Redirect::action('Admin\VoucherController@voucherlist');
    }

    public function delete_allvoucher(Request $request)
    {
        //dd($request->all());
         $ids = $request->ids;
        Voucher::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['status'=>true,'message'=>"Selected Voucher deleted successfully."]);
    }
}
