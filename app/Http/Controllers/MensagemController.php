<?php

namespace App\Http\Controllers;

use App\Models\Mensagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MensagemController extends Controller
{
    // Listar todas as mensagens
    public function index()
    {
        $mensagens = Mensagem::all();
        return response()->json($mensagens);
    }

    // Mostrar uma mensagem específica
    public function show($id)
    {
        $mensagem = Mensagem::findOrFail($id);
        return response()->json($mensagem);
    }

    // Criar uma nova mensagem
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'conteudo' => 'required|string',
            'de_id' => 'required|exists:empresas,id',
            'para_id' => 'required|exists:usuarios,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $mensagem = Mensagem::create([
            'conteudo' => $request->conteudo,
            'de_id' => $request->de_id,
            'para_id' => $request->para_id,
        ]);

        return response()->json($mensagem, 201);
    }

    // Atualizar uma mensagem existente
    public function update(Request $request, $id)
    {
        $mensagem = Mensagem::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'conteudo' => 'required|string',
            'de_id' => 'required|exists:empresas,id',
            'para_id' => 'required|exists:usuarios,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $mensagem->update([
            'conteudo' => $request->conteudo,
            'de_id' => $request->de_id,
            'para_id' => $request->para_id,
        ]);

        return response()->json($mensagem, 200);
    }

    // Excluir uma mensagem existente
    public function destroy($id)
    {
        $mensagem = Mensagem::findOrFail($id);
        $mensagem->delete();
        return response()->json(null, 204);
    }
}
