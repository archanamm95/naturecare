<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMonthlyMaintenanceToBinaryCommissionSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('binary_commission_settings', function (Blueprint $table) {
            $table->integer('monthly_maintenance')->after('pack_4')->default('100');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('binary_commission_settings', function (Blueprint $table) {
            //
        });
    }
}
