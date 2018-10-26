<?php

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});
//->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('activities', 'ActivityController')->middleware('verified');
Route::resource('events', 'EventController')->middleware('verified');
Route::resource('subscriptions', 'SubscriptionController')->middleware('verified')->middleware('auth');

