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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// after login functions
Route::group([ 'middleware' => [ 'auth'] ] , function () {
  
    Route::get('tasks', 'TaskController@index')->name('view-all-tasks'); 
    Route::get('tasks/new', 'TaskController@create')->name('create-new-task'); 
    Route::post('tasks/new', 'TaskController@store')->name('store-new-task'); 
    Route::get('tasks/{id}/edit', 'TaskController@edit')->name('edit-task'); 
    Route::put('tasks/{id}/update', 'TaskController@update')->name('update-task'); 
    Route::get('tasks/{id}', 'TaskController@destroy')->name('destroy-task');
	 
});