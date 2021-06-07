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

Route::group(['namespace' => 'Api'], function () {

	Route::group(['prefix' => 'v1', 'namespace' => 'V1'], function() {

		Route::group(['middleware' => 'guest'], function () {

			Route::post('register', 'AuthController@register');
			Route::post('login', 'AuthController@login');

		});

		Route::group(['middleware' => 'auth:api'], function () {

			Route::get('logout', 'AuthController@logout');
			Route::get('user',  function (Request $request) {
				return $request->user();
			});

			Route::resource('contacts', 'UserContactsController')->except(['create', 'edit']);
			Route::post('contacts/import', 'UserContactsController@import');

		});
	});

});
