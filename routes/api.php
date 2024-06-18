<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\VagaController;
use App\Http\Controllers\CandidaturaController;
use App\Http\Controllers\MensagemController;

// Rotas de autenticação
Route::post('/usuario-cadastro', [AuthController::class, 'registrarUsuario']);
Route::post('/usuario-login', [AuthController::class, 'loginUsuario']);
Route::post('/usuario-logout', [AuthController::class, 'logoutUsuario']);
Route::post('/empresa-cadastro', [AuthController::class, 'registrarEmpresa']);
Route::post('/empresa-login', [AuthController::class, 'loginEmpresa']);
Route::post('/empresa-logout', [AuthController::class, 'logoutEmpresa']);

// Rotas que exigem autenticação Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Rotas para usuários
    Route::get('/usuarios', [UsuarioController::class, 'index']);
    Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update']);
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);

    // Rotas para empresas
    Route::get('/empresas', [EmpresaController::class, 'index']);
    Route::get('/empresas/{id}', [EmpresaController::class, 'show']);
    Route::put('/empresas/{id}', [EmpresaController::class, 'update']);
    Route::delete('/empresas/{id}', [EmpresaController::class, 'destroy']);

    // Rotas para vagas
    Route::get('/vagas', [VagaController::class, 'index']);
    Route::get('/vagas/{id}', [VagaController::class, 'show']);
    Route::post('/vagas', [VagaController::class, 'store']);
    Route::put('/vagas/{id}', [VagaController::class, 'update']);
    Route::delete('/vagas/{id}', [VagaController::class, 'destroy']);

    // Rotas para candidaturas
    Route::post('/candidaturas', [CandidaturaController::class, 'store']);

    // Rotas para mensagens
    Route::post('/mensagens', [MensagemController::class, 'store']);
});

// Rotas públicas
Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);
Route::post('/usuarios', [UsuarioController::class, 'store']);

Route::get('/empresas', [EmpresaController::class, 'index']);
Route::get('/empresas/{id}', [EmpresaController::class, 'show']);
Route::post('/empresas', [EmpresaController::class, 'store']);

Route::get('/vagas', [VagaController::class, 'index']);
Route::get('/vagas/{id}', [VagaController::class, 'show']);

Route::get('/mensagens', [MensagemController::class, 'index']);
Route::get('/mensagens/{id}', [MensagemController::class, 'show']);

