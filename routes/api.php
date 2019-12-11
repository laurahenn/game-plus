<?php

use Illuminate\Http\Request;

// Route::post('/register', 'AuthController@register');

Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');

Route::get('/teste', function () {
    return 'oi';
})->middleware('api');

Route::resource('/games', 'GamesController')->middleware('api');
Route::resource('/matches', 'MatchesController')->middleware('api');
Route::resource('/matches-users', 'MatchesUsersController')->middleware('api');
Route::resource('/users', 'UsersController')->middleware('api');








