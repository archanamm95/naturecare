<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VoucherHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('voucher_history', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('voucher_id', 5000)->default('');
            $table->string('user_id', 1000)->nullable();
            $table->string('used_by', 1000)->default('');
            $table->string('used_for', 100)->default('NA');
            $table->double('used_amount');
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
        Schema::drop('voucher_history');
    }
}
