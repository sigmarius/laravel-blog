<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);

Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'authenticate')->name('login');

        Route::get('/register', 'register')->name('register');
        Route::post('/register', 'store')->name('register');
    });
});

// авторизация проверяется на guard:admin, по умолчанию guard:web,
// его можно не указывать, просто писать Route::middleware('auth')
Route::middleware('auth')->group(function () {
    Route::resource('articles', ArticleController::class)
        ->middleware('auth')
        ->except(['show']);

    Route::controller(AuthController::class)->group(function () {
        Route::delete('/logout', 'logout')->name('logout');
    });
});

