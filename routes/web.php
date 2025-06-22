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
        Route::get('/job-portals/create', 'create')->name('job-portals.create');
        Route::get('/job-portals', 'index')->name('job-portals.index');
        Route::post('/job-portals', 'store')->name('job-portals.store');
        Route::get('/job-portals/{id}', 'show')->name('job-portals.show');
        Route::get('/job-portals/edit/{id}', 'edit')->name('job-portals.edit');
        Route::patch('/job-portals/update/{id}', 'update')->name('job-portals.update');
        Route::delete('/job-portals/destroy/{id}', 'destroy')->name('job-portals.destroy');
    });
});
