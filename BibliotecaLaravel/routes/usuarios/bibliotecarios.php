<?php

use App\Http\Controllers\BibliotecarioController;
use Illuminate\Support\Facades\Route;


Route::prefix('bibliotecarios')->group(function () {
    Route::get('/', [BibliotecarioController::class, 'index'])->name('bibliotecarios-index');
    Route::get('/create', [BibliotecarioController::class, 'create'])->name('bibliotecarios-create');
    Route::post('/bibliotecarios', [BibliotecarioController::class, 'store'])->name('bibliotecarios-store');
    Route::get('/{id}/edit', [BibliotecarioController::class, 'edit'])->where('id', '[0-9]+')->name('bibliotecarios-edit');
    Route::put('/update/{id}', [BibliotecarioController::class, 'update'])->name('bibliotecarios-update');
    Route::delete('/{id}', [BibliotecarioController::class, 'destroy'])->where('id', '[0-9]+')->name('bibliotecarios-destroy');
});     

Route::fallback(function () {
    return view('leitores.fallback');
});