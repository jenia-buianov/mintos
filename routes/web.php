<?php


Route::get('/',function (){
    return redirect('register');
});

Route::get('login','AuthController@showLoginForm')->name('login');
Route::get('register','AuthController@showRegisterForm')->name('register');
Route::get('home','HomeController@index')->name('home');
Route::post('checkEmail','AuthController@checkEmail')->name('check');
Route::post('register','AuthController@register');
Route::post('login','AuthController@login');
