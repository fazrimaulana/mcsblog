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

Route::post('/login', 'ApiController@login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//posts
Route::middleware('auth:api')->get('/posts', 'ApiController@posts');

//pages
Route::middleware('auth:api')->get('/pages', 'ApiController@pages');

//media
Route::middleware('auth:api')->get('/medias', 'ApiController@medias');

//media
Route::middleware('auth:api')->get('/comments', 'ApiController@comments');
