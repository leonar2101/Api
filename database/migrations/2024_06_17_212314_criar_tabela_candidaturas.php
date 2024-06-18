<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaCandidaturas extends Migration
{
    public function up()
    {
        Schema::create('candidaturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vaga_id')->constrained('vagas');
            $table->foreignId('usuario_id')->constrained('usuarios');
            $table->text('mensagem')->nullable();
            $table->enum('status', ['enviada', 'aceita', 'recusada'])->default('enviada');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('candidaturas');
    }
}
