<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();

Route::controller(HomeController::class)->group(function(){
    Route::get('/home', 'index')->name('home');
    Route::get('/', 'index')->name('home');
});

Route::controller(ProductoController::class)->group(function() {
    Route::get("/productos", "index")->name("ver.productos");
    
    Route::get("/productos/crear", "create")->name("crear.producto");
    Route::post("/productos/crear", "store")->name("guardar.producto");
    Route::post("/productos/agregarAlCarro/{producto}", "addToCart")->name("agregarProducto.producto");
    
    Route::get("/productos/editar/{producto}", "edit")->name("editar.producto");
    Route::put("/productos/editar/{producto}", "update")->name("actualizar.producto");
    Route::delete("/productos/eliminar/{id}", "destroy")->name("eliminar.producto");
    Route::get("/productos/{producto}", "show")->name("mostrar.producto");
});
