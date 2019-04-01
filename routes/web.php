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


Route::redirect('/', '/company/1');
Route::get('/company/{id}', 'IndexController@index');
Route::get('/company/{id}/create', 'IndexController@create');
Route::get('/company/{id}/{invoice_id}', 'IndexController@show');

//Route::get('/', function () {
//    return view('login_page');
//});
