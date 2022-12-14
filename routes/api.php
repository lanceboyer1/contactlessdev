<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([], function () {
    Route::resource('/', 'API\BaseController');
    Route::resource('validate', 'API\ValidateUserInputController');
    Route::resource('validateregister', 'API\ValidateRegisterController');
    Route::resource('validateuserupdate', 'API\ValidateUserUpdateController');
});

Route::group([
    'prefix' => '/progresslink'
], function() {
    Route::patch('/update', 'API\ProgressLinks\ProgressLinksController@update')->name('progresslink.update');
    Route::post('/', 'API\ProgressLinks\ProgressLinksController@store')->name('progresslink.store');
    Route::get('/{key}', 'API\ProgressLinks\ProgressLinksController@show')->name('progresslink.show');
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});
