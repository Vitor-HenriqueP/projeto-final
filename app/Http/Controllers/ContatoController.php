<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use App\Models\Endereco;
use App\Models\Telefone;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    // Listar todos os contatos
    public function index()
    {
        $contatos = Contato::all();
        return view('pages.contatos', compact('contatos'));
    }

    // Mostrar um único contato
    public function show($id)
    {
        $contato = Contato::findOrFail($id);
        $endereco = Endereco::where('contato_id', $id)->first();
        $telefones = Telefone::where('contato_id', $id)->first();

        return view('pages/exibir_contatos', compact('contato', 'endereco', 'telefones'));
    }

    // Exibir o formulário para criar um novo contato
    public function create()
    {
        return view('pages.form-contato');
    }

    // Armazenar um novo contato no banco de dados
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome_completo' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:contatos',
            'email' => 'required|string|email|max:255|unique:contatos',
            'data_nascimento' => 'required|date',
        ]);

        Contato::create($validatedData);

        return redirect()->route('contatos.index')->with('success', 'Contato criado com sucesso!');
    }

    // Exibir o formulário para editar um contato existente
    public function edit($id)
    {
        $contato = Contato::find($id);
        return view('pages.form-contato', compact('contato'));
    }

    // Atualizar um contato existente no banco de dados
    public function update(Request $request, $id)
    {
        $contato = Contato::find($id);

        if ($contato) {
            $validatedData = $request->validate([
                'nome_completo' => 'sometimes|string|max:255',
                'cpf' => 'sometimes|string|max:14|unique:contatos,cpf,'.$contato->id,
                'email' => 'sometimes|string|email|max:255|unique:contatos,email,'.$contato->id,
                'data_nascimento' => 'sometimes|date',
            ]);

            $contato->update($validatedData);
            return redirect()->route('contatos.index')->with('success', 'Contato atualizado com sucesso!');
        }

        return redirect()->route('contatos.index')->with('error', 'Contato não encontrado');
    }

    // Deletar um contato
    public function destroy($id)
    {
        $contato = Contato::find($id);

        if ($contato) {
            $contato->delete();
            return redirect()->route('contatos.index')->with('success', 'Contato deletado com sucesso!');
        }

        return redirect()->route('contatos.index')->with('error', 'Contato não encontrado');
    }
}
