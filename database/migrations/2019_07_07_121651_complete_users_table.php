<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompleteUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('slug')->nullable();
            $table->string('instagram')->nullable();
            $table->string('website')->nullable();
        });

        foreach (\App\User::all() as $user) {
            $user->slug = $user->id;
            $user->save();
        }

        Schema::table('users', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->unique()->change();
        });

        Schema::table('shootings', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
        });

        $user = \App\User::first();

        foreach (\App\Shooting::all() as $shooting) {
            $shooting->user_id = $user->id;
            $shooting->save();
        }

        Schema::table('shootings', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            $table->foreign('user_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('instagram');
            $table->dropColumn('website');
        });

        Schema::table('shootings', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
