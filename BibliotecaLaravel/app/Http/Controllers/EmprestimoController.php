<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Models\Livro;
use Illuminate\Http\Request;
use App\Http\Controllers\LeitorController;
use App\Models\Pessoa;
use App\Http\Controllers\BibliotecarioController;
use App\Models\Bibliotecario;
use App\Models\Emprestimo;


class EmprestimoController extends Controller
{
    public function index()
    {
        $emprestimos = Emprestimo::all();
        return response()->json($emprestimos);
    }

    public function show($id)
    {
        $emprestimo = Emprestimo::find($id);
        if ($emprestimo) {
            return response()->json($emprestimo);
        } else {
            return response()->json(['message' => 'Empréstimo não encontrado'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'livro_id' => 'required|exists:livros,id',
            'leitor_id' => 'required|exists:pessoas,id',
            'data_emprestimo' => 'required|date',
            'data_devolucao' => 'nullable|date|after_or_equal:data_emprestimo',
        ]);
        $emprestimo = Emprestimo::create($request->all());
        return response()->json($emprestimo, 201);
    }

    public function update(Request $request, $id)
    {
        $emprestimo = Emprestimo::find($id);
        if (!$emprestimo) {
            return response()->json(['message' => 'Empréstimo não encontrado'], 404);
        }

        $request->validate([
            'livro_id' => 'sometimes|required|exists:livros,id',
            'leitor_id' => 'sometimes|required|exists:pessoas,id',
            'data_emprestimo' => 'sometimes|required|date',
            'data_devolucao' => 'nullable|date|after_or_equal:data_emprestimo',
        ]);

        $emprestimo->update($request->all());
        return response()->json($emprestimo);
    }

    public function destroy($id)
    {
        $emprestimo = Emprestimo::find($id);
        if (!$emprestimo) {
            return response()->json(['message' => 'Empréstimo não encontrado'], 404);
        }

        $emprestimo->delete();
        return redirect()->route('emprestimos-index');
        return response()->json(['message' => 'Empréstimo deletado com sucesso']);
    }
}