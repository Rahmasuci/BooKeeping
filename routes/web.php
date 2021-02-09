<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group([
    'prefix'        => 'user' ,
    'as'            => 'user.',      
    'middleware'    => ['auth','user'] 
], function(){
    Route::get('/', [App\Http\Controllers\PageController::class, 'index']);
   
});

// ADMIN
Route::group([
    'prefix'        => 'admin',
    'as'            => 'admin.',
    'middleware'    => ['auth','admin'] 
], function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);    
});


