<?php

namespace App\Http\Middleware;

use App\Models\Administrador;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Usuario;

class AdministradorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $usuario = Usuario::find(session('usuario_id'));
        if(!$usuario || $usuario->nivelAcesso !== 'ADMINISTRADOR') {
            return redirect()->route('login')->withErrors(['access' => 'Acesso negado.']);
        }
        return $next($request);
    }
}
