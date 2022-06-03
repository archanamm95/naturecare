<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_table', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->double('left_carry', 2)->default(false);
            $table->double('right_carry', 2)->default(false);
            $table->double('total_left', 2)->default(false);
            $table->double('total_right', 2)->default(false);
            $table->double('pv', 2)->default(0);
            $table->integer('left_user')->default(0);
            $table->integer('right_user')->default(0);
            $table->integer('left_puser')->default(0);
            $table->integer('right_puser')->default(0);
            $table->double('redeem_pv', 2)->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->index('created_at');
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('point_table');
    }
}
