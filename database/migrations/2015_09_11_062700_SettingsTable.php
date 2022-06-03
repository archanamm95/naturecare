<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //
         Schema::create('settings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('monthly_count')->default(4);
            $table->integer('point_value');
            $table->integer('pair_value');
            $table->integer('pair_amount');
            $table->integer('tds');
            $table->integer('service_charge');
            $table->integer('sponsor_Commisions');
            $table->integer('payout_notification');
            $table->integer('joinfee');
            $table->double('min_p_sales');
            $table->double('p_sales_per');
            $table->integer('voucher_daily_limit');
            $table->longtext('content');
            $table->integer('memberSale_validity');
            $table->integer('ProductCountDealer');
            $table->longtext('cookie');
            $table->string('uploadusers')->default('uploadusers.xlsx');
            $table->integer('bonus_1');
            $table->integer('bonus_2');
            $table->integer('member_condition');
            $table->integer('dealer_condition');
            $table->double('influencer_manager');
            $table->double('influencer_level');

            $table->timestamps();
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settings');
    }
}
