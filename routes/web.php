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

Route::group(['prefix' => 'users', 'as' => 'users.',], function () {
    Route::resource('managers', 'ManagerController', [
        'only' => [
            'index',
            'create',
            'store',
            'edit',
            'update',
            'destroy',
        ],
        'parameters' => [
            'managers' => 'user',
        ],
    ]);
});
