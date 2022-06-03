<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsortreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('sponsortree', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->integer('sponsor')->index();
            $table->integer('position')->default(0);
            $table->integer('member_count')->default(0);
            $table->string('type')->default('vaccant')->index();
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
        Schema::drop('sponsortree');
    }
}
