<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('path');
            $table->unsignedBigInteger('shooting_id');
            $table->foreign('shooting_id')->references('id')->on('shootings');
            $table->timestamps();
        });

        Schema::table('shootings', function (Blueprint $table) {
            $table->unsignedBigInteger('primary_photo_id')->nullable();
            $table->foreign('primary_photo_id')->references('id')->on('photos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shootings', function (Blueprint $table) {
            $table->dropColumn('primary_photo_id');
        });

        Schema::dropIfExists('photos');
    }
}
