<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Models\Livro;
use Illuminate\Http\Request;
use App\Http\Controllers\LeitorController;
use App\Models\Pessoa;
use App\Models\Usuario;
use App\Models\Leitor;
use App\Http\Controllers\BibliotecarioController;
use App\Models\Bibliotecario;
use App\Models\Emprestimo;


class EmprestimoController extends Controller
{
    public function create()
    {
        $livros = Livro::disponiveis()->get();

        $leitores = Leitor::where('pendente', 0)->get();

        return view('emprestimos.create', compact('livros', 'leitores'));
    }

    public function store(Request $request)
    {
        $emprestimo = Emprestimo::create([
            'leitor_id' => $request->leitor_id,
            'dataEmprestimo' => now(),
            'dataDevolucao' => null,
            'status' => 'Em andamento',
        ])->load('leitor.usuario.pessoa');

        $emprestimo->leitor->update(['pendente' => true]);
        
        $emprestimo->livros()->attach($request->id_livro);

        return redirect()->route('emprestimos-index')->with('success', 'Empréstimo registrado com sucesso');
    }

    public function edit($id)
    {
        $emprestimos = Emprestimo::with('leitor.usuario.pessoa')->where('id', $id)->first();
        if (!empty($emprestimos)) {
            return view('emprestimos.edit', ['emprestimos' => $emprestimos]);
        } else {
            return redirect()->route('emprestimos-index');
        }
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
        $emprestimo = Emprestimo::find($id);

        $emprestimo->update($request->all());

        return redirect()->route('leitores-index')->with('success', 'Leitor atualizado com sucesso');
    }

    public function destroy($id)
    {
        $emprestimo = Emprestimo::find($id);
        if (!$emprestimo) {
            return redirect()->route('emprestimos-index')->with('error', 'Empréstimo não encontrado');
        }

        $emprestimo->delete();

        return redirect()->route('emprestimos-index')->with('success', 'Empréstimo deletado com sucesso');
    }

    public function index()
    {
        $emprestimos = Emprestimo::with('leitor.usuario.pessoa')->get();
        return view('emprestimos.index', compact('emprestimos'));
    }

    public function devolver($id)
    {
        $emprestimo = Emprestimo::find($id);

        if (!$emprestimo) {
            return redirect()->route('emprestimos-index')->with('error', 'Empréstimo não encontrado');
        }

        $emprestimo->update([
            'dataDevolucao' => now(),
            'status' => 'Concluído',
        ]);

        $emprestimo->leitor->update(['pendente' => false]);

        return redirect()->route('emprestimos-index')->with('success', 'Empréstimo devolvido com sucesso');
    }
}