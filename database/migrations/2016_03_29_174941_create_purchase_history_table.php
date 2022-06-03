<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_history', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('product_name')->default(false);
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('seller_id')->unsigned()->index();
            $table->bigInteger('purchase_user_id')->unsigned();
            $table->foreign('purchase_user_id')->references('id')->on('users');
            $table->integer('package_id')->unsigned();
            $table->integer('package_purchase_id')->unsigned();
            $table->double('bv',15,2)->index();
            $table->integer('total_count');
            $table->double('total_bv',15,2);
            $table->integer('order_id');
            $table->foreign('package_id')->references('id')->on('packages');
            $table->double('pv', 15, 2)->default(0);
            $table->double('count', 15)->default(0);
            $table->double('total_amount', 15, 2)->default(0);
            $table->string('pay_by')->default(false);
            $table->string('sales_status')->default('yes');
            $table->double('rs_balance')->default(false);
            $table->string('purchase_type');
            $table->string('order_status')->nullable();
            $table->string('pool_status')->default('no');
            $table->string('type')->index();
            $table->string('payment_date')->nullable();
            $table->string('tracking_id')->nullable();
            $table->string('courier_service')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            $table->index('created_at');
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('purchase_history');
    }
}


// Schema::table('services', function($table) { 
//     $table->bigInteger('business_id')->unsigned()->index(); 
//     $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade'); 
// });