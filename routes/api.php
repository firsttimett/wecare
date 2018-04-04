<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: content-type');

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', ['as' => 'api.login', 'uses' => 'ApiController@login']);
Route::post('/checkUniqueEmail', ['as' => 'api.checkUniqueEmail', 'uses' => 'ApiController@checkUniqueEmail']);
Route::post('/register', ['as' => 'api.register', 'uses' => 'ApiController@register']);

Route::get('/getScreeningTest', ['as' => 'api.getScreeningTest', 'uses' => 'ApiController@getScreeningTest']);
Route::post('/getQsAndChoice', ['as' => 'api.getQsAndChoice', 'uses' => 'ApiController@getQsAndChoice']);
Route::post('/saveScreeningTest', ['as' => 'api.saveScreeningTest', 'uses' => 'ApiController@saveScreeningTest']);
Route::post('/getTestsTaken', ['as' => 'api.getTestsTaken', 'uses' => 'ApiController@getTestsTaken']);

Route::post('/getDiaryEntries', ['as' => 'api.getDiaryEntries', 'uses' => 'ApiController@getDiaryEntries']);
Route::post('/saveDiaryEntries', ['as' => 'api.saveDiaryEntries', 'uses' => 'ApiController@saveDiaryEntries']);