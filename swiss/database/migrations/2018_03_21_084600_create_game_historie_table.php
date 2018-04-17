<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameHistorieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_historie', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('playerOne');
            $table->integer('playerTwo');
            $table->integer('winner');
            $table->integer('tournament');
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
        Schema::dropIfExists('game_histories');
    }
}
