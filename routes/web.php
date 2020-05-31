
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//grupos-
// Route::group(['name' => 'facturacion', 'middleware'=>'auth'], function(){
//     Route::get('fija');
//     Route::get('eventual');
// });

Route::group(['middleware' => ['auth'], 'prefix' => 'directorio'], function() {
    Route::get('/home', function(){
        return 'prueba';
    });
});

Route::group(["prefix"=>"otro"], function(){
    Route::get('', 'OtroController@index')->name('home');
    Route::get('listar',"OtroController@listar")->name('listar');
});
