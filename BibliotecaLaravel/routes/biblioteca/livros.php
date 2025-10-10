<?php

use App\Http\Controllers\LivroController;
use Illuminate\Support\Facades\Route;


Route::prefix('livros')->group(function () {
    Route::get('/', [LivroController::class, 'index'])->name('livros-index');
    Route::get('/create', [LivroController::class, 'create'])->name('livros-create');
    Route::post('/livros', [LivroController::class, 'store'])->name('livros-store');
    Route::get('/{id}/edit', [LivroController::class, 'edit'])->where('id', '[0-9]+')->name('livros-edit');
    Route::put('/update/{id}', [LivroController::class, 'update'])->name('livros-update');
    Route::delete('/{id}', [LivroController::class, 'destroy'])->where('id', '[0-9]+')->name('livros-destroy');
});     

Route::fallback(function () {
    return view('leitores.fallback');
});