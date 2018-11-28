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


/*Route::get('admin', function () {
    return view('admin.admin_template');
});*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//route admin
//Route::get('admin', ['middleware' => 'admin', 'uses' => 'AdminController@index']);

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
