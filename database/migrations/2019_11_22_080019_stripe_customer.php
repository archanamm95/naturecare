<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StripeCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('stripe_customer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('customer_id');
            $table->integer('package_id');
            $table->integer('category_id');
            $table->integer('amount');           
            $table->string('currency');
            $table->string('country_id');
            $table->string('source');
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
         Schema::dropIfExists('stripe_customer');
    }
}
