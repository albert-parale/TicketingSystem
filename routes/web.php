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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user', 'as' => 'user.'], function (){

    Route::get('/userdash', 'UserdashController@index')->name('userdash');
    Route::post('userdash/store', 'UserdashController@store');
    Route::get('edit/{id}', 'UserdashController@edit')->name('edit');
    Route::post('update/{id}', 'UserdashController@update');

    Route::get('/userpending', 'UserpendingController@index')->name('userpending');

    Route::get('/userresolved', 'UserresolvedController@index')->name('userresolved');
    Route::post('update/{id}', 'UserresolvedController@update');

    Route::get('/userdelete', 'UserdeleteController@index')->name('userdelete');

});


Route::group(['middleware' => ['auth','admin'], 'prefix' => 'admin', 'as' => 'admin.'], function(){
    // Admin Dasboard

    Route::get('/dashboard', 'AdminDashController@index')->name('dashboard');
    Route::get('dashboard/{id}', 'AdminDashController@edit');
    Route::post('update/{id}', 'AdminDashController@update');
    // End Route Admin Dashboard 

    // Admin Pending Tickets
    Route::get('/Adminpending', 'AdminpendingController@index')->name('Adminpending');
    Route::get('Adminpending/{id}', 'AdminpendingController@edit');
    Route::post('update/{id}', 'AdminpendingController@update');
    // End Route Admin Pending Tickets

    // Admin Resolved Tickets
    Route::get('/Adminresolved', 'AdminresolvedController@index')->name('Adminresolved');
    Route::get('Adminresolved/{id}', 'AdminresolvedController@edit');
    Route::post('update/{id}', 'AdminresolvedController@update');
    // End Route Admin Resolved Tickets

    // Admin Deleted User Tickets
    Route::get('/Admindeleted', 'AdmindeletedController@index')->name('Admindeleted');
    Route::get('Admindeleted/{id}', 'AdmindeletedController@edit');
    // End Route Deleted User Tickets

});
