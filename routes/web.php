<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function (){

    Route::get('/home', 'HomeController@index')->name('home');

    Route::namespace('Rh')->group(function (){

        Route::resource('member','MemberController')->only(['show']);

        Route::get('params', 'MemberController@params')->name('member.params');
        Route::post('params', 'MemberController@updateParams')->name('member.update');

        Route::get('psw', 'MemberController@psw')->name('member.psw');
        Route::post('psw', 'MemberController@updatePsw')->name('member.psw');

    });

    Route::resource('token','Premium\TokenController')->except(['edit', 'update', 'show']);


});

