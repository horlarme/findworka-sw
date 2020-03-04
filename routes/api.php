<?php

use Illuminate\Support\Facades\Route;

Route::get('/movies', 'MovieController@fetch');
Route::get('/movie/{episode}', 'MovieController@single')->middleware('movie');
Route::post('/movies/{episode}/comment', 'CommentController@comment')->middleware('movie');
Route::get('/movies/{episode}/comments', 'CommentController@list')->middleware('movie');
