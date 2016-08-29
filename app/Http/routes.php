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


// Route::auth();

// Auth Route

Route::group(['as' => 'auth.'], function () {
    Route::get('/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
    Route::post('/login', ['as' => 'login.post', 'uses' => 'Auth\AuthController@postLogin']);

    Route::get('/register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
    Route::post('/register', ['as' => 'register.post', 'uses' => 'Auth\AuthController@postRegister']);

    Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);
});


Route::get('/home', ['as' => 'home', 'uses' =>'HomeController@index']);

Route::get('/social/redirect/{provider}',   ['as' => 'social.redirect',   'uses' => 'Auth\AuthController@redirectToSocialProvider']);
Route::get('/social/handle/{provider}',     ['as' => 'social.handle',     'uses' => 'Auth\AuthController@handleSocialProviderCallback']);
