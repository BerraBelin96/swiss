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
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function() {
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/', 'AdminController@index')->name('admin.dashboard');
	Route::get('/create', 'AdminController@createTournaments')->name('admin.create');
	Route::get('/manage', 'AdminController@manageTournaments')->name('admin.manage');
	Route::get('/current', 'AdminController@currentTournament')->name('admin.current');
	//Route::get('/startTournament', 'CurrentGameController@index')->name('admin.startTournament');
});

//Route::get('/admin', 'PlayersController@index');

Route::get('/delete/{id}', 'PlayersController@delete');

Route::post('/addname', 'PlayersController@add');

Route::post('/tournament', 'PlayersController@add');

Route::get('/startTournament', 'CurrentGameController@index');
Route::get('/nextGame', 'CurrentGameController@nextGame');

Route::get('/formTest', 'PlayersController@formTest');
Route::post('/playerUpdate', 'PlayersController@update');
Route::get('/playerUpdateWin/{id}', 'PlayersController@updateWin');




// vvv DevHelperController vvv 
Route::prefix('dev')->group(function() {
	Route::get('/', 'DevHelperController@index');
	Route::get('/addPlayers/{amount}', 'DevHelperController@addPlayers');
	Route::get('/empty/{table}', 'DevHelperController@empty');
});