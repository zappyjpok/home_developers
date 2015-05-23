<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index')->before('auth.basic');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

// Routes for Features Controller

/*
Route::get('features', 'FeatureController@index');
Route::get('features/create', 'FeatureController@create');
Route::get('features/{id}', 'FeatureController@show');
Route::post('features', 'FeatureController@store');
Route::patch('features/{id}/edit', 'FeatureController@edit');
*/

Route::resource('features', 'FeatureController');
Route::resource('houses', 'HouseController');

// Routes for Feature Image Controller
Route::get('feature/image/create', 'FeatureImagesController@create');
Route::post('features/image/store', 'FeatureImagesController@store');

// Routes for the House Image Controller
Route::get('house/image/create', 'HouseImagesController@create');
Route::post('house/image/store', 'HouseImagesController@store');


// test routes
//Route::get('foo', 'HouseController@foo');