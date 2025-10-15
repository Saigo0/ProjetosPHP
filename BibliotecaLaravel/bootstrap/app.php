<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',

        then: function ($app) {

            $router = $app->make('router');

            $router->middleware('web')
                ->prefix('usuarios')
                ->group(function ()  {
                    require base_path('routes/usuarios/bibliotecarios.php');
                    require base_path('routes/usuarios/administradores.php');
                    require base_path('routes/usuarios/leitores.php');
                });

            $router->middleware('web')
            ->prefix('biblioteca')
            ->group(function () {
                require base_path('routes/biblioteca/livros.php');
                require base_path('routes/biblioteca/emprestimos.php');
            });
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'bibliotecario' => \App\Http\Middleware\BibliotecarioMiddleware::class,
            'administrador' => \App\Http\Middleware\AdministradorMiddleware::class,
            'bibliotecarioOuAdministrador' => \App\Http\Middleware\CheckBibliotecarioOuAdministrador::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        
    })->create();
