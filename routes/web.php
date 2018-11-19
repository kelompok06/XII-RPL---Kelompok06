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
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function() {
    Route::resource('/kategori', 'KategoriController');
 	  Route::get('/table/kategori', 'KategoriController@dataTable')->name('table.kategori');
    Route::resource('/post', 'PostController');
   	Route::get('/table/post', 'PostController@dataTable')->name('table.post');
  Route::get('/cari/kategori', 'PostController@loadKategori');
});
