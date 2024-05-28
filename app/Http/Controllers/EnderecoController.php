<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;
use Exception;

class EnderecoController extends Controller
{
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
