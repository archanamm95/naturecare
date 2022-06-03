<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Options extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            // $table->increments('id');

            // $table->string('company_name', 5000)->default('');
            // $table->string('company_email', 1000)->default('');
            // $table->string('company_address', 1000)->default('');

            // $table->string('logo_light', 600)->default('logo-light.png');
            // $table->string('logo_dark', 600)->default('logo-dark.png');
            // $table->string('logo_icon_light', 600)->default('logo-icon-light.png');
            // $table->string('logo_icon_dark', 600)->default('logo-icon-dark.png');

            
            $table->increments('id');
            $table->string('key')->unique();
            $table->string('display_name');
            $table->text('value');
            $table->text('details')->nullable()->default(null);
            $table->string('type');
            $table->integer('order')->default('1');
            $table->string('group')->nullable();



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
        Schema::drop('options');
    }
}
