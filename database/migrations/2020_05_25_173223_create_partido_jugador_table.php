<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartidoJugadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partido_jugador', function (Blueprint $table) {
            $table->unsignedInteger('idPartido');
            $table->unsignedInteger('idJug');
        });

        Schema::table('partido_jugador', function (Blueprint $table) {
            $table->foreign('idPartido')->references('idPartido')
                ->on('partido')
                ->onDelete('cascade');

            // $table->foreign('idJug')->references('idJug')
            //     ->on('jugador')
            //     ->onDelete('cascade');

            $table->foreign('idJug')->references('idJug')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partido_jugador');
    }
}
