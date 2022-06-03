<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayoutGatewayDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payout_gateway_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('paypal_clientId')->default(false)->nullable();
            $table->string('paypal_secret')->default(false)->nullable();
            $table->string('wallet_id')->default(false)->nullable();
            $table->string('wallet_hashId')->default(false)->nullable();
            $table->string('username')->default(false)->nullable();
            $table->string('program_token')->default(false)->nullable();
            $table->string('password')->default(false)->nullable();
             $table->string('payout_setup_admin')->default('no')->nullable();
              $table->string('payout_setup_user')->default('yes')->nullable();
               $table->string('min_payout_amount')->default(10)->nullable();

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
        Schema::dropIfExists('payout_gateway_details');
    }
}
