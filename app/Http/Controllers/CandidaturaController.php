<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidatura;

class CandidaturaController extends Controller
{
    // Retorna todas as candidaturas cadastradas
    public function index()
    {
        $candidaturas = Candidatura::all();
        return response()->json(['data' => $candidaturas], 200);
    }

    //Retorna os detalhes de uma candidatura específica
    public function show($id)
    {
        $candidatura = Candidatura::find($id);
        if (!$candidatura) {
            return response()->json(['message' => 'Candidatura não encontrada'], 404);
        }
        return response()->json(['data' => $candidatura], 200);
    }

    // Cria uma nova candidatura
    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|integer',
            'vaga_id' => 'required|integer',
            'mensagem' => 'nullable|string',
        ]);

        $candidatura = Candidatura::create([
            'usuario_id' => $request->usuario_id,
            'vaga_id' => $request->vaga_id,
            'mensagem' => $request->mensagem,
        ]);

        return response()->json(['data' => $candidatura], 201);
    }

    // Atualiza os detalhes de uma candidatura existente
    public function update(Request $request, $id)
    {
        $candidatura = Candidatura::find($id);
        if (!$candidatura) {
            return response()->json(['message' => 'Candidatura não encontrada'], 404);
        }

        $request->validate([
            'mensagem' => 'nullable|string',
        ]);

        $candidatura->mensagem = $request->mensagem;
        $candidatura->save();

        return response()->json(['data' => $candidatura], 200);
    }

    // Remove uma candidatura existente
    public function destroy($id)
    {
        $candidatura = Candidatura::find($id);
        if (!$candidatura) {
            return response()->json(['message' => 'Candidatura não encontrada'], 404);
        }

        $candidatura->delete();

        return response()->json(['message' => 'Candidatura removida com sucesso'], 204);
    }
}

