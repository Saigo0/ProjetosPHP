<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Administrador;
use App\Models\Usuario;
use App\Models\Pessoa;

class AdministradorController extends Controller
{
    public function index()
    {
        $administradores = Administrador::with('usuario.pessoa')->get();
        return view('administradores.index', compact('administradores'));
    }

    public function create()
    {
        return view('administradores.create');
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
                'nivelAcesso' => 'ADMINISTRADOR',
                'login' => $request->input('login'),
                'senha' => bcrypt($request->input('senha')),
            ]);

            $administrador = Administrador::create([
                'usuario_id' => $usuario->id,
                'registroCRB' => $request->registroCRB,
                'valorCRB' => $request->valorCRB,
            ]);

            return redirect()->route('administradores-index');
    }
    
}