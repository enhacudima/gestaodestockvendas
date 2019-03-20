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
Route::post('updatemesa','MesaController@updatemesa');

Route::resource('produto','ProdutoController');
Route::get('criarproduto','ProdutoController@index');
Route::post('storeproduto','ProdutoController@store');
Route::post('produto/update/{id}','ProdutoController@update');
Route::get('produto_entrada','ProdutoController@entradaindex');
Route::post('store_produto_entrada','ProdutoController@entradastore');
Route::get('ajust_index','ProdutoController@ajustindex');
Route::post('store_produto_ajuste','ProdutoController@ajustestore');
Route::get('report_produt','ProdutoController@report');
Route::get('show_produto_entrada/{id}','ProdutoController@lotshow');
Route::post('produto/entrada/update','ProdutoController@loteupdate');
//obter lot_id
Route::get('findlotid','ProdutoController@lotid');
Route::get('vendasindex/{id}','VendasController@index');
Route::post('saveselection','VendasController@saveselection');
Route::get('saveselection','VendasController@saveselection');
Route::get('getmesatem','VendasController@getmesatem');
Route::post('atualizarvendatemp','VendasController@atualizarvendatemp');
Route::post('efectuarpagamento','VendasController@efectuarpagamento');
Route::get('listapedidos','VendasController@listapedidos');

