<?php

use App\Http\Controllers\LeitorController;
use Illuminate\Support\Facades\Route;


Route::prefix('leitores')->group(function () {
    Route::get('/', [LeitorController::class, 'index'])->name('leitores-index');
    Route::get('/create', [LeitorController::class, 'create'])->name('leitores-create');
    Route::post('/leitores', [LeitorController::class, 'store'])->name('leitores-store');
    Route::get('/{id}/edit', [LeitorController::class, 'edit'])->where('id', '[0-9]+')->name('leitores-edit');
    Route::put('/update/{id}', [LeitorController::class, 'update'])->name('leitores-update');
    Route::delete('/{id}', [LeitorController::class, 'destroy'])->where('id', '[0-9]+')->name('leitores-destroy');
});

Route::fallback(function () {
    return view('leitores.fallback');
});