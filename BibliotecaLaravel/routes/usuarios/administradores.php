<?php 

use App\Http\Controllers\AdministradorController;
use App\Models\Administrador;
use Illuminate\Support\Facades\Route;

Route::prefix('administradores')->group(function () {
    Route::get('/', [AdministradorController::class, 'index'])->name('administradores-index');
    Route::get('/create', [AdministradorController::class, 'create'])->name('administradores-create');
    Route::post('/administradores', [AdministradorController::class, 'store'])->name('administradores-store');
    Route::get('/{id}/edit', [AdministradorController::class, 'edit'])->where('id', '[0-9]+')->name('administradores-edit');
    Route::put('/update/{id}', [AdministradorController::class, 'update'])->name('administradores-update');
    Route::delete('/{id}', [AdministradorController::class, 'destroy'])->where('id', '[0-9]+')->name('administradores-destroy');
});   