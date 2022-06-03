<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePairingHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pairing_history', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id');
            $table->double('total_left', 15, 2)->default(0);
            $table->double('total_right', 15, 2)->default(0);
            $table->double('left', 15, 2)->default(0);
            $table->double('right', 15, 2)->default(0);
            $table->double('first_percent', 15, 2)->default(0);
            $table->double('first_amount', 15, 2)->default(0);
            $table->double('first_bonus', 15, 2)->default(0);
            $table->double('second_percent', 15, 2)->default(0);
            $table->double('second_amount', 15, 2)->default(0);
            $table->double('second_bonus', 15, 2)->default(0);
            $table->double('third_percent', 15, 2)->default(0);
            $table->double('third_amount', 15, 2)->default(0);
            $table->double('third_bonus', 15, 2)->default(0);
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
        Schema::drop('pairing_history');
    }
}
