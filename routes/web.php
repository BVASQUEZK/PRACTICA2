<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriaController;

Route::get('/', function () {
    return view('plantilla.app');
});

Route::resource('categorias',CategoriaController::class);
Route::resource('usuario',UserController::class);

