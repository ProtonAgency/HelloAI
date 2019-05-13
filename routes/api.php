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

Route::group(['middleware' => 'auth.jwt', 'prefix' => 'api'], function() {
	Route::group(['middleware' => 'api', 'prefix' => 'auth'], function() {
	    Route::post('login', 'AuthController@login');
	    Route::post('logout', 'AuthController@logout');
	    Route::post('refresh', 'AuthController@refresh');
	    Route::post('me', 'AuthController@me');
	});

	Route::group(['prefix' => 'v1'], function() {
		// model routes
		Route::post('models/new', 'V1\ApiController@createModel');
		Route::get('models/list', 'V1\ApiController@listModels');
		Route::post('models/{identifier}/update', 'V1\ApiController@updateModel');
		Route::post('models/{identifier}/delete', 'V1\ApiController@deleteModel');
		Route::post('models/{identifier}/train', 'V1\ApiController@trainModel');
		Route::post('models/{identifier}/predict', 'V1\ApiController@predictModel');
		Route::get('models/{identifier}/predict', 'V1\ApiController@isTrainingModel');
	});
});