<?php

use App\Lib\Mahasiswa;
use App\Lib\ProfileMatching;
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

//Route::get('hello', 'LatihanController@index');



Route::get('/', function () {
    return view('welcome');
});


Auth::routes();


//Route::auth();

Route::group(['middleware' => ['auth']], function() {

    Route::get('/', function() {
        return view('dashboard.index');
    });

     Route::get('/dashboard', function(){
        return view('dashboard.index');
    });

  
   
    Route::resource('individu', 'IndividuController');
    Route::get('individudata', 'IndividuController@listData');

    Route::resource('kriteria', 'KriteriaController');
    Route::get('kriteriadata', 'KriteriaController@listData');

    Route::resource('sub_kriteria', 'SubkriteriaController');
    Route::get('sub_kriteriadata', 'SubkriteriaController@listData');

    Route::resource('parameter_sub_kriteria', 'ParametersubkriteriaController');
    Route::get('parameter_sub_kriteriadata', 'ParametersubkriteriaController@listData');

    Route::get('/user/home', function(){
        return view('user/index');      
        })->middleware('role:user');

    Route::get('/user/kriteria', function(){
        return view('user/kriteria');      
        })->middleware('role:user');

    Route::get('/user/data_dan_perhitungan', 'FrontEndController@index' )->middleware('role:user');
    Route::post('simpan', 'FrontEndController@save');
    Route::get('dataprofile', 'FrontEndController@getDataProfile');
    Route::get('profile', 'FrontEndController@testGet');
});


/*Route::group(['middleware' => ['auth', 'role:user']], function() {

     Route::get('/', function(){
        return view('user/index');      
        });

     Route::get('/home', function(){
        return view('user/index');      
        });

    




});


*/


   

 


