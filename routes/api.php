<?php

/*****************************************************
    CORE
 *****************************************************/
Route::prefix('core')->group(function() {
    Route::prefix('auth')->group(function() {
        Route::post('/register', 'Core\Auth\RegisterController@register')->name('core.auth.register');
    });
});

/*****************************************************
    API instances endpoints
 *****************************************************/
