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

Auth::routes();

// Overwrite default Login Authentication Routes
Route::get('/', 'Auth\LoginController@index')->name('login');
Route::post('/', 'Auth\LoginController@login');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UserController');
Route::put('/users/{user}/toggle', 'UserController@toggle');
Route::get('/dashboard/{user}', 'UserController@dashboard_edit');
Route::put('/dashboard/{user}', 'UserController@dashboard_update');

Route::get('tests', 'ScreeningTestController@index')->name('tests.index');
Route::post('tests/{test_name}', 'ScreeningTestController@store')->name('tests.store');
Route::delete('tests/{test}', 'ScreeningTestController@destroy')->name('tests.destroy');
Route::put('tests/{test}', 'ScreeningTestController@update')->name('tests.update');
Route::get('tests/{test}/edit', 'ScreeningTestController@edit')->name('tests.edit');
Route::put('tests/{test}/toggle', 'ScreeningTestController@toggle');
//Route::put('tests/{test}/{test_name}', 'ScreeningTestController@update')->name('tests.update');

Route::post('tests/{test}/add_question', 'ScreeningTestController@store_question');
Route::put('tests/{test}/update_question', 'ScreeningTestController@update_question');
Route::delete('tests/{test}/destroy_question', 'ScreeningTestController@destroy_question');

Route::post('tests/{test}/add_choice', 'ScreeningTestController@store_choice');
Route::put('tests/{test}/update_choice', 'ScreeningTestController@update_choice');
Route::delete('tests/{test}/destroy_choice', 'ScreeningTestController@destroy_choice');