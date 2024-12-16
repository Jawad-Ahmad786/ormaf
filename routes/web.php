<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\LocaleMiddleware;

Route::prefix('{locale}')->middleware(LocaleMiddleware::class)->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::prefix('free-signup')->group(function () {
        Route::get('/', [RegisterController::class, 'create'])->name('free-signup.create');
        Route::post('/', [RegisterController::class, 'store'])->name('free-signup.store');
    });
    Route::get('login', [LoginController::class, 'create'])->name('login.create');
    Route::post('login', [LoginController::class, 'store'])->name('login.store');
});

