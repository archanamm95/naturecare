<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendingCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_commissions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->integer('from_id');
            $table->double('total_amount');
            $table->double('tds');
            $table->double('service_charge');
            $table->double('payable_amount');
            $table->string('payment_type', 255)->default('')->index();
            $table->string('payment_status')->default('no')->index();
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
        Schema::dropIfExists('pending_commissions');
    }
}
