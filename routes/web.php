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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/docs', function () {
    return view('documentation');
});

Auth::routes();
	
Route::group(['middleware' => ['web', 'auth']], function() {
	Route::get('/logout', 'Auth\LoginController@logout');

	Route::get('/home', function() {
		return redirect()->route('models');
	});

	Route::get('/models', 'DashboardController@viewModels')->name('models');

	Route::get('/models/create', 'DashboardController@createModel')->name('models.create');
	Route::post('/models/create', 'DashboardController@handleCreateModel');

	Route::get('/models/{identifier}/view', 'DashboardController@viewModel')->name('models.view');
});

\URL::forceScheme('https');
