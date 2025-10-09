<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;

class LivroController extends Controller
{
    public function index()
    {
        $livros = Livro::all();
        return response()->json($livros);
    }

    public function show($id)
    {
        $livro = Livro::find($id);
        if ($livro) {
            return response()->json($livro);
        } else {
            return redirect()->route('livros-index');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'isbn' => 'required|string|max:13|unique:livros,isbn',
            'anoEdicao' => 'required|integer',
            'editora' => 'required|string|max:255',
            'numPaginas' => 'required|integer',
            'localEdicao' => 'required|string|max:255',
        ]);

        $livro = Livro::create($request->all());
        return redirect()->route('livros-index');
    }

    public function update(Request $request, $id)
    {
        $livro = Livro::find($id);
        if (!$livro) {
            return response()->json(['message' => 'Livro não encontrado'], 404);
        }

        $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'autor' => 'sometimes|required|string|max:255',
            'isbn' => "sometimes|required|string|max:13|unique:livros,isbn,$id",
            'anoEdicao' => 'sometimes|required|integer',
            'editora' => 'sometimes|required|string|max:255',
            'numPaginas' => 'sometimes|required|integer',
            'localEdicao' => 'sometimes|required|string|max:255',
        ]);

        $livro->update($request->all());
        return redirect()->route('livros-index');
    }

    public function destroy($id)
    {
        $livro = Livro::find($id);
        if (!$livro) {
            return response()->json(['message' => 'Livro não encontrado'], 404);
        }

        $livro->delete();
        return redirect()->route('livros-index');
    }    
}