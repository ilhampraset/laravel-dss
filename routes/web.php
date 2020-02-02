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


Route::get('/teslib', function () {
    $pf = new ProfileMatching(0.6, 0.4);
    $pref = [5,4,5,4];
    $pac = [[5,6,4,5], [3,4,5,6], [5,6,4,5], [3,6,3,5]];
    
    return response()->json(["result" => $pf->proces($pref, $pac)]);
});

Route::get('/', function () {
    return view('index');
});

Route::get('/login2', function () {
    return view('auth.login2');
});
Route::get('/register2', function () {
    return view('auth.register2');
});
Auth::routes();


//Route::auth();

Route::group(['middleware' => ['auth']], function() {

    // Route::get('/', function() {
    //     return view('dashboard.index');
    // });

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

    Route::get('/user/profile-acuan','FrontEndController@profileAcuan')->middleware('role:user');

    Route::get('/user/data-profile-diingikan', 'FrontEndController@index' )->middleware('role:user');
    Route::get('/user/data_perangkingan', 'FrontEndController@perangkingan' )->middleware('role:user');
    Route::post('simpan', 'FrontEndController@save');
    Route::post('simpan/{id}', 'FrontEndController@update');
    Route::get('data-profile-diingikan/{id}/edit', 'FrontEndController@edit');
    Route::get('dataprofile', 'FrontEndController@getDataProfile');
    Route::get('dataprofileacuan', 'FrontEndController@getDataProfileReference');
    Route::get('profile', 'FrontEndController@getProfile');
    Route::get('gapmapping', 'FrontEndController@gapMapping');
    Route::get('resultprofilematching', 'FrontEndController@resultProfileMatching');
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


   

 


