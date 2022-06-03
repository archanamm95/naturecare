<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoolHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pool_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('total_bv');
            $table->double('total_count');
            $table->double('poolbonus');
            $table->integer('qualified_user_count');
            $table->double('share_amount');
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
        Schema::dropIfExists('pool_history');
    }
}
