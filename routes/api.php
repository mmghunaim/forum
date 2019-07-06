<?php

use Illuminate\Http\Request;

Route::resource('/question','QuestionController');

Route::resource('/category','CategoryController');

Route::resource('/question/{question}/reply','ReplyController');

Route::post('/like/{reply}','LikeController@like');

Route::delete('/like/{reply}','LikeController@unLike');

