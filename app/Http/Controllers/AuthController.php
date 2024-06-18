<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Empresa;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Registro de usuário
    public function registrarUsuario(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'senha' => 'required|string|min:6|confirmed',
        ]);

        $usuario = Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => Hash::make($request->senha),
        ]);

        $token = $usuario->createToken('Token de Acesso')->plainTextToken;

        return response()->json(['usuario' => $usuario, 'token' => $token], 201);
    }

    // Login de usuário
    public function loginUsuario(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'senha' => 'required|string',
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->senha, $usuario->senha)) {
            throw ValidationException::withMessages([
                'email' => ['Credenciais inválidas.'],
            ]);
        }

        $token = $usuario->createToken('Token de Acesso')->plainTextToken;

        return response()->json(['usuario' => $usuario, 'token' => $token], 200);
    }

    // Logout de usuário
    public function logoutUsuario(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['mensagem' => 'Logout realizado com sucesso'], 200);
    }

    // Registro de empresa
    public function registrarEmpresa(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|unique:empresas|max:255',
            'senha' => 'required|string|min:6|confirmed',
        ]);

        $empresa = Empresa::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => Hash::make($request->senha),
        ]);

        $token = $empresa->createToken('Token de Acesso')->plainTextToken;

        return response()->json(['empresa' => $empresa, 'token' => $token], 201);
    }

    // Login de empresa
    public function loginEmpresa(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'senha' => 'required|string',
        ]);

        $empresa = Empresa::where('email', $request->email)->first();

        if (!$empresa || !Hash::check($request->senha, $empresa->senha)) {
            throw ValidationException::withMessages([
                'email' => ['Credenciais inválidas.'],
            ]);
        }

        $token = $empresa->createToken('Token de Acesso')->plainTextToken;

        return response()->json(['empresa' => $empresa, 'token' => $token], 200);
    }

    // Logout de empresa
    public function logoutEmpresa(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['mensagem' => 'Logout realizado com sucesso'], 200);
    }
}
