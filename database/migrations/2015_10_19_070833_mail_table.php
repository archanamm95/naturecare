<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_table', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('from_id');
            $table->integer('to_id');
            $table->longtext('message')->default('');
            $table->string('message_subject', 1000)->default('');
            $table->string('read', 10)->default('no');
            $table->string('sender_delete');
            $table->string('recipient_delete');
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
        Schema::drop('mail_table');
    }
}
