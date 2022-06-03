<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('tree_table', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->integer('sponsor')->index();
            $table->integer('placement_id');
            $table->string('leg');
            $table->string('type')->default('vaccant');
            $table->integer('position');
            $table->integer('level');
            $table->timestamps();
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
        Schema::drop('tree_table');
    }
}
