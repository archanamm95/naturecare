<?php

namespace App\Http\Controllers\admin;

use App\Balance;
use App\Http\Controllers\Admin\AdminController;
use App\User;
use App\Voucher;
use App\VoucherRequest;
use Auth;
use DB;
use Illuminate\Http\Request;
use Redirect;
use Session;

class VoucherrequestController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $title     = trans('ticket_config.view_voucher_requests');
        $sub_title = trans('ticket_config.view_voucher_requests');
        $base      = trans('ticket_config.view_voucher_requests');
        $method    = trans('ticket_config.view_voucher_requests');
         
        $vocherrquest = VoucherRequest::select('voucher_request.*', 'users.username')->join('users', 'users.id', '=', 'voucher_request.user_id')->where('status', 'pending')->orderBy('updated_at', 'DESC')->paginate(10);

        $voucher_count = count($vocherrquest);

        return view('app.admin.voucherrequest.viewrequest', compact('title', 'sub_title', 'base', 'method', 'vocherrquest', 'user', 'voucher_count', 'sub_title', 'base', 'method'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
       
        $requestid = $request->requestid;

        $vocherrquest = VoucherRequest::find($requestid);
        $count        = $request->count;
        $amount       = $request->amount;
        $useridd      = $vocherrquest->user_id;

        $user_totalamount  = VoucherRequest::where('id', $requestid)->value('total_amount');
        $admin_totalamount = $amount * $count;
        $diffrnc           = $user_totalamount - $admin_totalamount;

        $balance = DB::table('user_balance')->select('balance')->where('user_id', $useridd)->value('balance');
        Balance::where('user_id', $useridd)->increment('balance', $diffrnc);
        VoucherRequest::where('id', $requestid)->update(array('amount' => $amount, 'count' => $count, 'total_amount' => $admin_totalamount));

        while ($count) {
            $voucher = self::RandomString();
            $res     = Voucher::create([
                'user_id'        => $vocherrquest->user_id,
                'voucher_code'   => $voucher,
                'total_amount'   => $request->amount,
                'balance_amount' => $vocherrquest->amount,
            ]);
            $count--;
        }

        $vocherrquest->status = "complete";
        $vocherrquest->save();

        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket_config.voucher_request_approved')));
        return redirect()->back();
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

    public function deletevouch(Request $request)
    {

        $requestid = $request->requestid;
        $user = VoucherRequest::where('id', $requestid)->first();
        User::upadteUserBalance($user->user_id, $user->total_amount);
        VoucherRequest::where('id', $requestid)->delete();

        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket_config.voucher_request_deleted')));
        return redirect()->back();
    }

    public function deleteconfirm(Request $request)
    {

        $res = Voucher::where('id', $request->cid)->delete();
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket_config.voucher_details')));
        return Redirect::action('Admin\VoucherController@voucherlist');
    }
}
