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
    return view('index');
});

// API ROUTES ==================================
Route::group(array('prefix' => 'api'), function () {

    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
    Route::post('authenticate', 'AuthenticateController@authenticate');
    Route::post('/signup', 'AuthenticateController@register');

    Route::group(['middleware' => 'jwt.auth'], function() {
        Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');
        Route::resource('accounts', 'AccountController');
        Route::put('activateAccount/{account_id}', 'AccountController@activateAccount');

    });
});
