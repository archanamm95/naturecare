<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PayoutRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payout_request', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id');
            $table->index('created_at');
            $table->double('amount');
            $table->string('payment_mode')->nullable();
            $table->string('payment_type');
            $table->string('commission_id')->nullable();
            $table->string('status', 255)->default('');
            $table->string('tx_hash')->default('')->nullable();
            $table->string('released_date')->nullable();;
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
        Schema::drop('payout_request');
    }
}
