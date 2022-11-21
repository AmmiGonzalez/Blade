<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ReportesContoller;
use App\Http\Controllers\RolUsuarioController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\DistribuidorController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DepartamentoController;
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

    Route::get("/roles", "roles")->name("ver.rol");

    Route::get("/roles/crear", "create")->name("crear.rol");
    Route::post("/roles/crear", "store")->name("guardar.rol");
    /* La variable entre llaves se obtiene del controlador */
    Route::get("/roles/editar/{rolUsuario}", "edit")->name("editar.rol");
    Route::put("/roles/editar/{rolUsuario}", "update")->name("actualizar.rol");
    Route::delete("/roles/eliminar/{id}", "destroy")->name("eliminar.rol");
    Route::get("/roles/{rolUsuario}", "show")->name("mostrar.rol");
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
    Route::get("/categorias/{categoria}", "show")->name("mostrar.categoria");
});

Route::controller(MarcaController::class)->group(function(){
    Route::get("/marcas", "index")->name("ver.marca");

    Route::get("/marcas/crear", "create")->name("crear.marca");
    Route::post("/marcas/crear", "store")->name("guardar.marca");

    Route::get("/marcas/editar/{marca}", "edit")->name("editar.marca");
    Route::put("/marcas/editar/{marca}", "update")->name("actualizar.marca");
    Route::delete("/marcas/eliminar/{id}", "destroy")->name("eliminar.marca");
    Route::get("/marcas/{marca}", "show")->name("mostrar.marca");
});

Route::controller(DistribuidorController::class)->group(function(){
    Route::get("/distribuidores", "index")->name("ver.distribuidor");

    Route::get("/distribuidores/crear", "create")->name("crear.distribuidor");
    Route::post("/distribuidores/crear", "store")->name("guardar.distribuidor");

    Route::get("/distribuidores/editar/{distribuidor}", "edit")->name("editar.distribuidor");
    Route::put("/distribuidores/editar/{distribuidor}", "update")->name("actualizar.distribuidor");
    Route::delete("/distribuidores/eliminar/{id}", "destroy")->name("eliminar.distribuidor");
    Route::get("/distribuidores/{distribuidor}", "show")->name("mostrar.distribuidor");
});

Route::controller(SucursalController::class)->group(function(){
    Route::get("/sucursales", "index")->name("ver.sucursal");

    Route::get("/sucursales/crear", "create")->name("crear.sucursal");
    Route::post("/sucursales/crear", "store")->name("guardar.sucursal");

    Route::get("/sucursales/editar/{sucursal}", "edit")->name("editar.sucursal");
    Route::put("/sucursales/editar/{sucursal}", "update")->name("actualizar.sucursal");
    Route::delete("/sucursales/eliminar/{id}", "destroy")->name("eliminar.sucursal");
    Route::get("/sucursales/{sucursal}", "show")->name("mostrar.sucursal");
});

Route::controller(DepartamentoController::class)->group(function(){
    
    Route::get("/buscarsucursales", "index")->name("ver.buscarsucursal");

   /*  Route::get("/sucursales/crear", "create")->name("crear.sucursal");
    Route::post("/sucursales/crear", "store")->name("guardar.sucursal");

    Route::get("/sucursales/editar/{sucursal}", "edit")->name("editar.sucursal");
    Route::put("/sucursales/editar/{sucursal}", "update")->name("actualizar.sucursal");
    Route::delete("/sucursales/eliminar/{id}", "destroy")->name("eliminar.sucursal");
    Route::get("/sucursales/{sucursal}", "show")->name("mostrar.sucursal"); */
});

Route::controller(UsuarioController::class)->group(function(){
    Route::get("/usuarios", "index")->name("ver.usuario");

    Route::get("/usuarios/crear", "create")->name("crear.usuario");
    Route::post("/usuarios/crear", "store")->name("guardar.usuario");

    Route::get("/usuarios/editar/{usuario}", "edit")->name("editar.usuario");
    Route::put("/usuarios/editar/{usuario}", "update")->name("actualizar.usuario");
    Route::delete("/usuarios/eliminar/{id}", "destroy")->name("eliminar.usuario");
    Route::get("/usuarios/{usuario}", "show")->name("mostrar.usuario");
}); 