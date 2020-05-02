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
Route::resource('/product', 'ProductsController');
Route::resource('/type', 'ProductTypeController');
Route::resource('/store/store', 'StoreController');
Route::get('/product/{id}/delete','ProductsController@delete');
Route::get('/type/{id}/delete','ProductTypeController@delete');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
