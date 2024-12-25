<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\WelcomeController;
use App\Http\Middleware\LocaleMiddleware;
use Illuminate\Support\Facades\App;

Route::prefix('{locale}')->middleware(LocaleMiddleware::class)->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::prefix('free-signup')->group(function () {

        Route::get('/', [RegisterController::class, 'create'])->name('free-signup.create');
        Route::post('/', [RegisterController::class, 'store'])->name('free-signup.store');
    });

    Route::get('login', [LoginController::class, 'create'])->name('login.create');
    Route::post('login', [LoginController::class, 'store'])->name('login.store');

    Route::get('welcome', [WelcomeController::class, 'index'])->name('welcome');
    Route::get('wiz1', [WelcomeController::class, 'wizOne'])->name('wiz1');
    Route::get('wiz2', [WelcomeController::class, 'wizTwo'])->name('wiz2');
    Route::get('wiz3', [WelcomeController::class, 'wizThree'])->name('wiz3');
    Route::get('wiz4', [WelcomeController::class, 'wizFour'])->name('wiz4');
    Route::get('wiz-end', [WelcomeController::class, 'wizEnd'])->name('wiz.end');

    Route::get('subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::get('subscriptions/modules', [SubscriptionController::class, 'modules'])->name('subscriptions.modules');
    Route::get('subscriptions/plans', [SubscriptionController::class, 'plans'])->name('subscriptions.plans');
    Route::get('subscriptions/info', [SubscriptionController::class, 'info'])->name('subscriptions.info');
});

Route::get('/', function () {
    $locale = App::getLocale(); // Get the default locale
    return redirect($locale);
});
