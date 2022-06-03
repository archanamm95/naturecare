<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->integer('user_id');
             $table->string('fname')->nullable();
             $table->string('lname')->nullable();
             $table->string('email')->nullable();
             $table->text('address')->nullable();
             $table->text('address2')->nullable();
             $table->string('city')->nullable();
             $table->string('state')->nullable();
             $table->string('country')->nullable();
             $table->string('pincode')->nullable();
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
        Schema::dropIfExists('billing_addresses');
    }
}
