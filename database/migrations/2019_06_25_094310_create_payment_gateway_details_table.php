<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentGatewayDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_gateway_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bank_details')->nullable();
            $table->string('btc_address')->nullable();
            $table->string('auth_merchant_name')->nullable();
            $table->string('auth_transaction_key')->nullable();
            $table->string('rave_public_key')->nullable();
            $table->string('rave_secret_key')->nullable();
            $table->string('paypal_username')->nullable();
            $table->string('paypal_password')->nullable();
            $table->string('paypal_secret_key')->nullable();
            $table->string('stripe_secret_key')->nullable();
            $table->string('stripe_public_key')->nullable();
            $table->string('ipaygh_merchant_key')->nullable();
            $table->string('skrill_mer_email')->nullable();
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
        Schema::dropIfExists('payment_gateway_details');
    }
}
