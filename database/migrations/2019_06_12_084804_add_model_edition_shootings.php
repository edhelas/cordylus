<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddModelEditionShootings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('model_shooting', function (Blueprint $table) {
            $table->string('hash')->nullable();
        });

        foreach (\App\Shooting::all() as $shooting) {
            foreach($shooting->models as $model) {
                $model->pivot->hash = str_random(8);
                $model->pivot->save();
            }
        }

        Schema::table('model_shooting', function (Blueprint $table) {
            $table->string('hash')->nullable(false)->change();
        });

        Schema::table('shootings', function (Blueprint $table) {
            $table->boolean('published')->default(false);
            $table->text('comment')->nullable();
        });

        Schema::create('model_photo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->string('instagram')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();
            $table->unique('slug');
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
            $table->dropColumn('published');
            $table->dropColumn('comment');
        });

        Schema::table('model_shooting', function (Blueprint $table) {
            $table->dropColumn('hash');
        });

        Schema::dropIfExists('model_photo');
    }
}
