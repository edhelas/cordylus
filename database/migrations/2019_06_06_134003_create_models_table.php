<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->string('instagram')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();
            $table->unique('slug');
        });

        Schema::create('model_shooting', function (Blueprint $table) {
            $table->unsignedBigInteger('shooting_id');
            $table->unsignedBigInteger('model_id');
            $table->foreign('shooting_id')->references('id')->on('shootings');
            $table->foreign('model_id')->references('id')->on('models');
            $table->unique(['shooting_id', 'model_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_shooting');
        Schema::dropIfExists('models');
    }
}
