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
                'email' => $request->email,
                'telefone' => $request->telefone,
                'endereco' => $request->endereco,
            ]);

            $usuario = Usuario::create([
                'pessoa_id' => $pessoa->id,
                'nivelAcesso' => 'LEITOR',
                'login' => $request->input('login'),
                'senha' => bcrypt($request->input('senha')),
            ]);

            $leitor = Leitor::create([
                'usuario_id' => $usuario->id,
                'pendente' => false,
            ]);

            return redirect()->route('leitores-index');
    }

    public function edit($id)
    {
        $leitores = Leitor::with('usuario.pessoa')->where('id', $id)->first();
        if (!empty($leitores)) {
            return view('leitores.edit', ['leitores' => $leitores]);
        } else {
            return redirect()->route('leitores-index');
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
        $leitor = Leitor::find($id);

        $usuario = $leitor->usuario;

        $pessoa = $usuario->pessoa;


        $pessoa->update([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'endereco' => $request->endereco,
        ]);

        $leitor->update([
            'pendente' => $request->input('pendente', $leitor->pendente),
        ]);

        return redirect()->route('leitores-index')->with('success', 'Leitor atualizado com sucesso');
    }

    public function destroy($id)
    {
        $leitor = Leitor::find($id);
        $usuario = $leitor->usuario;
        $pessoa = $usuario->pessoa;
        if (!$pessoa) {
            return response()->json(['message' => 'Pessoa não encontrada'], 404);
        }

        $pessoa->delete();

        return redirect()->route('leitores-index')->with('success', 'Leitor deletado com sucesso');
    }

    public function index()
    {
        $leitores = Leitor::with('usuario.pessoa')->get();
        return view('leitores.index', compact('leitores'));
    }    
}