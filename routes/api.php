<?php

use Illuminate\Http\Request;

Route::resource('/question','QuestionController');

Route::resource('/category','CategoryController');

Route::resource('/question/{question}/reply','ReplyController');
