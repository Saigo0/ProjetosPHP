<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;

class LivroController extends Controller
{
    public function create()
    {
        return view('livros.create');
    }

    public function store(Request $request)
        {
            $livro = Livro::create([
                'titulo' => $request->titulo,
                'isbn' => $request->isbn,
                'autor' => $request->autor,
                'editora' => $request->editora,
                'anoEdicao' => $request->anoEdicao,
                'localEdicao' => $request->localEdicao,
                'numPaginas' => $request->numPaginas,
            ]);

            return redirect()->route('livros-index')->with('success', 'Livro criado com sucesso');
    }

    public function edit($id)
    {
        $livros = Livro::where('id', $id)->first();
        if (!empty($livros)) {
            return view('livros.edit', ['livros' => $livros]);
        } else {
            return redirect()->route('livros-index');
        }
    }

    public function show($id)
    {
        $livro = Livro::find($id);
        if ($livro) {
            return response()->json($livro);
        } else {
            return response()->json(['message' => 'livro não encontrada'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $livro = Livro::find($id);

        $livro->update([
            'titulo' => $request->input('titulo', $livro->titulo),
            'isbn' => $request->input('isbn', $livro->isbn),
            'autor' => $request->input('autor', $livro->autor),
            'editora' => $request->input('editora', $livro->editora),
            'anoEdicao' => $request->input('anoEdicao', $livro->anoEdicao),
            'localEdicao' => $request->input('localEdicao', $livro->localEdicao),
            'numPaginas' => $request->input('numPaginas', $livro->numPaginas),
        ]);

        return redirect()->route('livros-index')->with('success', 'Livro atualizado com sucesso');
    }

    public function destroy($id)
    {
        $livro = Livro::find($id);
        if (!$livro) {
            return response()->json(['message' => 'livro não encontrado'], 404);
        }

        $livro->delete();

        return redirect()->route('livros-index')->with('success', 'Livro deletado com sucesso');
    }

    public function index()
    {
        $livros = Livro::get();
        return view('livros.index', compact('livros'));
    }    
}