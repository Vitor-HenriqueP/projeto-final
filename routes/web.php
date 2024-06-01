<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelefoneController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\ContatoController;

// Rotas para Telefones
Route::get('/telefones/create', [TelefoneController::class, 'create'])->name('telefones.create');
Route::post('/telefones', [TelefoneController::class, 'store'])->name('telefones.store');

// Rotas para Endereços
Route::get('/enderecos/create', [EnderecoController::class, 'create'])->name('enderecos.create');
Route::post('/enderecos', [EnderecoController::class, 'store'])->name('enderecos.store');

// Rotas para Contatos
Route::get('/contatos', [ContatoController::class, 'index'])->name('contatos.index');
Route::get('/contatos/create', [ContatoController::class, 'create'])->name('contatos.create');
Route::post('/contatos', [ContatoController::class, 'store'])->name('contatos.store');
Route::get('/contatos/{id}', [ContatoController::class, 'show'])->name('contatos.show');
Route::get('/contatos/{id}/edit', [ContatoController::class, 'edit'])->name('contatos.edit');
Route::put('/contatos/{id}', [ContatoController::class, 'update'])->name('contatos.update');
Route::delete('/contatos/{id}', [ContatoController::class, 'destroy'])->name('contatos.destroy');
