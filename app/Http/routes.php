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

Route::group(['middleware' => 'auth:,administrator', 'as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::get('jobtest', function () {
        Debugbar::info('job test');
        return view('test');
    });
    Route::post('jobtest', 'TestController@store');

    Route::get('phpinfo', function () {
        return view('phpinfo');
    })->name('phpinfo');
});

Route::group(['as' => 'auth.', 'prefix' => '/'], function () {
    Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
    Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\AuthController@postLogin']);

    Route::get('register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
    Route::post('register', ['as' => 'register.post', 'uses' => 'Auth\AuthController@postRegister']);

    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', 'HomeController@index')->name('user.home');
    Route::get('profile', 'ProfileController@index')->name('user.profile');
    Route::post('profile', 'ProfileController@update')->name('user.profile');
});

Route::group(['as' => 'social.', 'prefix' => 'social'], function () {
    Route::get('redirect/{provider}',   ['as' => 'redirect',   'uses' => 'Auth\AuthController@redirectToSocialProvider']);
    Route::get('handle/{provider}',     ['as' => 'handle',     'uses' => 'Auth\AuthController@handleSocialProviderCallback']);
});
