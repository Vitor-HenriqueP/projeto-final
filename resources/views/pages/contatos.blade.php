<!-- resources/views/pages/contatos.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Contatos</h1>
    <a href="{{ route('contatos.create') }}" class="btn btn-primary mb-3">Adicionar Contato</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome Completo</th>
                <th>CPF</th>
                <th>Email</th>
                <th>Data de Nascimento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contatos as $contato)
                <tr>
                    <td>{{ $contato->id }}</td>
                    <td>{{ $contato->nome_completo }}</td>
                    <td>{{ $contato->cpf }}</td>
                    <td>{{ $contato->email }}</td>
                    <td>{{ $contato->data_nascimento }}</td>
                    <td>
                        <a href="{{ route('contatos.show', $contato->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('contatos.edit', $contato->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('contatos.destroy', $contato->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Deletar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
