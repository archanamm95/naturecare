<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfluencerTreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('influencer_tree', function (Blueprint $table) {            
            $table->engine = 'InnoDB';            
            $table->bigIncrements('id');
            $table->integer('user_id')->index();
            $table->integer('sponsor')->index();
            $table->integer('position')->default(0);
            $table->integer('member_count')->default(0);
            $table->string('type')->default('vaccant')->index();
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
        Schema::dropIfExists('influencer_tree');
    }
}
