<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Administrador;

class AdministradorController extends Controller
{
    public function index()
    {
        $administradores = Administrador::with('usuario.pessoa')->get();
        return response()->json($administradores);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'superAdmin' => 'required|boolean',
        ]);

        $administrador = Administrador::create($data);
        return response()->json(['message' => 'Administrador criado com sucesso', 'administrador' => $administrador], 201);
    }

    
}