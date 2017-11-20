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

Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
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

    Route::group(['prefix' => 'artisans', 'as' => 'artisans.'], function () {
        Route::resource('', 'ArtisanController', [
            'only' => [
                'index',
                'create',
                'store',
                'edit',
                'update',
                'destroy',
            ],
            'parameters' => [
                '' => 'user',
            ],
        ]);

        Route::resource('skills', 'SkillController', [
            'only' => [
                'index',
                'create',
                'store',
                'edit',
                'update',
                'destroy',
            ],
        ]);
    });
});

Route::resource('cities', 'CityController', [
    'only' => [
        'index',
        'create',
        'store',
        'edit',
        'update',
        'destroy',
    ],
]);
