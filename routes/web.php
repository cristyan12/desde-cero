<?php

Route::view('/', 'welcome');

Route::get('/users', 'UserController@index');

Route::get('users/new', 'UserController@create');

Route::get('users/{id}', 'UserController@show')
    ->where('id', '[0-9]+');

Route::get('users/{id}/edit', 'UserController@edit');

Route::get('saludos/{name}/{nickname}', 'WelcomeUserController@greetings');

Route::get('saludos/{name}', 'WelcomeUserController@withoutNickname');

