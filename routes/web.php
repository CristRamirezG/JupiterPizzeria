<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/Producto', ProductoController::class);

Route::put('/Producto/ModCantidad/{id}', [ProductoController::class, 'ModCantidad'])->name('Producto.ModCantidad');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




/*

GET	/Producto		Producto.index

GET	/Producto/create		Producto.create

POST	/Producto		Producto.store

GET	/Producto/{nota}		Producto.show

GET	/Producto/{nota}/edit		Producto.edit

PUT/PATCH	/Producto/{nota}		Producto.update

DELETE	/Producto/{nota}		Producto.destroy */