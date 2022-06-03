<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSenangpayToPayout extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payout_gateway_details', function (Blueprint $table) {
            $table->string('merchant_id')->after('min_payout_amount')->default(0);
            $table->string('secret_key')->after('merchant_id')->default(0);
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payout_gateway_details', function (Blueprint $table) {
            //
        });
    }
}
