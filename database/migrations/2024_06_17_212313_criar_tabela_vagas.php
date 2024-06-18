<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaVagas extends Migration
{
    public function up()
    {
        Schema::create('vagas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas');
            $table->string('titulo');
            $table->text('descricao');
            $table->enum('status', ['aberta', 'fechada'])->default('aberta');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vagas');
    }
}
