<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Models\Livro;
use Illuminate\Http\Request;
use App\Http\Controllers\LeitorController;
use App\Models\Pessoa;
use App\Http\Controllers\BibliotecarioController;
use App\Models\Bibliotecario;
use App\Http\Controllers\EmprestimoController;
use App\Models\Emprestimo;

Route::prefix('emprestimos')->group(function () {
    Route::get('/', [EmprestimoController::class, 'index'])->name('emprestimos-index');
    Route::get('/create', [EmprestimoController::class, 'create'])->name('emprestimos-create');
    Route::post('/emprestimos', [EmprestimoController::class, 'store'])->name('emprestimos-store');
    Route::get('/{id}/edit', [EmprestimoController::class, 'edit'])->where('id', '[0-9]+')->name('emprestimos-edit');
    Route::put('/update/{id}', [EmprestimoController::class, 'update'])->name('emprestimos-update');
    Route::put('/devolver/{id}', [EmprestimoController::class, 'devolver'])->name('emprestimos-devolver');
    Route::delete('/{id}', [EmprestimoController::class, 'destroy'])->where('id', '[0-9]+')->name('emprestimos-destroy');
});     