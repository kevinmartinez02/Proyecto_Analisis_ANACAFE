<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\EmpleadosController;

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
    return view('PageMain');
});


Route::get('/inicio',function() {
    return view('inicio');
})->middleware('auth')->name('inicio');

//Ruta ingresar datos empleado
Route::get('/registro',[EmpleadosController::class,'create'])->middleware('auth')->name('registro.empleado');
Route::post('/registro/store',[EmpleadosController::class,'store'])->name('registro.datos');

//ruta para mostar datos empleado
Route::get('/empleados/{id}/informacion',[EmpleadosController::class,'show'])->middleware('auth')->name('mostrar');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
