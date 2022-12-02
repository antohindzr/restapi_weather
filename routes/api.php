<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('request', 'App\Http\Controllers\weather\weatherController@request');
Route::get('answer', 'App\Http\Controllers\weather\weatherController@answer');
Route::get('full', 'App\Http\Controllers\weather\weatherController@full');

Route::post('request', 'App\Http\Controllers\weather\weatherController@requestSave');
