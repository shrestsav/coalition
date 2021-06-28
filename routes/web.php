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

Route::get('/', 'HomeController@index');
Route::post('/submitForm','HomeController@store')->name('storeItems');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/task','TaskController@index');

Route::get('/tasks','TaskController@tasks');
Route::post('/tasks','TaskController@store');
Route::delete('/tasks/delete/{id}','TaskController@destroy');
Route::post('/tasks/update/{id}','TaskController@update');
Route::post('/tasks/updateOrder','TaskController@updateOrder');
Route::get('/projects','TaskController@projectNames');
