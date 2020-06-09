<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partido', function (Blueprint $table) {
            $table->increments('idPartido');
            $table->unsignedInteger('idPista');
            $table->string('nombre');
            $table->date('fecha');
            $table->timestamps();
            $table->time('hora');
            $table->integer('limite')->default(0);
        });

        Schema::table('partido', function (Blueprint $table) {
            $table->foreign('idPista')->references('idPista')
                ->on('pista')
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
        Schema::dropIfExists('partido');
    }
}
