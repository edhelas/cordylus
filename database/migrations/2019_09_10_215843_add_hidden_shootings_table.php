<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHiddenShootingsTable extends Migration
{
    public function up()
    {
        Schema::table('shootings', function (Blueprint $table) {
            $table->boolean('hidden')->default(false);
        });
    }

    public function down()
    {
        Schema::table('shootings', function (Blueprint $table) {
            $table->dropColumn('hidden');
        });
    }
}
