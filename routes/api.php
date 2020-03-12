<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'summoner'

], function () {

    /* GET */
    Route::get('show/{summoner_name}', 'SummonerController@show')->middleware("summoner");

});

Route::group([

    'middleware' => 'api',
    'prefix' => 'match'

], function () {

    /* GET */
    Route::get('index/{account_id}', 'MatchController@index');
    Route::get('show/{match_id}', 'MatchController@show');
    Route::get('timeDetails/{match_id}', 'MatchController@timeDetails');

});