<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

// Change Language
Route::post('language/', array('before' => 'csrf', 'as' => 'language-chooser', 'uses' => 'LanguageController@changeLanguage'));


Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function (){

    Route::get('notifications','notificationController@index')->name('notification.index');
    Route::post('notifications','notificationController@read')->name('notification.read');
    Route::delete('notifications','notificationController@destroy')->name('notification.destroy');

    Route::middleware('member')->group(function (){

        Route::get('/home', 'HomeController@index')->name('home');

        Route::middleware(['premium'])->group(function (){

            Route::namespace('Rh')->group(function (){

                Route::resource('member','MemberController')->only(['show', 'index']);

                Route::get('params', 'MemberController@params')->name('member.params');
                Route::post('params', 'MemberController@updateParams')->name('member.update');

                Route::get('psw', 'MemberController@psw')->name('member.psw');
                Route::post('psw', 'MemberController@updatePsw')->name('member.psw');

                Route::get('{member}/member/range','MemberController@range')->name('member.range');
                Route::put('{member}/member/range', 'MemberController@updateRange')->name('member.range.update');

                Route::get('{member}/member/status', 'MemberController@status')->name('member.status');
                Route::put('{member}/member/status', 'MemberController@updateStatus')->name('member.status.update');

                Route::resource('position', 'PositionController');
            });

            Route::resource('token','Premium\TokenController')->except(['edit', 'update', 'show']);

        });

    });


    Route::middleware(['admin'])->namespace('Admin')->group(function (){


        Route::get('admin/params','AdminController@params')->name('admin.params');
        Route::put('admin/params','AdminController@updateParams')->name('admin.params.update');

        Route::resource('admin','AdminController')->except(['edit', 'update']);

        Route::resource('company', 'CompanyController');

        Route::get('company/{company}/sold', 'CompanyController@sold')->name('company.sold');
        Route::put('company/{company}/sold', 'CompanyController@updateSold')->name('company.updateSold');

        Route::get('company/{company}/status', 'CompanyController@status')->name('company.status');
        Route::put('company/{company}/status', 'CompanyController@updateStatus')->name('company.updateStatus');

    });

});

