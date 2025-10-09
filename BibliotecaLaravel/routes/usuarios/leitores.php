<?php

use App\Http\Controllers\MeuController1;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/tela', 'tela1');

Route::get('/tela2', function () {
    return view('tela2');
});

Route::view('/tela3', 'tela3', ['nome' => 'Nome1']);

Route::get('/tela4/{nome?}', function ($nome = null) {
    return view('tela4', ['nome' => $nome]);
})->where('nome', '[A-Za-z]+');

Route::get('/tela5/{id?}', function ($id = null) {
    return view('tela5', ['id' => $id]);
})->where('id', '[0-9]+');


Route::get('/tela6/{nome?}/{id?}', function ($nome = null, $id = null) {
    return view('tela6', ['nome' => $nome, 'id' => $id]);
})->where(['nome' => '[A-Za-z]+', 'id' => '[0-9]+']);

Route::view('/tela7', 'tela7')->name('tela7');

Route::get('/home', function () {
    return view('welcome');
})->name('home-index');

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