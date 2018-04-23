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
	Route::get('/create/{tournament}', 'AdminController@createTournaments')->name('admin.create');
	Route::get('/manage', 'AdminController@manageTournaments')->name('admin.manage');
	Route::get('/current/{tournament}', 'AdminController@currentTournament')->name('admin.current');
});

// vvv PlayersController vvv
Route::get('/delete/{id}', 'PlayersController@delete');
Route::get('/playerUpdateWin/{id}', 'PlayersController@updateWin');
Route::post('/addname', 'PlayersController@add');
Route::post('/tournament', 'PlayersController@add');
Route::post('/playerUpdate', 'PlayersController@update');

// vvv TournamentController vvv
Route::post('/createTournament', 'TournamentController@create');
Route::post('/endTournament', 'TournamentController@end');

// vvv CurrentGameController vvv
Route::get('/startTournament/{tournament}', 'CurrentGameController@index');
Route::get('/nextGame/{tournament}', 'CurrentGameController@nextGame')->name('nextGame');
Route::get('/reShuffle/{tournament}', 'CurrentGameController@reShuffle')->name('reShuffle');



// vvv TestPageController vvv
Route::get('/formTest/{tournament}', 'TestPageController@formTest')->name('formTest');

// vvv DevHelperController vvv 
Route::prefix('dev')->group(function() {
	Route::get('/', 'DevHelperController@index');
	Route::get('/addPlayers/{amount}', 'DevHelperController@addPlayers');
	Route::get('/empty/{table}', 'DevHelperController@empty');
});