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
    return '<a class="link" href="/dashboard">Dashboard </a>';
});
//
//// API ROUTES ==================================
//Route::group(array('prefix' => 'api'), function () {
//
//    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
//    Route::post('authenticate', 'AuthenticateController@authenticate');
//    Route::post('/signup', 'AuthenticateController@register');
//
//    Route::group(['middleware' => 'jwt.auth'], function() {
//        Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');
//        Route::resource('accounts', 'AccountController');
//        Route::put('activateAccount/{account_id}', 'AccountController@activateAccount');
//
//    });
//});

Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard', 'namespace' => 'Dashboard'], function () {
    Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

    Route::group(['prefix' => 'instagram', 'namespace' => 'Instagram'] , function() {
        Route::get('/', ['as' => 'instagram.index', 'uses' => 'AccountController@index']);
        Route::get('account', ['as'=>'instagram.accounts.get', 'uses' => 'AccountController@all']);
        Route::delete('account/{ids}', ['as'=>'instagram.accounts.delete', 'uses' => 'AccountController@delete']);
        Route::get('account/create', ['as'=>'instagram.accounts.create', 'uses' => 'AccountController@create']);
        Route::post('account', ['as'=>'instagram.accounts.store', 'uses' => 'AccountController@store']);
    });
});
Route::auth();

Route::get('/home', 'HomeController@index');
