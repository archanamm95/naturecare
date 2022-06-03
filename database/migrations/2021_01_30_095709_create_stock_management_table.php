<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_management', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->integer('user_id')->index();
             $table->integer('product_id');
             $table->integer('in')->default(0)->index();
             $table->integer('out')->default(0);
             $table->integer('balance')->default(0);
             $table->string('remark')->default('Delivery');
             $table->string('status')->default('Ok');
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
        Schema::dropIfExists('stock_management');
    }
}
