<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevelSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('package');
            $table->double('commission_level1')->nullable()->index();
            $table->double('commission_level2')->nullable()->index();
            $table->double('commission_level3')->nullable()->index();
            $table->double('matching_level1')->nullable()->index();
            $table->double('matching_level2')->nullable()->index();
            $table->double('matching_level3')->nullable()->index();
            $table->double('sponsor_comm')->nullable()->index();
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
        Schema::dropIfExists('level_settings');
    }
}
