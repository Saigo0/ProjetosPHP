<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Models\Livro;
use Illuminate\Http\Request;
use App\Http\Controllers\LeitorController;
use App\Models\Pessoa;
use App\Http\Controllers\BibliotecarioController;
use App\Models\Bibliotecario;

Route::get('/bibliotecarios', [BibliotecarioController::class, 'index'])->name('bibliotecarios-index');
Route::get('/bibliotecarios/{id}', [BibliotecarioController::class, 'show'])->name('bibliotecarios-show');
Route::post('/bibliotecarios', [BibliotecarioController::class, 'store'])->name('bibliotecarios-store');
Route::put('/bibliotecarios/{id}', [BibliotecarioController::class, 'update'])->name('bibliotecarios-update');
Route::delete('/bibliotecarios/{id}', [BibliotecarioController::class, 'destroy'])->name('bibliotecarios-destroy');
