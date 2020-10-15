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
    return view('home');
});

/* Rutas para las estadisticas */
Route::get('/departamento/statistics', 'DepartamentoController@statistics')->name('departamento.statistics');

Route::resources([
    'departamento' => 'DepartamentoController'
]);

/* Rutas para actualización por ajax */
Route::post('/departamento/update_data/{id}', 'DepartamentoController@updateDataForAjax')->name('departamento.update_data');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
