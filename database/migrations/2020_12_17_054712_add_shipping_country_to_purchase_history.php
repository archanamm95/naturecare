<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShippingCountryToPurchaseHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_history', function (Blueprint $table) {
            $table->string('billing_address_id')->after('order_id')->default(0);
            $table->string('shipping_address_id')->after('billing_address_id')->default(0);
            $table->string('shipping_country')->after('pay_by')->default('MY');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_history', function (Blueprint $table) {
            //
        });
    }
}
