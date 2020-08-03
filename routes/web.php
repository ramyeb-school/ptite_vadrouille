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

// Routes temporaire. Nous permettre de remplir ou tester la bd
// Route::get('place/create/{name}-{type}', 'PlaceController@create')->name('Place.create');
// Route::get('/place/delete/{id}', 'PlaceController@destroy')->name('Place.delete');
// Route::get('/place', 'PlaceController@index')->name('Place');
// Route::get('/test/fav/a-{id}', 'PlaceController@attachFavorite');
// Route::get('/test/fav/d-{id}', 'PlaceController@detachFavorite');
// Route::get('/test/com/a-{id}', 'PlaceController@attachCompleted');
// Route::get('/test/com/d-{id}', 'PlaceController@detachCompleted');
// Route::get('/zoubidou', 'UserController@index');
// Route::get('/zoubidou/{id}', 'UserController@show');
// Route::get('/destroy', 'UserController@destroy');

// Front page...
Route::get('/', 'FrontController@index')->name('front');
Route::get('/front', 'FrontController@index')->name('front');

//Classement Routes...
Route::get('/classement', 'UserController@index')->name('classement');

//home routes
Route::get('/home', 'HomeController@index')->name('home');              
Route::post('/home', 'HomeController@placeFromDep')->name('home.post');

// ------------ACCOUNT----------------------

// Authentication Routes...
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

//--------------PLACES---------------------

//Attach places
Route::post('/home-attach-fav', 'PlaceController@attachFavorite')->name('home.attach.favorite');
Route::post('/home-attach-com', 'PlaceController@attachCompleted')->name('home.attach.completed');

//Detach places
Route::post('/home-detach-fav', 'PlaceController@detachFavorite')->name('home.detach.favorite');
Route::post('/home-detach-com', 'PlaceController@detachCompleted')->name('home.detach.completed');

// Create Places 
Route::get('place/create/', 'PlaceController@create')->name('Place.create.form');
Route::post('place/create/', 'PlaceController@store')->name('Place.create');      




// Password Reset Routes...
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');

