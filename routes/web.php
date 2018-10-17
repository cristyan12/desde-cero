<?php

Route::view('/', 'home');
Route::get('/users', 'UserController@index')->name('users.index');
Route::get('users/create', 'UserController@create')->name('users.create');
Route::post('users', 'UserController@store')->name('users.store');
Route::get('users/{user}', 'UserController@show')->name('users.show')
    ->where('user', '[0-9]+');
Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::put('users/{user}', 'UserController@update')->name('users.update');
Route::delete('users/{user}', 'UserController@destroy')->name('users.delete');
Route::get('saludos/{name}/{nickname}', 'WelcomeUserController@greetings');
Route::get('saludos/{name}', 'WelcomeUserController@withoutNickname');

Route::get('professions/create', 'ProfessionController@create')->name('professions.create');

Route::get('/professions', 'ProfessionController@index')->name('professions.index');

Route::post('professions', 'ProfessionController@store')->name('professions.store');

Route::get('professions/{profession}', 'ProfessionController@show')->name('professions.show')
    ->where('profession', '[0-9]+');

Route::get('professions/{profession}/edit', 'ProfessionController@edit')->name('professions.edit');

Route::put('professions/{profession}', 'ProfessionController@update')->name('professions.update');

Route::delete('professions/{profession}', 'ProfessionController@destroy')->name('professions.delete');


