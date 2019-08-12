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

Route::get('/dashboard', 'HomeController@index');
Route::get('/product' , 'ProductController@all_product');
Route::post('/saveproduct' , 'ProductController@save_product');
Route::get('/product/{id}' , 'ProductController@edit_product');
Route::get('/delete/{id}' , 'ProductController@delete_product');
Route::post('/uploadckeditor' , 'ProductController@ckUpload');
Route::post('/update/{id}' , 'ProductController@update_product');
// Route::get('{path}', 'HomeController@index')->where('path', '([A-z\d-\/_.]+)?');



