<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// USER
Route::group([
    'prefix'        => 'user' ,
    'as'            => 'user.',      
    'middleware'    => ['auth','user'] 
], function(){
    Route::get('/', [PageController::class, 'index']);
   
});

// ADMIN
Route::group([
    'prefix'        => 'admin',
    'as'            => 'admin.',
    'middleware'    => ['auth','admin'] 
], function(){
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/users', [HomeController::class, 'user'])->name('users');
    Route::resource('transactions', TransactionController::class);    
    Route::resource('categories', CategoryController::class);    
});


