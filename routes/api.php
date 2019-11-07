<?php

/*****************************************************
    CORE
 *****************************************************/
Route::prefix('core')->group(function() {
    Route::prefix('auth')->group(function() {
        Route::post('/login', 'Core\Auth\LoginController@login')->name('core.auth.login');
        Route::post('/register', 'Core\Auth\RegisterController@register')->name('core.auth.register');
    });
});

/*****************************************************
    API instances endpoints
 *****************************************************/
