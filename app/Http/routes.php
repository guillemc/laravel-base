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

Route::get('/', 'SiteController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');

// Authentication Routes...
Route::get('/login', 'Auth\AuthController@showLoginForm')->name('login');
Route::post('/login', 'Auth\AuthController@login')->name('login_action');
Route::get('/logout', 'Auth\AuthController@logout')->name('logout');

// Registration Routes...
Route::get('/register', 'Auth\AuthController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\AuthController@register')->name('register_action');

// Password Reset Routes...
Route::get('/password/email', 'Auth\PasswordController@showLinkRequestForm')->name('forgot_password');
Route::post('/password/email', 'Auth\PasswordController@sendResetLinkEmail')->name('forgot_password_action');
Route::get('/password/reset/{token?}', 'Auth\PasswordController@showResetForm')->name('reset_password');
Route::post('/password/reset', 'Auth\PasswordController@reset')->name('reset_password_action');


// ADMIN ROUTES
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin::'], function () {

    Route::get('/', 'SiteController@index')->name('home');
    Route::get('/profile', 'ProfileController@index')->name('profile');

    // Authentication Routes...
    Route::get('/login', 'Auth\AuthController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\AuthController@login')->name('login_action');
    Route::get('/logout', 'Auth\AuthController@logout')->name('logout');

    // Password Reset Routes...
    Route::get('/password/email', 'Auth\PasswordController@showLinkRequestForm')->name('forgot_password');
    Route::post('/password/email', 'Auth\PasswordController@sendResetLinkEmail')->name('forgot_password_action');
    Route::get('/password/reset/{token?}', 'Auth\PasswordController@showResetForm')->name('reset_password');
    Route::post('/password/reset', 'Auth\PasswordController@reset')->name('reset_password_action');

});