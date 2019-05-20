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

Route::resource('mesa','MesaController')->middleware('can:index_mesa');
Route::get('criarmesa','MesaController@index')->middleware('can:criar_mesa');
Route::post('storemesa','MesaController@store')->middleware('can:store_mesa');
Route::post('updatemesa','MesaController@updatemesa')->middleware('can:update_mesa');

Route::resource('produto','ProdutoController')->middleware('can:produto');
Route::get('criarproduto','ProdutoController@index')->middleware('can:create_produto');
Route::post('storeproduto','ProdutoController@store')->middleware('can:store_produto');
Route::post('produto/update/{id}','ProdutoController@update')->middleware('can:update_produto');
Route::get('produto_entrada','ProdutoController@entradaindex')->middleware('can:entrada_produto');
Route::post('store_produto_entrada','ProdutoController@entradastore')->middleware('can:store_entrada_produto');
Route::get('ajust_index','ProdutoController@ajustindex')->middleware('can:ajust_produto');
Route::post('store_produto_ajuste','ProdutoController@ajustestore')->middleware('can:store_ajust_produto');
Route::get('show_produto_entrada/{id}','ProdutoController@lotshow')->middleware('can:show_entrada_produto');
Route::post('produto/entrada/update','ProdutoController@loteupdate')->middleware('can:update_entrada_produto');
//obter lot_id
Route::get('findlotid','ProdutoController@lotid');
Route::get('vendasindex/{id}','VendasController@index')->middleware('can:venda');
Route::get('carvendasindex/{car_id}/{mesa_id}/{user_id}','VendasController@carindex')->middleware('can:car_venda');
Route::get('vendascreditoindex/{id}','VendasController@creditoindex')->middleware('can:credito');
Route::post('saveselection','VendasController@saveselection')->middleware('can:saveselection_venda');
Route::get('saveselection','VendasController@saveselection')->middleware('can:saveselection_venda');
Route::get('getmesatem','VendasController@getmesatem')->middleware('can:get_mesa_venda');
Route::post('atualizarvendatemp','VendasController@atualizarvendatemp')->middleware('can:actualizar_venda_temp_venda');
Route::post('efectuarpagamento','VendasController@efectuarpagamento')->middleware('can:efectuarpagamento_vendas');
Route::post('efectuarpagamentocredito','VendasController@efectuarpagamentocredito')->middleware('can:efectuar_pagamento_credito_venda');
Route::post('efectuarcredito','VendasController@efectuarcredito')->middleware('can:efectuar_credito_venda');
Route::get('listapedidos','VendasController@listapedidos')->middleware('can:lista_pedidos_venda');
Route::get('creditarvenda','VendasController@creditarvenda')->middleware('can:creditar_venda');
Route::post('savecredito','VendasController@savecredito')->middleware('can:save_credito_venda');


// relatorios 
Route::get('report_produt','ReportController@reportMovimento')->middleware('can:report_produt');
Route::post('report_movimetos_filter','ReportController@reportMovimentoFilter')->middleware('can:report_produt');
Route::post('report_inflow_filter','ReportController@reportInflowFilter')->middleware('can:report_inflow');
Route::post('report_produto_venda_filter','ReportController@reportProdutoVendaFilter')->middleware('can:report_produt');
Route::post('report_auditar_filter','ReportController@reportAuditarFilter')->middleware('can:report_auditar');
Route::get('report_inflow','ReportController@reportInflow')->middleware('can:report_inflow');
Route::get('report_produto_venda','ReportController@reportProdutoVenda')->middleware('can:report_produto');
Route::get('report_auditar','ReportController@reportAuditar')->middleware('can:report_auditar');
Route::get('report_vendacredito','ReportController@vendascredito')->middleware('can:report_vendacredito');
Route::get('listapedidoscliente','ReportController@listapedidos')->middleware('can:listapedidoscliente');
Route::get('pagamentocliente','ReportController@pagamentocliente')->middleware('can:pagamentocliente');
Route::post('report_vendacredito_filter','ReportController@vendascreditofiltre')->middleware('can:report_vendacredito_filter');
Route::get('report_vendacar','ReportController@vendascar')->middleware('can:report_vendacar');
Route::post('report_vendacar_filter','ReportController@vendascarfilter')->middleware('can:report_vendacar_filter');






Route::post('apagalinha','VendasController@apagalinha')->middleware('can:apagalinha_venda');

//car wash
Route::get('carindex/{id}','CarController@carindex')->middleware('can:index_car');
Route::get('carcreate/{id}','CarController@carcreate')->middleware('can:create_car');
Route::get('carshow/{id}/{mesa_id}','CarController@carshow')->middleware('can:show_car');
Route::post('storcar','CarController@storcar')->middleware('can:stor_car');
Route::post('atualizar','CarController@atualizar')->middleware('can:actualizar_car');
Route::get('carshow/{id}/{mesa_id}','CarController@carshow')->middleware('can:show_car');
Route::get('cartemp/{id}/{mesa_id}/{user_id}','CarController@cartemp')->middleware('can:show_car');

Route::post('carapagalinha','CarController@carapagalinha')->middleware('can:apagalinha_venda');

//Cliente 
Route::get('index_cliente','ClienteController@indexcliente')->middleware('can:index_cliente');
Route::post('storcliente','ClienteController@storcliente')->middleware('can:stor_cliente');
Route::get('clienteshow/{id}','ClienteController@clienteshow')->middleware('can:show_cliente');
Route::post('updatecliente','ClienteController@updatecliente')->middleware('can:update_cliente');
Route::get('searchcliente','ClienteController@searchcliente')->name('searchloanid')->middleware('can:search_cliente');




