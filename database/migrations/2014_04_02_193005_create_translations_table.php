<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTranslationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ltm_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status')->default(0);
            $table->string('locale', 32);
            $table->string('group', 128);
            $table->string('key', 128);
            $table->text('value')->nullable();
            $table->tinyInteger('was_used')->default(0);
            $table->index(['group'], 'ix_ltm_translations_group');
            $table->tinyInteger('is_deleted')->default(0);
            $table->text('saved_value')->nullable();
            $table->string('source', 256)->nullable();
            $table->unique(['locale', 'group', 'key'], 'ixk_ltm_translations_locale_group_key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ltm_translations');
    }
}
