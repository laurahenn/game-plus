<?php

use Illuminate\Http\Request;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/teste', function () {
    return 'oi';
});

// Route::post('/register', 'AuthController@register');
// Route::post('/login', 'AuthController@login');
// Route::post('/logout', 'AuthController@logout');


// // Route::middleware(['auth'])->prefix('admin')->namespace('Admin')->group(function(){
// Route::group(['prefix' => 'front', 'namespace' => 'Front'], function (){
    Route::resource('/games', 'GamesController');
    Route::resource('/matches', 'MatchesController');
    Route::resource('/matches-users', 'MatchesUsersController');
    Route::resource('/users', 'UsersController');

// });







