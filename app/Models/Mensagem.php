<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    protected $fillable = [
        'remetente_id', 'destinatario_id', 'mensagem',
    ];

    // Relacionamento com usuário (remetente) e empresa (destinatário)
    public function remetente()
    {
        return $this->belongsTo(Usuario::class, 'remetente_id');
    }

    public function destinatario()
    {
        return $this->belongsTo(Empresa::class, 'destinatario_id');
    }
}

