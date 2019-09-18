<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Shooting;

class AddPositionPhotosTable extends Migration
{
    public function up()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->integer('position')->default(0);
        });

        foreach (Shooting::all() as $shooting) {
            $i = 0;
            foreach ($shooting->photos as $photo) {
                $photo->position = $i;
                $photo->save();
                $i++;
            }
        }
    }

    public function down()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->dropColumn('position');
        });
    }
}
