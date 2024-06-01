<?php

namespace App\Http\Controllers;

use App\Models\Telefone;
use App\Models\Contato;
use Illuminate\Http\Request;
use Exception;

class TelefoneController extends Controller
{   
    public function create()
    {
        $contatos = Contato::all();
        return view('pages.form-telefone', compact('contatos'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'contato_id' => 'required|exists:contatos,id',
                'telefone_comercial' => 'nullable|string|max:20',
                'telefone_residencial' => 'nullable|string|max:20',
                'telefone_celular' => 'nullable|string|max:20',
            ]);

            $telefone = Telefone::create($validatedData);

            return redirect()->route('contatos.show', $telefone->contato_id)->with('success', 'Telefone criado com sucesso!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao cadastrar telefone: ' . $e->getMessage());
        }
        return redirect()->route('telefones.create')->with('success', 'Telefone criado com sucesso!');
    }
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
