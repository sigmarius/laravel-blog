<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);

// авторизация проверяется на guard:admin, по умолчанию guard:web,
// его можно не указывать, просто писать Route::middleware('auth')
Route::middleware('auth')->group(function () {
    Route::resource('articles', ArticleController::class)
        ->middleware('auth')
        ->except(['show']);
});

