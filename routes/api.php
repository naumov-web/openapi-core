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

        // Projects
        Route::prefix('projects')->group(function(){
            Route::get('', 'Core\Account\ProjectsController@index')->name('core.account.projects.index');
            Route::post('', 'Core\Account\ProjectsController@create')->name('core.account.projects.create');

            Route::middleware('check.project-owner')->group(function(){
                Route::get('/{project}', 'Core\Account\ProjectsController@show')
                    ->name('core.account.projects.show');
                Route::put('/{project}', 'Core\Account\ProjectsController@update')
                    ->name('core.account.projects.update');
                Route::delete('/{project}', 'Core\Account\ProjectsController@delete')
                    ->name('core.account.projects.delete');

                // Project entities
                Route::prefix('{project}/entities')->group(function(){
                    Route::post('', 'Core\Account\ProjectEntitiesController@create')
                        ->name('core.account.project-entities.create');
                    Route::get('', 'Core\Account\ProjectEntitiesController@index')
                        ->name('core.account.project-entities.index');
                });
            });
        });
    });

    Route::prefix('handbooks')->group(function() {
        Route::get('/public/all', 'Core\Handbooks\PublicController@all')->name('core.handbooks.public.all.show');
    });
});

/*****************************************************
    API instances endpoints
 *****************************************************/
