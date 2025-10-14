<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('authenticate.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('login', 'senha');

        $usuario = Usuario::where('login', $credentials['login'])->first();

        if(!$usuario || !password_verify($credentials['senha'], $usuario->senha)) {
            return redirect()->back()->withErrors(['login' => 'Credenciais inválidas'])->withInput();
        }
        
        session(['usuario_id' => $usuario->id, 'nivelAcesso' => $usuario->nivelAcesso]);

        if($usuario->nivelAcesso === 'ADMINISTRADOR') {
            return redirect()->route('administrador-dashboard');
        } elseif($usuario->nivelAcesso === 'BIBLIOTECARIO') {
            return redirect()->route('bibliotecario-dashboard');
        } else {
            return redirect()->back()->withErrors(['login' => 'Nível de acesso desconhecido'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
