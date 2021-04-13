<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// USER
Route::group([
    'prefix'        => 'user',
    'as'            => 'user.',      
    'middleware'    => ['auth','user'] 
], function(){
    Route::get('/', [PageController::class, 'index'], 
        
    ); 
    
    
    Route::resource('categories', CategoryController::class, array('except' => array('create', 'edit', 'show')));    
    Route::resource('transactions', TransactionController::class); 
    Route::get('report', [ReportController::class, 'index'])->name('page-report'); 
    Route::post('report', [ReportController::class, 'report'])->name('result-report');
    // Route::post('report/print', [ReportController::class, 'index'])->name('print-report');  
    Route::get('getCategories', [TransactionController::class, 'getCategories'])->name('getCategories');
});   

// ADMIN
Route::group([
    'prefix'        => 'admin',
    'as'            => 'admin.',
    'middleware'    => ['auth','admin'] 
], function(){
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/users', [HomeController::class, 'user'])->name('users'); 
    Route::resource('categories', CategoryController::class, array('except' => array('create', 'edit', 'show')));    
});


