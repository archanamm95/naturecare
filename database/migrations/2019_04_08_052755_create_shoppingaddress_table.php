<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingaddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoppingaddress', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('user_id');
             $table->string('payment')->nullable();
             $table->string('tracking_id')->nullable();
             $table->integer('order_id')->nullable();
             $table->integer('option_type')->nullable();
             $table->string('fname')->nullable();
             $table->string('lname')->nullable();
             $table->string('email')->nullable();
             $table->string('state')->nullable();
             $table->string('country')->nullable();
             $table->string('contact')->nullable();
             $table->string('ninumber')->nullable();
             $table->string('ic_number')->nullable();
             $table->string('city')->nullable();
             $table->text('address')->nullable();
             $table->text('address2')->nullable();
             $table->string('pincode')->nullable();
             $table->string('status')->nullable();
             $table->string('shipping_company')->default('NA');
             $table->string('admin_feed_back')->default('NA');
             $table->string('my_feed_back')->default('NA');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shoppingaddress');
    }
}
