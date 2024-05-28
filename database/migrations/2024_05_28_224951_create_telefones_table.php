<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelefonesTable extends Migration
{
    public function up()
    {
        Schema::create('telefones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contato_id');
            $table->string('telefone_comercial')->nullable();
            $table->string('telefone_residencial')->nullable();
            $table->string('telefone_celular')->nullable();
            $table->timestamps();

            $table->foreign('contato_id')->references('id')->on('contatos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('telefones');
    }
}
