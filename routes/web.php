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
    return view('auth/login');
});



Auth::routes();

Route::get('dashboard', function(){
	return view('dashboard.index');
})->middleware('auth');;

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('individu', 'IndividuController');
Route::get('individudata', 'IndividuController@listData');

Route::resource('kriteria', 'KriteriaController');
Route::get('kriteriadata', 'KriteriaController@listData');

Route::resource('sub_kriteria', 'SubkriteriaController');
Route::get('sub_kriteriadata', 'SubkriteriaController@listData');

Route::resource('parameter_sub_kriteria', 'ParametersubkriteriaController');
Route::get('parameter_sub_kriteriadata', 'ParametersubkriteriaController@listData');