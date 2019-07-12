<?php

use Illuminate\Http\Request;

Route::resource('/question','QuestionController');

Route::resource('/category','CategoryController');

Route::resource('/question/{question}/reply','ReplyController');

Route::post('/question/createuser','QuestionController@createuser');

Route::post('/like/{reply}','LikeController@like');

Route::delete('/like/{reply}','LikeController@unLike');

Route::post('/notifications','NotificationsController@index');
Route::post('/markAsRead','NotificationsController@markAsRead');


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('signup', 'AuthController@signup');
    

});

