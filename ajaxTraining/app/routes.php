<?php

Route::get('/', 'LoginController@index');
Route::post('doLogin', 'LoginController@doLogin');