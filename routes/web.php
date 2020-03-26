<?php

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

Route::get('/', function () {
    return view('auth/login');
});

//Route indica donde podemos encontrar los archivos y el segundo parametro es el
//Controlador para realizar las acciones
Route::resource('almacen/categoria','CategoriaController');

Route::resource('almacen/articulo', 'ArticuloController');

Route::resource('ventas/cliente', 'ClienteController');

Route::resource('compras/proveedor', 'ProveedorController');

Route::resource('compras/ingreso', 'IngresoController');

Route::resource('ventas/venta', 'VentaController');

Route::resource('seguridad/usuario', 'UsuarioController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/{slug?}', 'HomeController@index');
