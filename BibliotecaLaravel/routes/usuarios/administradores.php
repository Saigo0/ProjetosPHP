<?php 

use App\Http\Controllers\AdministradorController;
use App\Models\Administrador;
use Illuminate\Support\Facades\Route;

Route::get('/administradores', [AdministradorController::class, 'index']);
Route::get('/administradores/{id}', function ($id) {
    $administrador = Administrador::with('usuario.pessoa')->find($id);
    if ($administrador) {
        return response()->json($administrador);
    } else {
        return response()->json(['message' => 'Administrador não encontrado'], 404);
    }
});

Route::post('/administradores', function (Illuminate\Http\Request $request) {
    $data = $request->validate([
        'usuario_id' => 'required|exists:usuarios,id',
        'superAdmin' => 'required|boolean',
    ]);

    $administrador = Administrador::create($data);
    return response()->json(['message' => 'Administrador criado com sucesso', 'administrador' => $administrador], 201);
});