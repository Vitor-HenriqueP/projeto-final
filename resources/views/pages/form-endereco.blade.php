@extends('layouts.app')

@section('title', 'Agenda | Cadastro de endereço')

@section('content')
    <div class="container">
        <h1>Cadastro de endereço</h1>
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
            <form action="{{ route('enderecos.store') }}" method="POST">
                @csrf
                <div class="row form-group">
                    <div class="col-sm-6">
                        <select class="form-control" name="contato_id" id="contato_id" required>
                            <option value="">Selecione um contato</option>
                            @foreach ($contatos as $contato)
                                <option value="{{ $contato->id }}">{{ $contato->nome_completo }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-3">
                            <input type="text" class="form-control" placeholder="CEP" name="cep" id="cep" required>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder="Rua" name="endereco" id="endereco" required>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" placeholder="Número" name="numero_residencia" id="numero_residencia" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder="Bairro" name="bairro" id="bairro" required>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Cidade" name="cidade" id="cidade" required>
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="uf" id="uf" required>
                                <option value="">Selecione um estado</option>
                                <!-- Add options for states here -->
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">Salvar Endereço</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#cep').mask('00000-000');
        });

        document.getElementById('contato_id').addEventListener('change', function() {
            const contato_id = this.value;
            if (contato_id) {
                fetch(`/enderecos/${contato_id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            document.getElementById('cep').value = data.cep;
                            document.getElementById('endereco').value = data.endereco;
                            document.getElementById('numero_residencia').value = data.numero_residencia;
                            document.getElementById('bairro').value = data.bairro;
                            document.getElementById('cidade').value = data.cidade;
                            document.getElementById('uf').value = data.uf;
                        } else {
                            document.getElementById('cep').value = '';
                            document.getElementById('endereco').value = '';
                            document.getElementById('numero_residencia').value = '';
                            document.getElementById('bairro').value = '';
                            document.getElementById('cidade').value = '';
                            document.getElementById('uf').value = '';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    </script>
@endsection
