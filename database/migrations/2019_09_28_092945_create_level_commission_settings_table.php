<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevelCommissionSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level_commission_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('criteria');
            $table->double('criteria_l1')->nullable();
            $table->double('criteria_l2')->nullable();
            $table->double('criteria_l3')->nullable();
            $table->double('criteria2_l3')->nullable();
            $table->double('level_1')->nullable();
            $table->double('level_2')->nullable();
            $table->double('level_3')->nullable();
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
        Schema::dropIfExists('level_commission_settings');
    }
}
