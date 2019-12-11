<?php

use Illuminate\Http\Request;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/teste', function () {
    return 'oi';
})->middleware('api');

// Route::post('/register', 'AuthController@register');
// Route::post('/login', 'AuthController@login');
// Route::post('/logout', 'AuthController@logout');


// // Route::middleware(['auth'])->prefix('admin')->namespace('Admin')->group(function(){
// Route::group(['prefix' => 'front', 'namespace' => 'Front'], function (){
    Route::resource('/games', 'GamesController')->middleware('api');
    Route::resource('/matches', 'MatchesController')->middleware('api');
    Route::resource('/matches-users', 'MatchesUsersController')->middleware('api');
    Route::resource('/users', 'UsersController')->middleware('api');

// });







