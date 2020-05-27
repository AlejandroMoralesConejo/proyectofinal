<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('idJug');
            $table->string('nombreJ');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('pass');
            $table->rememberToken();
            $table->timestamps();
            $table->date('fec_nacimiento')->nullable();
            $table->string('posicion');
            $table->string('foto')->default('img/default.png');
            $table->boolean('perfil')->default(0);
            $table->string('api_key')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
