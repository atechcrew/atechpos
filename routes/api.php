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

Route::post('product/store', 'API\ProductController@store');
Route::post('product/update/{product}', 'API\ProductController@update');
Route::get('product/find/{product}', 'API\ProductController@find');

Route::post('category/store', 'API\CategoryController@store');
Route::get('category/all/{searchPerm?}', 'API\CategoryController@getAll');
Route::get('category/find/{category}', 'API\CategoryController@find');
Route::post('category/update/{category}', 'API\CategoryController@update');
Route::get('category/destroy/{category}', 'API\CategoryController@destroy');