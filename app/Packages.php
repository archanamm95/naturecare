<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mail;
use CountryState;
class Packages extends Model
{
    //

    use SoftDeletes;

    protected $table = 'packages' ;

    protected $fillable = ['package','pv','rs','amount','code','image'];

    public static function TopUPAutomatic($user_id)
    {
        $user_detils = User::find($user_id);
        $balance = Balance::where('user_id', $user_id)->pluck('balance');
        $package = self::find($user_detils->package);

        if ($package->amount <= $balance) {
            Balance::where('user_id', $user_id)->decrement('balance', $package->amount);
            PurchaseHistory::create([
                'user_id'=>$user_id,
                'package_id'=>$user_detils->package,
                'count'=>$package->top_count,
                'total_amount'=>$package->amount,
                ]);
             User::where('id', $user_id)->increment('revenue_share', $package->rs);

             RsHistory::create([
                    'user_id'=> $user_id ,
                    'from_id'=> $user_id ,
                    'rs_credit'=> $package->rs ,
                    ]);


             /* Check for rank upgrade */

             Ranksetting::checkRankupdate($user_id, $user_detils->rank_id);

            return true;
        } else {
            return flase ;
        }
    }

 
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function profileinfo()
    {
        return $this->belongsTo('App\Profileinfo');
    }

    public function PurchaseHistoryR()
    {
        return $this->hasMany('App\PurchaseHistory', 'package_id', 'id')->where('type','package');
    }
    public static function saveinvoice($user_id,$purchase_id)    {
      
       $company_details = AppSettings::find(1);
       $user_data       = User::find($user_id);
       $user_details    = ProfileInfo::where('user_id',$user_id)->first();
       $purchase_details = PurchaseHistory::find($purchase_id);
       $package_details  = Product::find($purchase_details->package_id);
       // $invoice_id              =  str_pad($purchase_id,7, '0', STR_PAD_LEFT);
       $shipping = Shippingaddress::find($purchase_details->shipping_address_id);
       $countries = CountryState::getCountries();
       $country   = array_get($countries,$shipping->country);
       $count = PurchaseHistory::whereDate('created_at', '=', date('Y-m-d'))->count();
       $count = $count + 1;
       $date  = date('Ym');
       $invoice_id=$date.'/00'.$count;
       if($country != null)
             $purchase_details->shipping_country_name = $country;
       $states = CountryState::getStates($shipping->country);
       $state  = array_get($states,$shipping->state);

       if($state != null)
             $purchase_details->shipping_state_name = $state;

       $countries = CountryState::getCountries();
       $country   = array_get($countries,$user_details->country);
       if($country != null)
             $user_details->country_name = $country;
       $states = CountryState::getStates($user_details->country);
       $state  = array_get($states,$user_details->state);
       if($state != null)
             $user_details->state_name = $state;
       $pdf = \App::make('dompdf.wrapper');
       $pdf = $pdf->loadView('auth.pdfview',compact('company_details','user_data','user_details','purchase_details','package_details','invoice_id'));
       
       $invoice_id=$date.'-00'.$count;
       $file_name="NC Invoice".' '.$invoice_id;
       $pdf->save(storage_path('pdf/'.$file_name.'.pdf'));
       PurchaseHistory::where('id',$purchase_id)->update(['invoice_id'=>$file_name.'.pdf']);   
       $email        = Emails::find(1);
       // Mail::send('pdf',['company_details' => $company_details,'user_data'=>$user_data,'user_details'=>$user_details,'purchase_details'=>$purchase_details,'package_details'=>$package_details,'invoice_id'=>$invoice_id],function ($m) use ($user_data, $email,$pdf) {
       //    $m->to($user_data->email, $user_data->name)->subject('Sheheme Purchase Invoice')->attachData($pdf->output(), "Sheheme Purchase Invoice.pdf")->from($email->from_email, $email->from_name);
       // });
    }
}
