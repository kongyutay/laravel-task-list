<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Main page';
    // return view('welcome');
});

Route::get('/hello', function () {
    return 'hello' ;
});

Route::get('/greet/{name}', function ($name) {
    return 'hello ' . $name . '!'; 
});