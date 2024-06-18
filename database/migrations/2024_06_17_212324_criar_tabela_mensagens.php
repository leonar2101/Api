<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaMensagens extends Migration
{
    public function up()
    {
        Schema::create('mensagens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('remetente_id')->constrained('usuarios');
            $table->foreignId('destinatario_id')->constrained('empresas');
            $table->text('mensagem');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mensagens');
    }
}
