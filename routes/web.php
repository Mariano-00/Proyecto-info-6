<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;

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

// La ruta principal retorna una vista llamada welcome
Route::get('/', function () {
    return view('welcome');
})->name('home');

// De esta manera se crean automaticamente todas las rutas para todas 
// las funciones dentro del controlador PostController.
Route::resource('/post', PostController::class);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
