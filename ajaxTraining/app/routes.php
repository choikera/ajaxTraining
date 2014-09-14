<?php
// MAIN CONTROLLER
Route::get('logout', 'MainController@logout');
Route::get('addUser', 'MainController@addUser');
Route::post('deleteUser_{id}', 'MainController@deleteUser');
Route::post('home/newUser', 'MainController@newUser');
Route::get('home', 'MainController@index');
Route::post('home/enterMessage', 'MainController@enterMessage');
Route::post('deleteForm_{id}', 'MainController@deleteMessage');

// LOGIN CONTROLLER
Route::post('doLogin', 'LoginController@doLogin');
Route::get('/', 'LoginController@index');
