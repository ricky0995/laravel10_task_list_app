<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index', [

        // the value will be escaped by laravel, so html/script tag will be displayed as string
        // 
        'name' => 'Ricky',
    ]);
    // return view('welcome');
});

// example of named route
Route::get('/hello', function(){
    return 'Hello';
})->name('hello');

// example tp redirect a route to another route
Route::get('/hallo', function(){
    // redirect with normal route url
    // return redirect('/hello');

    // redirect with named route
    return redirect()->route('hello');
});

// dynamic url : example of route(url) with parameter
Route::get('/greet/{name}', function ($name){
    return 'Hello ' . $name . '!';
});

// this is route is triggered when requested url not found
Route::fallback(function(){
    return 'still got somewhere!';
});
