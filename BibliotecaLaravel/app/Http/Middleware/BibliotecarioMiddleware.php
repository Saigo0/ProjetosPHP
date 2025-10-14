<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Symfony\Component\HttpFoundation\Response;

class BibliotecarioMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $usuario = Usuario::find(session('usuario_id'));
        if(!$usuario || $usuario->nivelAcesso !== 'BIBLIOTECARIO') {
            return redirect()->route('login')->withErrors(['access' => 'Acesso negado.']);
        }
        return $next($request);
    }
}
