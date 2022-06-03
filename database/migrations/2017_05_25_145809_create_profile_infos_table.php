<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_infos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->index()->unsigned();
            // $table->foreign('user_id')->references('id')->on('users');
            $table->string('dateofbirth', 60)->default('00/00/0000');
            $table->string('address1')->default(false);
            $table->string('address2')->default(false)->nullable();
            $table->string('gender')->default(false)->nullable();
            $table->string('city', 200)->default(false)->nullable();
            $table->string('location', 200)->default(false)->nullable();
            $table->string('occuption', 200)->default(false)->nullable();
            $table->string('country', 200)->default(false)->nullable();
            $table->string('state', 200)->default(false)->nullable();
            $table->string('zip', 60)->default('000000')->nullable();
            $table->string('image', 600)->default('avatar-big.png');

            $table->string('profile', 600)->default('avatar.png');
            $table->string('cover', 600)->default('cover.jpg');

            $table->string('mobile', 60)->default(false)->nullable();
            ;
            $table->string('passport', 60)->default(false)->nullable();
            $table->string('id_file', 60)->default(false)->nullable();
            $table->string('id_file_back', 60)->default(false)->nullable();
            ;
            $table->string('skype', 200)->default(false)->nullable();
            ;
            $table->string('twitter')->default(false)->nullable();
            ;
            $table->string('facebook')->default(false)->nullable();
            ;
            $table->string('gplus')->default(false)->nullable();
            ;
            $table->string('linkedin')->default(false)->nullable();
            ;
            $table->string('whatsapp')->default(false)->nullable();
            ;
            $table->string('wechat')->default(false)->nullable();
            ;
             $table->string('instagram')->default(false)->nullable();
            ;
             $table->string('tiktok')->default(false)->nullable();
            ;
             $table->string('Shopee_Shop_Name')->default(false)->nullable();
            ;
             $table->string('Lazada_Shop_name')->default(false)->nullable();
            ;
             $table->string('youtube')->default(false)->nullable();
            ;

            $table->text('about')->nullable();
            $table->integer('package')->default(1)->nullable();
            ;
            $table->integer('currency')->default(1)->nullable();
            ;
            $table->integer('mnthly_cashback')->default(0)->nullable();
            ;
            $table->string('account_number', 200)->nullable();
            ;
            $table->string('account_holder_name')->nullable();
            ;
            $table->string('swift', 200)->nullable();
            ;
            $table->string('sort_code', 200)->nullable();
            ;
            $table->string('bank_code', 200)->nullable();
            ;
            $table->string('paypal', 200)->default(false)->nullable();
            ;
            $table->string('btc_wallet')->default(0)->nullable();
            ;
                        
            $table->index('created_at');
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
        Schema::drop('profile_infos');
    }
}
