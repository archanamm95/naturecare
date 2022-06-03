<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Productaddcart;
use App\Http\Requests;
use App\RegisterPoint;
use App\ProfileModel;
use App\Sponsortree;
use App\Packages;
use App\Balance;
use App\Product;
use App\User;
use App\PendingTransactions;
use Crypt;

use Validator;
use Response;
use DB;
use Auth;
use File;

class AjaxController extends Controller
{
    //

    public function validateSponsor(Request $request)
    {
   
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'sponsor' => 'exists:users,username|required',
        ]);
        // dd($request->all());
        
        if ($validator->fails()) {
            return response()->json(['valid' => false]);
        } else {
            return response()->json(['valid' => true]);
        }
        
        return response()->json(['valid' => false]);
    }

    public function validateEmail(Request $request)
    {
   
       
        $validator = Validator::make($request->all(), [
           'email' => 'required|unique:pending_transactions,email|unique:users,email|email|max:255',
        ]);
        // dd($request->all());
        
        if ($validator->fails()) {
            return response()->json(['valid' => false]);
        } else {
            return response()->json(['valid' => true]);
        }
        
        return response()->json(['valid' => false]);
    }

    public function validateUsername(Request $request)
    {
   
       
        $validator = Validator::make($request->all(), [
           'username' => 'required|unique:pending_transactions,username|alpha_num|max:255',
        ]);
        // dd($request->all());
        
        if ($validator->fails()) {
            return response()->json(['valid' => false]);
        } else {
            return response()->json(['valid' => true]);
        }
        
        return response()->json(['valid' => false]);
    }

    public function globalmap(Request $request)
    {
        $user_info = ProfileModel::groupBy('country')->where('user_id', '>', 1)
        ->join('users','users.id','profile_infos.user_id')
        ->where('users.user_type','!=','Customer')->select('country', DB::raw('count("country") as total'))->get();
        $keyed = $user_info->mapWithKeys(function ($item) {
            return [$item['country'] => $item['total']];
        });
        $list = $keyed->all();
        return Response::json($list);
    }

    public function globalmapUser(Request $request)
    {

        $users = Sponsortree::where('sponsor', '=', Auth::user()->id)
                            ->where('type', '=', 'yes')
                            ->pluck('user_id')
                            ->toArray();
   
        $user_info = ProfileModel::whereIn('user_id', $users)->groupBy('country')->select('country', DB::raw('count("country") as total'))->get();
        $keyed = $user_info->mapWithKeys(function ($item) {
            return [$item['country'] => $item['total']];
        });
        $list = $keyed->all();
        return Response::json($list);
    }


    
    public function validateewalletpassword(Request $request)
    {

        $user_det=User::where('username', $request->username)->first();
        if ($user_det <> null) {
            if ($user_det->transaction_pass == $request->password) {
                $balance=Balance::where('user_id', $user_det->id)->value('balance');
                if ($balance >= $request->amount || $user_det->id == 1) {
                     return response()->json(['valid' => true]);
                } else {
                    return response()->json(['valid' => false,'message' => 'No enough balance']);
                }
            } else {
                return response()->json(['valid' => false,'message' => 'Transaction Password Is Incorrect']);
            }
        } else {
            return response()->json(['valid' => false,'message' => 'User Not Exist']);
        }
    }
    public function checkProductBv(Request $request)
    {   
        try{
            $user_det=Packages::where('id', $request->package)->first();
            $pv          = $user_det->pv;
            $bv          = Product::find(1)->bv;
            $countvalue  = $pv/$bv;
            if(is_float($countvalue))
                $required_count     = floor($countvalue)+1;
            else
                $required_count     = $countvalue;
            $product_count = $request->quantity;
            if ($required_count  <= $product_count) {
                 return response()->json(['valid' => true]);
            } else {
                return response()->json(['valid' => false,'message' => 'No enough Product']);
            }
        } catch (\Exception $e) {
            return response()->json(['valid' => false,'message' => $e->getMessage()]);
        }
    }
    public function getRegisterPoint(Request $request){
        $sponsor_id = User::where('username',$request->sponsor)->value('id');
        $point      = Balance::where('user_id',$sponsor_id)->value('register_point'); 
        $used_point = RegisterPoint::where('user_id',$sponsor_id)->where('type','debit')->sum('total_amount');
        return response()->json(['point' => $point, 'used_point' => $used_point]);
    }
    public function getSponsorId(Request $request){
        $sponsor_id = User::where('username',$request->sponsor)->value('id');
        return response()->json(['id' => $sponsor_id]);
    }
    public function getPackage(Request $request){
        $totalBv = $request->quanttity*Product::find(1)->bv;
        $package = Packages::where('pv','<=',$totalBv)->max('id');
        return response()->json(['package' => $package]);
    }

     public function getDocument($document){
      
       $path = public_path() .'/uploads/documents/'.($document);
       $file = File::get($path);
       $type = File::mimeType($path);

       $response = Response::make($file, 200);
       $response->header("Content-Type", $type);
      
       return $response;
      
    }



     public function getpreviewpayment($id)
    { 

        $item=PendingTransactions::where('id',$id)->first();
        $crypt_id =   Crypt::encrypt($item->Purchase_id);
 
        return response()->json(['valid' => true,'payment_status'=>$item->payment_status,'id'=>$item->id,'type'=>$item->payment_type,'purchase','purchase_id' => $crypt_id]);

    }
}
