<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\MatriculaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('cursos', CursoController::class);
Route::apiResource('alunos', AlunoController::class);

// Rotas personalizadas
Route::prefix('alunos')->group(function () {
    Route::get('/buscar/nome', [AlunoController::class, 'buscarPorNome']);
    Route::get('/buscar/email', [AlunoController::class, 'buscarPorEmail']);
});


Route::apiResource('matriculas', MatriculaController::class);

