<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLangTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lang_texts', function (Blueprint $table) {
            $table->bigInteger("text_id");
            $table->char("lang_code", 5);
            $table->text('lang_text')->nullable();

            $table->primary(['text_id', 'lang_code']);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lang_texts');
    }
}