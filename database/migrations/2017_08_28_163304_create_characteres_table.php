<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacteresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characteres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pseudo')->unique();
            $table->boolean('sexe');
            $table->string('photo', 300);
            $table->string('activity', 50);
            $table->date('birth_date');
            $table->float('latitude', 10, 7);
            $table->float('longitude', 10, 7);
            $table->string('state', 50);
            $table->text('resume');
            $table->string('saison');
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
        Schema::dropIfExists('characteres');
    }
}
