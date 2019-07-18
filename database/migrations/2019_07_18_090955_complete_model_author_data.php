<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompleteModelAuthorData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('models', function (Blueprint $table) {
            $table->string('twitter')->nullable();
            $table->string('patreon')->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('twitter')->nullable();
            $table->string('patreon')->nullable();
            $table->string('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('models', function (Blueprint $table) {
            $table->dropColumn('twitter');
            $table->dropColumn('patreon');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('twitter');
            $table->dropColumn('patreon');
            $table->dropColumn('description');
        });
    }
}
