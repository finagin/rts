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

Route::get('/home', 'HomeController@index')
    ->name('home');

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

    Route::resource('artisans', 'ArtisanController', [
        'only' => [
            'index',
            'create',
            'store',
            'edit',
            'update',
            'destroy',
        ],
        'parameters' => [
            'artisans' => 'user',
        ],
    ]);
});

Route::resource('cities', 'CityController', [
    'only' => [
        'index',
        'edit',
        'update',
    ],
]);

Route::resource('areas', 'AreaController', [
    'only' => [
        'index',
        'create',
        'store',
        'edit',
        'update',
        'destroy',
    ],
]);

Route::get('test', function () {
    dd(\App\Models\Area::descendantsAndSelf(3));

    $node_1 = \App\Models\Area::create(['title' => 'Node #1']);
    $node_2 = \App\Models\Area::create(['title' => 'Node #2']);
    $node_3 = \App\Models\Area::create(['title' => 'Node #3']);
    $node_4 = \App\Models\Area::create(['title' => 'Node #4']);

    $node_1->appendNode($node_2);
    $node_2->appendNode($node_3);
    $node_1->appendNode($node_4);
});
