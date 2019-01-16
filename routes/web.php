<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function (){

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('member','Rh\memberController')->only(['show']);


    Route::get('params', 'Rh\memberController@params')->name('member.params');
    Route::post('params', 'Rh\MemberController@updateParams')->name('member.update');
    Route::get('psw', 'Rh\MemberController@psw')->name('member.psw');
    Route::post('psw', 'Rh\MemberController@updatePsw')->name('member.psw');


});

