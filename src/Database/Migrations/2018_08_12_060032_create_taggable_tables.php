<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaggableTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lts_tagables', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->integer('taggable_id')->unsigned();
            $table->string('taggable_type', 255)->nullable()->default(null);
            $table->string('type', 255)->nullable()->default(null);
            $table->integer('created_by')->unsigned()->nullable()->default(null);
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
        Schema::dropIfExists('lts_tagables');
    }
}
