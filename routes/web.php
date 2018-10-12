<?php

Route::view('/', 'home');

Route::get('/users', 'UserController@index')
    ->name('users.index');

Route::get('users/create', 'UserController@create')
    ->name('users.create');

Route::post('users', 'UserController@store')
    ->name('users.store');

Route::get('users/{user}', 'UserController@show')
    ->where('user', '[0-9]+')
    ->name('users.show');

Route::get('users/{user}/edit', 'UserController@edit')
    ->name('users.edit');

Route::put('users/{user}', 'UserController@update')
    ->name('users.update');

Route::delete('users/{user}', 'UserController@destroy')
    ->name('users.delete');

Route::get('saludos/{name}/{nickname}', 'WelcomeUserController@greetings');

Route::get('saludos/{name}', 'WelcomeUserController@withoutNickname');

