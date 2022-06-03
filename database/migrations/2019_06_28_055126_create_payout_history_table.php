<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayoutHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payout_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0)->index();
            $table->string('receiver_address')->default(0);
            $table->double('amount')->default(0);
            $table->string('response')->default(0);
            $table->string('payment_mode')->default(0)->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payout_history');
    }
}
