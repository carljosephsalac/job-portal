<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobPortalController;

Route::get('/', function () {
    return view('auth.login');
});

Route::controller(AuthController::class)->group(function() {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'loginUser')->name('loginUser')->middleware('throttle:3,1');
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'registerUser')->name('registerUser');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth');
});

Route::controller(JobPortalController::class)->group(function() {
    Route::middleware('auth')->group(function() {
        Route::get('/job-portals', 'index')->name('job-portals.index');
    });
});
