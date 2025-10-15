<?php

use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\MeuController1;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login-post');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware('administrador')->group(function () {
    Route::get('/administrador/dashboard', function () {
        return view('principais.principalAdministrador');
    })->name('administrador-dashboard');
});

Route::middleware(['bibliotecario'])->group(function () {
    Route::get('/bibliotecario/dashboard', function () {
        return view('principais.principalBibliotecario');
    })->name('bibliotecario-dashboard');
});

Route::middleware(['auth', 'bibliotecarioOuAdministrador'])->group(function(){
    Route::resource('emprestimo', EmprestimoController::class);
});

Route::get('/testecontroller', [MeuController1::class, 'returnAll']);

Route::prefix('pessoas')->group(function () {
    Route::get('/', [MeuController1::class, 'returnAll'])->name('pessoas-index');
    Route::get('/create', [MeuController1::class, 'create'])->name('pessoas-create');
    Route::post('/pessoas', [MeuController1::class, 'store'])->name('pessoas-store');
    Route::get('/{id}/edit', [MeuController1::class, 'Edit'])->where('id', '[0-9]+')->name('pessoas-edit');
    Route::put('/update', [MeuController1::class, 'Update'])->name('pessoas-update');
    Route::delete('/{id}', [MeuController1::class, 'destroy'])->where('id', '[0-9]+')->name('pessoas-destroy');
});



Route::fallback(function () {
    return view('tela8');
});