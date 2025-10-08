<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;

class LeitorController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:pessoas,email',
            'telefone' => 'nullable|string|max:15',
            'endereco' => 'nullable|string|max:255',
        ]);

        $pessoa = Pessoa::create($data);

        return response()->json(['message' => 'Pessoa criada com sucesso', 'pessoa' => $pessoa], 201);
    }

    public function show($id)
    {
        $pessoa = Pessoa::find($id);
        if ($pessoa) {
            return response()->json($pessoa);
        } else {
            return response()->json(['message' => 'Pessoa não encontrada'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $pessoa = Pessoa::find($id);
        if (!$pessoa) {
            return response()->json(['message' => 'Pessoa não encontrada'], 404);
        }

        $data = $request->validate([
            'nome' => 'sometimes|required|string|max:100',
            'email' => "sometimes|required|email|max:100|unique:pessoas,email,$id",
            'telefone' => 'nullable|string|max:15',
            'endereco' => 'nullable|string|max:255',
        ]);

        $pessoa->update($data);

        return response()->json(['message' => 'Pessoa atualizada com sucesso', 'pessoa' => $pessoa]);
    }

    public function delete($id)
    {
        $pessoa = Pessoa::find($id);
        if (!$pessoa) {
            return response()->json(['message' => 'Pessoa não encontrada'], 404);
        }

        $pessoa->delete();

        return response()->json(['message' => 'Pessoa deletada com sucesso']);
    }

    public function index()
    {
        $pessoas = Pessoa::all();
        return response()->json($pessoas);
    } 
}