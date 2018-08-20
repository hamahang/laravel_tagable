<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lts_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255)->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->integer('lang_id')->unsigned()->nullable()->default(null);
            $table->string('lang_name', 255)->nullable()->default(null);
            $table->enum('is_active', array('0','1'))->default('1');
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
        Schema::dropIfExists('lts_tags');
    }
}
