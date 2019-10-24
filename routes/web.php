<?php

Route::get('/dev-tools/swagger-file','DevTools\DocsController@file')->name('swagger-file');
Route::get('/dev-tools/docs','DevTools\DocsController@docsForm')->name('swagger-form');
