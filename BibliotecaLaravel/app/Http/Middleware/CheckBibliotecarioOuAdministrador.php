<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;

class CheckBibliotecarioOuAdministrador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $usuario = $request->user();

        if ($usuario && ($usuario->nivelAcesso === 'BIBLIOTECARIO' || $usuario->nivelAcesso === 'ADMINISTRADOR')) {
            return $next($request);
        }

        abort(403, 'Acesso negado.');
    }
}
