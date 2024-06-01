<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Contato;
use Illuminate\Http\Request;
use Exception;

class EnderecoController extends Controller
{
    public function create()
    {
        $contatos = Contato::all();

        return view('pages.form-endereco', compact('contatos'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'contato_id' => 'required|exists:contatos,id',
                'cep' => 'required|string|max:10',
                'endereco' => 'required|string|max:255',
                'numero_residencia' => 'required|string|max:10',
                'bairro' => 'required|string|max:100',
                'cidade' => 'required|string|max:100',
                'uf' => 'required|string|max:2',
            ]);

            $endereco = Endereco::create($validatedData);

            return redirect()->route('contatos.show', $endereco->contato_id)->with('success', 'Endereço criado com sucesso!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao cadastrar endereço: ' . $e->getMessage());
        }
        return redirect()->route('enderecos.create')->with('success', 'Endereço criado com sucesso!');
    }
    public function obterEnderecoPorContato($contato_id)
    {
        try {
            $endereco = Endereco::where('contato_id', $contato_id)->first();

            if ($endereco) {
                return response()->json($endereco, 200);
            } else {
                return response()->json(null, 404);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao obter endereço: ' . $e->getMessage()], 500);
        }
    }

    public function cadastrarEndereco(Request $request, $contato_id)
    {
        try {
            $endereco = new Endereco();
            $endereco->contato_id = $contato_id;
            $endereco->cep = $request->cep;
            $endereco->endereco = $request->endereco;
            $endereco->numero_residencia = $request->numero_residencia;
            $endereco->bairro = $request->bairro;
            $endereco->cidade = $request->cidade;
            $endereco->uf = $request->uf;

            $endereco->save();

            return response()->json($endereco, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao cadastrar endereço: ' . $e->getMessage()], 500);
        }
    }

    public function editarEndereco(Request $request, $contato_id)
    {
        try {
            $endereco = Endereco::where('contato_id', $contato_id)->first();

            if ($endereco) {
                $endereco->cep = $request->cep;
                $endereco->endereco = $request->endereco;
                $endereco->numero_residencia = $request->numero_residencia;
                $endereco->bairro = $request->bairro;
                $endereco->cidade = $request->cidade;
                $endereco->uf = $request->uf;

                $endereco->save();

                return response()->json($endereco, 200);
            } else {
                return response()->json(['error' => 'Endereço não encontrado'], 404);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao editar endereço: ' . $e->getMessage()], 500);
        }
    }
}
