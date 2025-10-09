<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Models\Livro;
use Illuminate\Http\Request;
use App\Http\Controllers\LeitorController;
use App\Models\Pessoa;
use App\Http\Controllers\BibliotecarioControllerC;
use App\Models\Bibliotecario;


Route::get('/livros', [LivroController::class, 'index'])->name('livros-index');
Route::get('/livros/{id}', [LivroController::class, 'show'])->name('livros-show');
Route::post('/livros', [LivroController::class, 'store'])->name('livros-store');
Route::put('/livros/{id}', [LivroController::class, 'update'])->name('livros-update');
Route::delete('/livros/{id}', [LivroController::class, 'destroy'])->name('livros-destroy');