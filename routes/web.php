<?php

use App\Http\Controllers\ProfileController;
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
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//TODO CONTEO DE REGISTROS POR PARTES
Route::get('/registros', [App\Http\Controllers\RegistrosController::class, 'index'])->name('registros');

// TODO LISTADO
//* ACTIVOS
Route::get('/activos/opciones', [App\Http\Controllers\RegistrosController::class, 'activos_list_ops'])->name('activos_list_ops');

//! =====================================================================================================

// !Docente
Route::get('/personal/registar', [App\Http\Controllers\DocenteController::class, 'create'])->name('nuevo');
Route::post('/personal/registar/nuevo', [App\Http\Controllers\DocenteController::class, 'store'])->name('docente_store');
//!

// ? CAJAS
Route::get('/cajas', [App\Http\Controllers\CajaController::class, 'index'])->name('cajas');
Route::get('/cajas/registrar', [App\Http\Controllers\CajaController::class, 'create'])->name('nueva_caja');
Route::post('/cajas/registrar/nuevo', [App\Http\Controllers\CajaController::class, 'store'])->name('caja_store');
Route::get('/cajas/{caja}/editar', [App\Http\Controllers\CajaController::class, 'edit'])->name('editar_caja');
Route::put('/cajas/{caja}/actualizar', [App\Http\Controllers\CajaController::class, 'update'])->name('actualizar_caja');
Route::delete('/cajas/{caja}/eliminar', [App\Http\Controllers\CajaController::class, 'destroy'])->name('eliminar_caja');
// ?



require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
