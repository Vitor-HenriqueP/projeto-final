<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecosTable extends Migration
{
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contato_id');
            $table->string('cep');
            $table->string('endereco');
            $table->string('numero_residencia');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('uf');
            $table->timestamps();

            $table->foreign('contato_id')->references('id')->on('contatos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('enderecos');
    }
}
