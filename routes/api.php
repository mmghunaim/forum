<?php

use Illuminate\Http\Request;

Route::resource('/questions','QuestionController');

Route::resource('/category','CategoryController');
