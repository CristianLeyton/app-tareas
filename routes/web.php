<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    // Verifica si el usuario está autenticado
    if (Auth::check()) {
        // Si está autenticado, redirige a la ruta 'inicio'
        return redirect()->route('inicio');
    }
    // Si no está autenticado, muestra la vista 'welcome'
    return view('welcome');
});


 Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
/*     Route::get('/', function () {
        return redirect()->route('inicio');
        //return view('dashboard');
    });  */

    Route::get('/inicio', function () {
        return view('inicio');
    })->name('inicio');

    Route::get('/completadas', function () {
        return view('completadas');
    })->name('completadas');

    Route::get('/etiquetas', function () {
        return view('etiquetas');
    })->name('etiquetas');
});
