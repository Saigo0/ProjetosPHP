<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Models\Usuario;
use App\Models\Bibliotecario;

class BibliotecarioController extends Controller
{
    public function create()
    {
        return view('bibliotecarios.create');
    }

    public function store(Request $request)
        {
            $pessoa = Pessoa::create([
                'nome' => $request->nome,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'endereco' => $request->endereco,
            ]);

            $usuario = Usuario::create([
                'pessoa_id' => $pessoa->id,
                'nivelAcesso' => 'Bibliotecario',
                'login' => $request->input('login'),
                'senha' => bcrypt($request->input('senha')),
            ]);

            $bibliotecario = Bibliotecario::create([
                'usuario_id' => $usuario->id,
                'registroCRB' => $request->registroCRB,
                'valorCRB' => $request->valorCRB,
            ]);

            return redirect()->route('bibliotecarios-index');
    }

    public function edit($id)
    {
        $bibliotecarios = Bibliotecario::with('usuario.pessoa')->where('id', $id)->first();
        if (!empty($bibliotecarios)) {
            return view('bibliotecarios.edit', ['bibliotecarios' => $bibliotecarios]);
        } else {
            return redirect()->route('bibliotecarios-index');
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
        $bibliotecario = Bibliotecario::find($id);

        $usuario = $bibliotecario->usuario;

        $pessoa = $usuario->pessoa;


        $pessoa->update([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'endereco' => $request->endereco,
        ]);

        $bibliotecario->update([
            'pendente' => $request->input('pendente', $bibliotecario->pendente),
        ]);

        return redirect()->route('bibliotecarios-index')->with('success', 'Bibliotecario atualizado com sucesso');
    }

    public function destroy($id)
    {
        $bibliotecario = Bibliotecario::find($id);
        $usuario = $bibliotecario->usuario;
        $pessoa = $usuario->pessoa;
        if (!$pessoa) {
            return response()->json(['message' => 'Pessoa não encontrada'], 404);
        }

        $pessoa->delete();

        return redirect()->route('bibliotecarios-index')->with('success', 'Bibliotecario deletado com sucesso');
    }

    public function index()
    {
        $bibliotecarios = Bibliotecario::with('usuario.pessoa')->get();
        return view('bibliotecarios.index', compact('bibliotecarios'));
    } 
}