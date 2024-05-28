<?php

namespace App\Http\Controllers;

use App\Models\Telefone;
use Illuminate\Http\Request;
use Exception;

class TelefoneController extends Controller
{
    public function obterTelefonesPorContato($contato_id)
    {
        try {
            $telefones = Telefone::where('contato_id', $contato_id)->first();

            if ($telefones) {
                return response()->json([
                    'telefone_comercial' => $telefones->telefone_comercial,
                    'telefone_residencial' => $telefones->telefone_residencial,
                    'telefone_celular' => $telefones->telefone_celular
                ], 200);
            } else {
                return response()->json(null, 404);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao obter telefones: ' . $e->getMessage()], 500);
        }
    }

    public function salvarOuAtualizarTelefone(Request $request, $contato_id)
    {
        try {
            $telefone = Telefone::where('contato_id', $contato_id)->first();

            if ($telefone) {
                $telefone->telefone_comercial = $request->telefone_comercial;
                $telefone->telefone_residencial = $request->telefone_residencial;
                $telefone->telefone_celular = $request->telefone_celular;
            } else {
                $telefone = new Telefone();
                $telefone->contato_id = $contato_id;
                $telefone->telefone_comercial = $request->telefone_comercial;
                $telefone->telefone_residencial = $request->telefone_residencial;
                $telefone->telefone_celular = $request->telefone_celular;
            }

            $telefone->save();

            return response()->json($telefone, 200);
        } catch (Exception $e) {
            if ($e->getCode() == 23000) {
                return response()->json(['error' => 'O telefone indicado já está cadastrado para outro contato!'], 409);
            } else {
                return response()->json(['error' => 'Erro ao salvar telefone: ' . $e->getMessage()], 500);
            }
        }
    }
}
