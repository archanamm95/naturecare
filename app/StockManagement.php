<?php

namespace App;
use App\SharePartner;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockManagement extends Model
{
    use SoftDeletes;
    
    protected $table = 'stock_management';

    protected $fillable = ['user_id','product_id','in','out','balance','Delivery','status'];

    public static function sharePartner_Order($user_id)
    {
       $sharepartnerProducts = SharePartner::select('id','products','quantity')->get();
       
        foreach ($sharepartnerProducts as $key => $product) 
        {
            
            self::create(['user_id'=>$user_id,
                          'product_id' =>$product->id,
                          'in'         =>$product->quantity,
                          'balance'    =>$product->quantity,

            ]);   
        }
     
    }


    public static function sellSharePartnerProducts(Request $request)
    {
        $balance = $request->balanace - $request->out;

            self::create(['user_id'=>$user_id],
                                 ['product_id' =>$product->id,
                                 'in'         =>$product->quantity,
                                 'balance'    =>$balance

            ]);   
       
    }
}
