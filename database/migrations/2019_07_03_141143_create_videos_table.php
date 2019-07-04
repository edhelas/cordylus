<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cover');

            $table->boolean('exclusive')->default(false);
            $table->boolean('published')->default(false);

            $table->string('preview_h264');
            $table->string('preview_webm');
            $table->string('1080_h264')->nullable();
            $table->string('720_h264')->nullable();
            $table->string('1080_webm')->nullable();
            $table->string('720_webm')->nullable();

            $table->unsignedBigInteger('shooting_id');
            $table->foreign('shooting_id')->references('id')->on('shootings');
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
        Schema::dropIfExists('videos');
    }
}
