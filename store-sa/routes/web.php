<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ReportesContoller;
use App\Http\Controllers\RolUsuarioController;
use App\Http\Controllers\CategoriaController;
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

Route::controller(CarritoController::class)->group(function(){
    Route::get('/carrito', 'index')->name('inicio.carrito');
    
    Route::get('/cotizacion', 'cotizacion')->name('inicio.cotizacion');
    Route::delete('/cotizacion/eliminarItem/{itemIndex}', 'deleteItemCotizacion')->name('eliminarItem.cotizacion');
    Route::delete('/carrito/vaciarCotizacion', 'deleteAllCotizacion')->name('vaciar.cotizacion');
    
    

    Route::get('/carrito/confirmar', 'pagarCarro')->name('confirmar.carrito');
    Route::post('/carrito/efectuarCompra', 'buy')->name('realizarCompra.carrito');
    Route::get('/carrito/pagoExitoso', function() {
        return view('Carrito.paymentSuccess');
    })->name('pagoExitoso.carrito');

    Route::delete('/carrito/eliminarItem/{itemIndex}', 'deleteItem')->name('eliminarItem.carrito');
    Route::delete('/carrito/vaciarCarrito', 'deleteAll')->name('vaciar.carrito');
});

Route::controller(RolUsuarioController::class)->group(function(){
    Route::get('/dashboard', 'index')->name('inicio.dashboard');
});

Route::controller(ReportesContoller::class)->group(function(){
    Route::get('/reportes', 'index')->name('inicio.reportes');

    Route::get('/reportes/top100vendidos', 'top100vendidos')->name('top100vendidos.reportes');
    Route::get('/reportes/top100vendidosSucursal', 'top100vendidosSucursal')->name('top100vendidosSucursal.reportes');
    Route::get('/reportes/existenciaMenor10', 'existenciaMenor10')->name('existenciaMenor10.reportes');
    Route::get('/reportes/masVendidosMes', 'masVendidosMes')->name('masVendidosMes.reportes');
    Route::get('/reportes/masVendidosSucursal', 'masVendidosSucursal')->name('masVendidosSucursal.reportes');
    Route::get('/reportes/masVendidos', 'masVendidos')->name('masVendidos.reportes');
    Route::get('/reportes/compradoresFrecuentes', 'compradoresFrecuentes')->name('compradoresFrecuentes.reportes');
    Route::get('/reportes/compradoresSucursal', 'compradoresSucursal')->name('compradoresSucursal.reportes');
    Route::get('/reportes/facturas', 'facturas')->name('facturas.reportes');
});

Route::controller(ProductoController::class)->group(function() {
    Route::get("/productos", "index")->name("ver.productos");

    Route::get("/productos/busqueda", "searchFor")->name("buscar.productos");
    Route::get("/productos/categoria", "searchForCategory")->name("buscarCategoria.productos");
    
    Route::get("/productos/crear", "create")->name("crear.producto");
    Route::post("/productos/crear", "store")->name("guardar.producto");
    Route::post("/productos/agregarAlCarro/{producto}", "addToCart")->name("agregarProducto.producto");
    
    Route::get("/productos/agregarExistencias/{producto}", "addExistencias")->name("agregarExistencia.producto");
    Route::post("/productos/guardarExistencias", "storeExistencias")->name("guardarExistencia.producto");

    Route::get("/productos/editar/{producto}", "edit")->name("editar.producto");
    Route::put("/productos/editar/{producto}", "update")->name("actualizar.producto");
    Route::delete("/productos/eliminar/{id}", "destroy")->name("eliminar.producto");
    Route::get("/productos/{producto}", "show")->name("mostrar.producto");
});

Route::controller(CategoriaController::class)->group(function(){
    Route::get("/categorias", "index")->name("ver.categoria");

    Route::get("/categorias/crear", "create")->name("crear.categoria");
    Route::post("/categorias/crear", "store")->name("guardar.categoria");

    Route::get("/categorias/editar/{categoria}", "edit")->name("editar.categoria");
    Route::put("/categorias/editar/{categoria}", "update")->name("actualizar.categoria");
    Route::delete("/categorias/eliminar/{id}", "destroy")->name("eliminar.categoria");
    Route::get("/categorias/{producto}", "show")->name("mostrar.categoria");

});