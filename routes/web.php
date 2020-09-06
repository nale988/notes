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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');
Route::get('home/show/{id}', 'HomeController@show')->name('show');
Route::get('home/edit/{id}', 'HomeController@edit')->name('edit');

Route::post('home/update', 'HomeController@update')->name('update');
Route::post('savenote', 'HomeController@savenote')->name('savenote');
