<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_usuarios_cadastrou');
            $table->foreign('id_usuarios_cadastrou')->references('id')->on('user');
            $table->unsignedBigInteger('id_usuarios_atualizou');
            $table->foreign('id_usuarios_atualizou')->references('id')->on('user');
            $table->date('data_nascimento');
            $table->timestamps();
            $table->softDeletes();
            $table->string('nome', 255);
            $table->string('cpf', 20);
            $table->string('rg', 20);
            $table->string('local_nascimento', 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('client');
    }
}
