<?php

/*****************************************************
    CORE
 *****************************************************/
Route::prefix('core')->group(function() {
    Route::prefix('auth')->group(function() {
        Route::post('/login', 'Core\Auth\LoginController@login')->name('core.auth.login');
        Route::post('/register', 'Core\Auth\RegisterController@register')->name('core.auth.register');
    });

    Route::prefix('account')->middleware('auth.jwt')->group(function() {
        Route::get('/user', 'Core\Account\UserController@show')->name('core.account.user.show');
        Route::put('/user', 'Core\Account\UserController@update')->name('core.account.user.update');
    });
});

/*****************************************************
    API instances endpoints
 *****************************************************/
