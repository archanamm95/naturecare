<?php

namespace App\Http\Controllers\Admin;

use App\Balance;
use App\Http\Controllers\Admin\AdminController;
use App\Payout;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Session;
use Response;
use App\Emails;
use App\AppSettings;
use App\PaymentNotification;
use App\Payoutmanagemt;
use App\Hyperwallet;
use App\PayoutcronHistory;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use App\PaypalPayout;
use App\payout_gateway_details;
use App\ProfileInfo;
use Mail;

class PayoutController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $_api_context;
    public function __construct()
    {
        parent::__construct();
        
        /** setup PayPal api context **/
        // $paypal_conf = \Config::get('paypal');
        // $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        // $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function index()
    {

        $title     = trans('payout.payout');
        $sub_title = trans('payout.view_payout');
        $base      = trans('payout.payout');
        $method    = trans('payout.payout_request');

        $userss = User::getUserDetails(Auth::id());
        $user   = $userss[0];

        $vocherrquest = Payout::select('payout_request.*', 'users.username','users.name','users.lastname','users.email', 'user_balance.balance', 'payout_request.id as payout_id', 'payout_types.payment_mode as payment_mode','profile_infos.account_number','profile_infos.account_holder_name','profile_infos.swift','profile_infos.bank_code','profile_infos.branch_address')
                                ->join('user_balance', 'user_balance.user_id', '=', 'payout_request.user_id')
                                ->join('users', 'users.id', '=', 'payout_request.user_id')
                                ->join('payout_types', 'payout_types.id', '=', 'payout_request.payment_mode')
                                ->join('profile_infos', 'profile_infos.user_id', '=', 'users.id')
                                ->where('payout_request.status', '=', 'pending')
                                ->orderBy('created_at', 'ASC')
                                ->get();
        $count_requests = count($vocherrquest);

        return view('app.admin.payout.index', compact('title', 'vocherrquest', 'user', 'count_requests', 'sub_title', 'base', 'method'));
    }

    public function getpayout()
    {
        $payout = Payout::sum('amount');

        $balance = Balance::sum('balance');
        echo isset($payout) ? $payout : 0;
        echo ',';
        echo isset($balance) ? $balance : 0;
    }
    public function confirm(Request $request)
    {   

        foreach ($request->data as $key => $value) {
            $request = json_decode($value);
            
            $user=User::join('profile_infos', 'profile_infos.user_id', '=', 'users.id')
                           ->where('users.id', $request->user_id)
                           ->select('users.*', 'profile_infos.*')
                           ->first();
            $amount         =$request->amount;
            $email          =$user->email;
            $pay_reqid      =$request->id;
            $payout_request = Payout::find($pay_reqid);
            $currency       =currency()->getUserCurrency();
            if ($request->payment_mode =='Bitaps') {
                $admin_btc      = payout_gateway_details::find(1);
                $wallet_id      = $admin_btc->wallet_id;
                $wallet_id_hash = $admin_btc->wallet_hashId;
                $user_btcaddres = $user->btc_wallet;
                $params = array("receivers_list"=> array(array("address" => $user_btcaddres,"amount" =>  $amount),),
                                    "wallet_id" => $wallet_id );
                $curl   = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL            => "https://api.bitaps.com/btc/v1/wallet/send/payment/".$wallet_id_hash,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST  => "POST",
                CURLOPT_POSTFIELDS     => json_encode($params)
                ));

                $response = curl_exec($curl);
                $respond  = json_decode($response, true);
                PayoutcronHistory::create([
                      'user_id'          => $user->id,
                      'receiver_address' => $user_btcaddres ,
                      'amount'           => $amount,
                      'response'         => $response,
                      'payment_mode'     =>'Bitaps'
                    ]);
                

                if (!isset($respond['error_code'])) {
                    Payout::where('id', $request->id)->update(['tx_hash' =>$response->message->tx_hash]);
                    if ($payout_request->amount > $request->amount) {
                        $diff_amount = $payout_request->amount - $request->amount;
                        $res         = Balance::where('user_id', $request->user_id)->increment('balance', $diff_amount);
                    }
                    $res = Payout::confirmPayoutRequest($pay_reqid, $amount); 
                    if ($res) {
                        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('payout.successful_payout')));
                    } else {
                        Session::flash('flash_notification', array('level' => 'error', 'message' => trans('payout.unsuccessful_payout')));
                    }
                } else {
                     Session::flash('flash_notification', array('level' => 'error', 'message' => $respond['message']));
                }
            } elseif ($request->payment_mode=='Paypal') {
                $admin_paypal   =payout_gateway_details::find(1);
                $paypal_id      =$user->paypal;
                $paypal_email=ProfileInfo::where('user_id', $user->id)->value('paypal');
               
                $type='paypal';
                $payouts = new \PayPal\Api\Payout();
                $senderBatchHeader = new \PayPal\Api\PayoutSenderBatchHeader();
                $token_id = str_random(60);
                $senderBatchHeader->setSenderBatchId(uniqid())
                                  ->setEmailSubject("TOKEN='".$token_id."'");
                $senderItem = new \PayPal\Api\PayoutItem(
                    array(
                            "recipient_type" => "EMAIL",
                            "receiver" =>$paypal_email,
                            "note" => "Thank you.",
                            "sender_item_id" => uniqid(),
                            "amount" => array(
                            "value" => $amount,
                            "currency" => "USD"
                            )
                        )
                );

                $payouts->setSenderBatchHeader($senderBatchHeader)
                        ->addItem($senderItem);
                $request = clone $payouts;
                try {
                    $output = $payouts->create(array('sync_mode' => 'false'), $this->_api_context);
                     PayoutcronHistory::create([
                      'user_id'          => $user->id,
                      'receiver_address' => $paypal_email,
                      'amount'           => $amount,
                      'response'         => $output,
                      'payment_mode'     =>'paypal'
                     ]);
              
                    if ($payout_request->amount > $request->amount) {
                        $diff_amount = $payout_request->amount - $request->amount;
                        $res         = Balance::where('user_id', $request->user_id)->increment('balance', $diff_amount);
                    }
                    $res = Payout::confirmPayoutRequest($pay_reqid, $amount);
                    if ($res) {
                        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('payout.successful_payout')));
                    } else {
                        Session::flash('flash_notification', array('level' => 'error', 'message' =>trans('payout.unsuccessful_payout')));
                    }
                } catch (\PayPal\Exception\PayPalConnectionException $ex) {
                    $exception = json_decode($ex->getData(), true);
                     Session::flash('flash_notification', array('level'=>'error','message'=>$exception['message']));
                    return redirect()->back();
                    exit(1);
                }
                return redirect()->back();
            } elseif ($request->payment_mode=='Manual/Bank') {
                if ($payout_request->amount > $request->amount) {
                     $diff_amount = $payout_request->amount - $request->amount;
                     $res         = Balance::where('user_id', $request->user_id)->increment('balance', $diff_amount);
                }
                    $balance=Balance::where('user_id', $user->id)->value('balance');
                    // dd($balance);
                    $res = Payout::confirmPayoutRequest($pay_reqid, $amount);
                    PayoutcronHistory::create([
                      'user_id'          => $user->id,
                      'receiver_address' => $user->name,
                      'amount'           => $amount,
                      'response'         => "",
                      'payment_mode'    =>'manual/bank',
                    ]);

                    Balance::where('user_id', $user->id)
                                           ->update(array('balance' => $balance-$amount));
                if (!$res)
                    return Response::json(['status' => false]);

            } elseif ($request->payment_mode =='Hyperwallet') {
                $admin_hyperwallet=payout_gateway_details::find(1);
                $hyperwallet = new \Hyperwallet\Hyperwallet($admin_hyperwallet->username, $admin_hyperwallet->password, $admin_hyperwallet->program_token);
                $payment = new \Hyperwallet\Model\Payment();
                $payment
                ->setDestinationToken($user->hypperwallet_token)
                ->setProgramToken($admin_hyperwallet->program_token)
                ->setClientPaymentId(uniqid($user->hypperwalletid))
                ->setCurrency('USD')
                ->setAmount($request->amount)
                ->setPurpose('OTHER');
                try {
                    $payment = $hyperwallet->createPayment($payment);
                    var_dump('Payment created', $payment);
                    if ($payout_request->amount > $request->amount) {
                        $diff_amount = $payout_request->amount - $request->amount;
                        $res         = Balance::where('user_id', $request->user_id)->increment('balance', $diff_amount);
                    }

                    $res = Payout::confirmPayoutRequest($pay_reqid, $amount);
                    PayoutcronHistory::create([
                      'user_id'          => $user->id,
                      'receiver_address' => $user->hypperwalletid,
                      'amount'           => $amount,
                      'response'         => $payment->programToken,
                      'payment_mode'     =>'hyperwallet'
                    ]);
                    if ($res) {
                        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('payout.successful_payout')));
                    } else {
                        Session::flash('flash_notification', array('level' => 'error', 'message' => trans('payout.unsuccessful_payout')));
                    }
                } catch (\Hyperwallet\Exception\HyperwalletException $e) {
                    echo 'Caught exception: ',  $e->getMessage(), "\n";
                    $error = $e->getMessage();
                    Session::flash('flash_notification', array('level' => 'error', 'message' => $error));
                }
            }
        }
        // return redirect()->back();
        return Response::json(['status' => true]);
    }

    public function reject($id, $amount)
    {
   
        echo "test";
        $payout_request = Payout::find($id);
        $payout_request->amount;
        $res         = Balance::where('user_id', $payout_request->user_id)->increment('balance', $amount);
        Payout::where('id', '=', $id)
               ->update(['status'=>'rejected']);

        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('payout.payout_rejected')));
       
        return redirect()->back();
    }

    public function payoutdelete(Request $request)
    {
        $res = Payout::deletePayoutRequest($request->requestid);
        if ($res) {
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('payout.payout_deleted')));
        } else {
            Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('payout.details_updated')));
        }
        return redirect()->back();
    }
}
