<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_setting', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('host')->default(0);
            $table->string('port')->default(0);
            $table->string('username');
            $table->string('password');
            $table->string('incoming_server');
            $table->string('incoming_port');
            $table->string('outgoing_server');
            $table->string('outgoing_port');
            $table->string('from_name');
            $table->string('from_email');
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
        Schema::drop('email_setting');
    }
}
