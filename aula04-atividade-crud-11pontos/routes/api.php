<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DistribuidoraController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/user', [UserController::class, 'store']);
Route::get('/user', [UserController::class, 'index']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);

Route::apiResource('distribuidoras', DistribuidoraController::class);
Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('produtos', ProdutoController::class);

