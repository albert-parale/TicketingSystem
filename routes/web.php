<?php

use Illuminate\Support\Facades\Route;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


Route::get('/', function () {
    Auth::logout();
    return redirect('login');
});

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/assigned', 'HomeController@pending');
// Route::get('/resolved', 'HomeController@resolved');
// Route::get('/archived', 'HomeController@archived');


Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user', 'as' => 'user.'], function (){

    Route::get('/', 'UserdashController@index')->name('userdash');

    // Route::get('/userdash', ['uses' => 'UserdashController@index', 'as' => 'user.index']);
    Route::post('/userdash', 'UserdashController@store');
    Route::get('edit/{id}', 'UserdashController@edit')->name('edit');
    

    Route::get('/userpending', ['uses' => 'UserpendingController@index', 'as' => 'user.userpending']);

    Route::get('/userresolved', ['uses' => 'UserresolvedController@index', 'as' => 'user.userresolved']);
    Route::post('update/{id}', 'UserresolvedController@update');

    Route::get('/userdelete', ['uses' => 'UserdeleteController@index', 'as' => 'user.userdelete']);

});


Route::group(['middleware' => ['auth','admin'], 'prefix' => 'admin', 'as' => 'admin.'], function(){
    // Admin Dasboard
    
    Route::get('/dashboard', ['uses'=>'AdminDashController@index', 'as'=>'admin.index']);
    Route::post('update/{id}', 'AdminDashController@update');
    Route::get('dashboard/{id}', 'AdminDashController@edit');
    // End Route Admin Dashboard 

    // Admin Pending Tickets
    Route::get('/Adminpending', ['uses'=>'AdminpendingController@index', 'as'=>'admin.Adminpending']);
    Route::post('update/{id}', 'AdminpendingController@update');
    Route::get('Adminpending/{id}', 'AdminpendingController@edit');
    // End Route Admin Pending Tickets

    // Admin Resolved Tickets
    Route::get('/Adminresolved', ['uses'=>'AdminresolvedController@index', 'as'=>'admin.Adminresolved']);
    Route::post('update/{id}', 'AdminresolvedController@update');
    Route::get('Adminresolved/{id}', 'AdminresolvedController@edit');
    // End Route Admin Resolved Tickets

    // Admin Deleted User Tickets
    Route::get('/Admindeleted', ['uses'=>'AdmindeletedController@index', 'as'=>'admin.Admindeleted']);
    // Route::post('update/{id}', 'AdminresolvedController@update');
    Route::get('Admindeleted/{id}', 'AdmindeletedController@edit');
    // End Route Deleted User Tickets

});
