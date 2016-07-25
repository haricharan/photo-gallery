<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    Debugbar::info('welcome message');
    return view('welcome');
});

Route::get('/jobtest', function () {
    Debugbar::info('job test');
    return view('test');
});

Route::post('/jobtest', 'TestController@store');

Route::get('/phpinfo', function () {
    return view('phpinfo');
});

// Route::get('foo', function () {
//     Debugbar::info('test');
//     return 'Hello World';
// });

