<?php
Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/cliente', 'ClienteController@index');
