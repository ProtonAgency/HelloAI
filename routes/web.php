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

Route::get('/privacy', function () {
    return view('privacy');
});

Route::get('/terms', function () {
    return view('legal');
});

Auth::routes(['register' => false]);

Route::get('/register', function() {
	return redirect()->route('login');
})->name('register');
	
Route::group(['middleware' => ['web', 'auth']], function() {
	Route::get('/logout', 'Auth\LoginController@logout');

	Route::get('/home', function() {
		return redirect()->route('models');
	});

	Route::get('/models', 'DashboardController@viewModels')->name('models');

	Route::get('/models/create', 'DashboardController@createModel')->name('models.create');
	Route::post('/models/create', 'DashboardController@handleCreateModel');

	Route::get('/models/{identifier}/view', 'DashboardController@viewModel')->name('models.view');

	Route::get('/models/{identifier}/delete', 'DashboardController@deleteModel')->name('models.delete');
});

\URL::forceScheme('https');
