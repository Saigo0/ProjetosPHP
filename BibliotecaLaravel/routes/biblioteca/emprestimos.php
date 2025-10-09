<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Models\Livro;
use Illuminate\Http\Request;
use App\Http\Controllers\LeitorController;
use App\Models\Pessoa;
use App\Http\Controllers\BibliotecarioControllerC;
use App\Models\Bibliotecario;
use App\Http\Controllers\EmprestimoController;
use App\Models\Emprestimo;

Route::get('/emprestimos', [EmprestimoController::class, 'index'])->name('emprestimos-index');
Route::get('/emprestimos/{id}', [EmprestimoController::class, 'show'])->name('emprestimos-show');
Route::post('/emprestimos', [EmprestimoController::class, 'store'])->name('emprestimos-store');
Route::put('/emprestimos/{id}', [EmprestimoController::class, 'update'])->name('emprestimos-update');
Route::delete('/emprestimos/{id}', [EmprestimoController::class, 'destroy'])->name('emprestimos-destroy');