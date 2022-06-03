<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Closure;
use Auth;
use Carbon;
use Response;
use Cache;
use Validator;
use App\Shippingaddress;
use App\BillingAddress;
use App\User;
use App\Voucher;
// use App\Response;

class ChatController extends Controller
{
    public function setPresence(Request $request)
    {
   
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);
        
        if (Auth::check() && $request->status == "true") {
            $expiresAt = Carbon::now()->addMinutes(5);
            Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
            return "set to online";
        }

        if (Auth::check() && $request->status == "false") {
            $expiresAt = Carbon::now()->addMinutes(5);
            Cache::forget('user-is-online-' . Auth::user()->id, true, $expiresAt);
            return "set to offline";
        }
    }

    public function validatevoucher(Request $request)
    {
               return Voucher::getVoucher($request->voucher);
    }
    public function userList(Request $request){
       $user = User::where('username',$request->user)->value('id');
       $BillingAddress = BillingAddress::where('user_id',$user)->first();
       $Shippingaddress = Shippingaddress::where('user_id',$user)->first();
       return Response::json(array(['BillingAddress'=>$BillingAddress,'Shippingaddress'=>$Shippingaddress]));
   }
}
