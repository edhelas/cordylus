<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExclusiveShootings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->boolean('exclusive')->default(false);
        });

        Schema::table('shootings', function (Blueprint $table) {
            $table->string('exclusive_hash')->nullable();
        });

        foreach (\App\Shooting::all() as $shooting) {
            $shooting->exclusive_hash = str_random(8);
            $shooting->save();
        }

        Schema::table('shootings', function (Blueprint $table) {
            $table->string('exclusive_hash')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->dropColumn('exclusive');
        });

        Schema::table('shootings', function (Blueprint $table) {
            $table->dropColumn('exclusive_hash');
        });
    }
}
