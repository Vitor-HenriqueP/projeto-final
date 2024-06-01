@extends('layouts.app')

@section('title', 'Agenda | Cadastro de contatos')

@section('content')
    <div class="container">
        <h1>Cadastro de Contatos</h1>
    </div>
    @if (session('mensagem_sucesso'))
        <div class="container">
            <div class="alert alert-success">
                <p style="color: green;">{{ session('mensagem_sucesso') }}</p>
            </div>
        </div>
    @endif
    <div class="container">
        <div class="form-container">
            <form action="{{ route('contatos.store') }}" method="POST">
                @csrf
                <div class="row form-group">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Nome Completo" name="nome_completo" id="nome_completo" required>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" placeholder="CPF" name="cpf" id="cpf" required>
                    </div>
                    <div class="col-sm-3">
                        <input type="email" class="form-control" placeholder="E-mail" name="email" id="email" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-6">
                        <input type="date" class="form-control" placeholder="Data de Nascimento" name="data_nascimento" id="data_nascimento" required>
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#cpf').mask('000.000.000-00');
        });
    </script>
@endsection
