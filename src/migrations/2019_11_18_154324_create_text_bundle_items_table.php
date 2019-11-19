<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextBundleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_bundle_items', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->integer('text_bundle_id')->index();
            $table->char("key",50)->unique();
            $table->bigInteger("text_id")->index();

            $table->string("description")->nullable();
            $table->boolean("is_translated")->default(false);

            $table->integer("updated_times")->default(1);
            $table->bigInteger("last_updated_by")->nullable();
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
        Schema::dropIfExists('text_bundle_items');
    }
}