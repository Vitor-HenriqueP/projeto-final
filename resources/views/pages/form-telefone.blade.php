@extends('layouts.app')

@section('title', 'Agenda | Cadastro de telefone')

@section('content')
    <div class="container">
        <h1>Cadastro de telefone</h1>
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
            <form action="{{ route('telefones.store') }}" method="POST">
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
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Telefone Celular" name="telefone_celular" id="telefone_celular" required>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Telefone Comercial" name="telefone_comercial" id="telefone_comercial" required>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Telefone Residencial" name="telefone_residencial" id="telefone_residencial" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">Salvar Telefone</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#telefone_celular').mask('(00) 00000-0000');
            $('#telefone_comercial').mask('(00) 0000-0000');
            $('#telefone_residencial').mask('(00) 0000-0000');
        });

        document.getElementById('contato_id').addEventListener('change', function() {
            const contato_id = this.value;
            if (contato_id) {
                fetch(`/telefones/${contato_id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            document.getElementById('telefone_celular').value = data.telefone_celular;
                            document.getElementById('telefone_comercial').value = data.telefone_comercial;
                            document.getElementById('telefone_residencial').value = data.telefone_residencial;
                        } else {
                            document.getElementById('telefone_celular').value = '';
                            document.getElementById('telefone_comercial').value = '';
                            document.getElementById('telefone_residencial').value = '';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    </script>
@endsection
