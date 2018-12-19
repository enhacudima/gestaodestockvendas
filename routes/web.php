<?php

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

Auth::routes();


//route admin
//Route::get('admin', ['middleware' => 'admin', 'uses' => 'AdminController@index']);

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::resource('mesa','MesaController');
Route::get('criarmesa','MesaController@index');
Route::post('storemesa','MesaController@store');

Route::resource('produto','ProdutoController');
Route::get('criarproduto','ProdutoController@index');
Route::post('storeproduto','ProdutoController@store');
Route::post('produto/update/{id}','ProdutoController@update');