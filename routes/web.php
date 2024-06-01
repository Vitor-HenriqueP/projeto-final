<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelefoneController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\ContatoController;

Route::get('/telefones/{contato_id}', [TelefoneController::class, 'obterTelefonesPorContato']);
Route::post('/telefones/{contato_id}', [TelefoneController::class, 'salvarOuAtualizarTelefone']);
Route::get('/telefones/create', [TelefoneController::class, 'create'])->name('telefones.create');
Route::post('/telefones', [TelefoneController::class, 'store'])->name('telefones.store');

Route::get('/enderecos/{contato_id}', [EnderecoController::class, 'obterEnderecoPorContato']);
Route::post('/enderecos/{contato_id}', [EnderecoController::class, 'cadastrarEndereco']);
Route::put('/enderecos/{contato_id}', [EnderecoController::class, 'editarEndereco']);
Route::get('/enderecos/create', [EnderecoController::class, 'create'])->name('enderecos.create');
Route::post('/enderecos', [EnderecoController::class, 'store'])->name('enderecos.store');

Route::get('/contatos', [ContatoController::class, 'index'])->name('contatos.index');
Route::get('/contatos/create', [ContatoController::class, 'create'])->name('contatos.create');
Route::post('/contatos', [ContatoController::class, 'store'])->name('contatos.store');
Route::get('/contatos/{id}', [ContatoController::class, 'show'])->name('contatos.show');
Route::get('/contatos/{id}/edit', [ContatoController::class, 'edit'])->name('contatos.edit');
Route::put('/contatos/{id}', [ContatoController::class, 'update'])->name('contatos.update');
Route::delete('/contatos/{id}', [ContatoController::class, 'destroy'])->name('contatos.destroy');
