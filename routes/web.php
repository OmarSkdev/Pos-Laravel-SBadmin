<?php

use App\Http\Controllers\categoriaController;
use App\Http\Controllers\marcaController;
use App\Http\Controllers\presentacioneController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('template');
});

Route::view('/panel', 'panel.index')->name('panel');

// Route::view('/categorias', 'categoria.index')->name('categoria');

Route::resource('categorias', categoriaController::class);
Route::resource('marcas', marcaController::class);
Route::resource('presentaciones', presentacioneController::class);
Route::resource('productos', ProductoController::class);


Route::get('/401', function () {
    return view('pages.401');
});

Route::get('/404', function () {
    return view('pages.404');
});

Route::get('/500', function () {
    return view('pages.500');
});

Route::get('/login', function () {
    return view('auth.login');
});
