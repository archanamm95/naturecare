<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->integer('from_id');
            $table->double('total_amount');
            $table->double('tds');
            $table->double('service_charge');
            $table->double('payable_amount');
            $table->string('payment_type', 255)->default('')->index();
            $table->string('payment_status')->default('yes')->index();
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
         Schema::drop('commission');
    }
}
