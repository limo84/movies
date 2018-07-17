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



Auth::routes();

Route::get('/', function () {return redirect('/home'); });

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/movies', 'MovieController@index');
Route::get('/movies/create', 'MovieController@create');
Route::post('/movies/create', 'MovieController@store');
Route::get('/movies/search', 'MovieController@search');
Route::get('/movies/detailsByTitle/{title}', 'MovieController@detailsByTitle');
Route::get('movies/show/{title}', 'MovieController@show');

Route::get('/movies/edit/{movie}', 'MovieController@edit')->where('movie', '[0-9]+');
Route::post('/movies/update/{movie}', 'MovieController@update')->where('movie', '[0-9]+');
Route::post('/movies/delete/{movie}', 'MovieController@delete')->where('movie', '[0-9]+');
Route::post('/movies/rate/{movie}', 'MovieController@rate')->where('movie', '[0-9]+');
//Route::get('/movies')

//Route::get('http://www.omdbapi.com/?apikey=f6eba24b&s=Star')


Route::get('/regisseurs', 'RegisseurController@index');
Route::get('/regisseurs/create', 'RegisseurController@create');
Route::post('/regisseurs/create', 'RegisseurController@store');
Route::get('/regisseurs/{regisseur}', 'RegisseurController@show')->where('regisseur', '[0-9]+');

Route::post('/regisseurs/delete/{regisseur}', 'RegisseurController@delete')->where('regisseur', '[0-9]+');
Route::get('/regisseurs/search', 'RegisseurController@search');

Route::get('/regisseurs/edit/{regisseur}', 'RegisseurController@edit')->where('regisseur', '[0-9]+');
Route::post('/regisseurs/update/{regisseur}', 'RegisseurController@update')->where('regisseur', '[0-9]+');

Route::get('/genres', 'GenreController@index');
Route::get('/genres/create', 'GenreController@create');
Route::post('/genres/create', 'GenreController@store');

