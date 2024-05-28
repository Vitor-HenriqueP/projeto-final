<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TelefoneController;
use App\Http\Controllers\EnderecoController;

Route::get('/telefones/{contato_id}', [TelefoneController::class, 'obterTelefonesPorContato']);
Route::post('/telefones/{contato_id}', [TelefoneController::class, 'salvarOuAtualizarTelefone']);

Route::get('/enderecos/{contato_id}', [EnderecoController::class, 'obterEnderecoPorContato']);
Route::post('/enderecos/{contato_id}', [EnderecoController::class, 'cadastrarEndereco']);
Route::put('/enderecos/{contato_id}', [EnderecoController::class, 'editarEndereco']);

