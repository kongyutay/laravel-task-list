<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Main page';
    // return view('welcome');
});

Route::get('/hello', function () {
    return 'hello' ;
})->name('hello');

// Redirect routing
Route::get('/hallo', function () {
    // redirect funciton returns an object so may direct access something inside
    // return redirect('/hello') ;
    return redirect()->route('hello') ;
});

Route::get('/greet/{name}', function ($name) {
    return 'hello ' . $name . '!';
});

// 虽然内建了404页面，但是这个可以依然带去这个地方
Route::fallback(action: function () {
    return 'Still got somewhere!' ;
});
