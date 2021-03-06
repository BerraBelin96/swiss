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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/history', 'HomeController@history')->name('history');
Route::get('/history/{tournament}', 'HomeController@historyTournament');

Route::prefix('admin')->group(function() {
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/', 'AdminController@index')->name('admin.dashboard');
	Route::get('/create/{tournament}', 'AdminController@createTournaments')->name('admin.create');
	Route::get('/manage', 'AdminController@manageTournaments')->name('admin.manage');
	Route::get('/current/{tournament}', 'AdminController@currentTournament')->name('admin.current');
	Route::get('/history', 'AdminController@history')->name('admin.history');
	Route::get('/history/{tournament}', 'AdminController@historyTournament');
	Route::get('/addAdmin', 'AdminController@showAddForm')->name('admin.add');
	Route::post('/addAdmin', 'AdminController@addAdmin')->name('admin.add.submit');
	Route::get('/stopTournament/{tournament}', 'AdminController@stop')->name('stopTournament');
});

// vvv HomeController vvv
Route::get('/current/{tournament}', 'HomeController@current');

// vvv PlayersController vvv
Route::get('/delete/{id}', 'PlayersController@delete');
Route::get('/playerUpdateWin/{id}', 'PlayersController@updateWin');
Route::post('/addname', 'PlayersController@add');
Route::post('/tournament', 'PlayersController@add');
Route::post('/playerUpdate', 'PlayersController@update');
Route::post('/searchPlayer', 'PlayersController@search')->name('searchPlayer');
Route::post('/playerSetTournament', 'PlayersController@setTournament')->name('playerSetTournament');

// vvv TournamentController vvv
Route::post('/createTournament', 'TournamentController@create');
Route::get('/endTournament/{tournament}', 'TournamentController@end')->name('endTournament');

// vvv CurrentGameController vvv
Route::get('/startTournament/{tournament}', 'CurrentGameController@index');
Route::get('/nextGame/{tournament}', 'CurrentGameController@nextGame')->name('nextGame');
Route::get('/reShuffle/{tournament}', 'CurrentGameController@reShuffle')->name('reShuffle');
Route::get('/printGame/{tournament}', 'CurrentGameController@printGame')->name('printGame');
