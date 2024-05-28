<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function index()
    {
        return Contato::all();
    }

    public function show($id)
    {
        return Contato::find($id);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome_completo' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:contatos',
            'email' => 'required|string|email|max:255|unique:contatos',
            'data_nascimento' => 'required|date',
        ]);

        return Contato::create($validatedData);
    }

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
            return $contato;
        }

        return response()->json(['message' => 'Contato não encontrado'], 404);
    }

    public function destroy($id)
    {
        $contato = Contato::find($id);

        if ($contato) {
            $contato->delete();
            return response()->json(['message' => 'Contato deletado com sucesso']);
        }

        return response()->json(['message' => 'Contato não encontrado'], 404);
    }
}
