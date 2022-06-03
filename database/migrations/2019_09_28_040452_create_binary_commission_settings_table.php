<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBinaryCommissionSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binary_commission_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('period');
            $table->string('type');
            $table->double('pair_value')->default('100')->nullable();
            $table->string('binary_cap')->default('yes')->nullable();
            $table->double('pack_2')->nullable();
            $table->double('pack_3')->nullable();
            $table->double('pack_4')->nullable();
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
        Schema::dropIfExists('binary_commission_settings');
    }
}
