<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContatosTable extends Migration
{
    public function up()
    {
        Schema::create('contatos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_completo');
            $table->string('cpf')->unique();
            $table->string('email')->unique();
            $table->date('data_nascimento');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contatos');
    }
}
