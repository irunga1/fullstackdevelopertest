
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

Auth::routes();
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth'], 'prefix' => 'directorio'], function() {
    Route::get('/home', function(){
        return 'prueba';
    });
});
Route::group(["prefix"=>"otro"], function(){
    Route::get('', 'OtroController@index')->name('home');
    Route::get('listar',"OtroController@listar")->name('listar');
});

Route::group(["prefix"=>"vehiculo"],function(){
    Route::get('listar', 'VehiculoController@index')->name('listar');
    Route::get('', 'VehiculoController@index')->name('listar');
    Route::get('insertar', 'VehiculoController@insertar')->name('insertar');
    Route::post('insertpost', 'VehiculoController@insertpost')->name('insertarpost');
    Route::get('modificar/{id}', 'VehiculoController@modificar')->name('modificar')->where(['id'=>'[0-9]+']);
    Route::put('insertput/{id}', 'VehiculoController@insertput')->name('inser')->where(['id'=>'[0-9]+']);
});
Route::group(["prefix"=>"tiempo"],function(){
    Route::get('listar', 'TiemposController@index')->name('listar');
    Route::get('', 'TiemposController@index')->name('listar');
    Route::get('insertar', 'TiemposController@insertar')->name('insertar');
    Route::post('insertpost', 'VehiculoController@insertpost')->name('insertarpost');

});
