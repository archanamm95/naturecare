<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadCaptureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_capture', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('username');
            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->integer('status')->default(0);
            $table->string('lastname')->default(null)->nullable();
            $table->string('address')->default(null)->nullable();
            $table->string('list_id')->default(null)->nullable();


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
        Schema::drop('lead_capture');
    }
}
