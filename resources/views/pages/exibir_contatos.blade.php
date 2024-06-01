@extends('layouts.app')

@section('title', 'Agenda | Detalhes do contato')

@section('content')
    <div class="container">
        <h1>Detalhes do Contato</h1>
    </div>
    <div class="container">
        <div class="data-container">
            <h2>Informações do Contato</h2>
            <p><strong>Nome Completo:</strong> {{ $contato->nome_completo }}</p>
            <p><strong>CPF:</strong> {{ $contato->cpf }}</p>
            <p><strong>Email:</strong> {{ $contato->email }}</p>
            <p><strong>Data de Nascimento:</strong> 
                {{ \Carbon\Carbon::parse($contato->data_nascimento)->format('d/m/Y') }}
            </p>

            <h2>Endereço</h2>
            @if ($endereco)
                <p><strong>CEP:</strong> {{ $endereco->cep }}</p>
                <p><strong>Endereço:</strong> {{ $endereco->endereco }}</p>
                <p><strong>Número Residencial:</strong> {{ $endereco->numero_residencia }}</p>
                <p><strong>Bairro:</strong> {{ $endereco->bairro }}</p>
                <p><strong>Cidade:</strong> {{ $endereco->cidade }}</p>
                <p><strong>UF:</strong> {{ $endereco->uf }}</p>
            @else
                <p>Nenhum endereço cadastrado para este contato.</p>
            @endif

            <h2>Telefones</h2>
            @if ($telefones)
                <ul>
                    <li>
                        <p><strong>Telefone Celular:</strong> {{ $telefones->telefone_celular ?? 'Nenhum telefone celular cadastrado' }}</p>
                    </li>
                    <li>
                        <p><strong>Telefone Comercial:</strong> {{ $telefones->telefone_comercial ?? 'Nenhum telefone comercial cadastrado' }}</p>
                    </li>
                    <li>
                        <p><strong>Telefone Residencial:</strong> {{ $telefones->telefone_residencial ?? 'Nenhum telefone residencial cadastrado' }}</p>
                    </li>
                </ul>
            @else
                <p>Nenhum telefone cadastrado para este contato.</p>
            @endif
            <a href="{{ route('contatos.index') }}"><button>Voltar</button></a>
        </div>
    </div>
@endsection
