<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');
Route::get('home/edit/{id}/{type}', 'HomeController@edit')->name('edit');
Route::get('home/show/{id}/{type}', 'HomeController@show')->name('show');

Route::post('home/update', 'HomeController@update')->name('update');
Route::post('savenote', 'HomeController@savenote')->name('savenote');
Route::get('deletenote/{id}', 'HomeController@deletenote')->name('deletenote');
Route::get('deleteoldversions/{id}', 'HomeController@deleteoldversions')->name('deleteoldversions');
