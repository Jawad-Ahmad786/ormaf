<?php

use App\Http\Controllers\DepartmentsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ObjectivesController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\ProgramsController;

// Login/Logout Routes
Route::get('login', [LoginController::class, 'create'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'store'])->name('login')->middleware('guest');
Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Email Verification Notice
Route::get('email/verify', [EmailVerificationController::class, 'notice'])
    ->middleware('auth')
    ->name('verification.notice');

// Email Verification
Route::get('email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

// Resend Email Verification Link
Route::post('email/resend', [EmailVerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.resend');

// Group Routes by Locale
Route::prefix('{locale}')->middleware(['locale'])->group(function () {
    // Public Routes
    Route::get('/', [HomeController::class, 'index'])
        ->name('home')
        ->withoutMiddleware(['auth', 'verified']); // Home route accessible to everyone

    Route::prefix('free-signup')->group(function () {
        Route::get('/', [RegisterController::class, 'create'])
            ->name('free-signup.create')
            ->middleware('guest'); // Signup page for unauthenticated users
        Route::post('/', [RegisterController::class, 'store'])
            ->name('free-signup.store')
            ->middleware('guest');
    });
        Route::get('/locations/states/{countryId}', [LocationsController::class, 'getStates'])
             ->middleware('guest');
        Route::get('/locations/cities/{stateId}', [LocationsController::class, 'getCities'])
            ->middleware('guest');

    // Authenticated User Routes
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('welcome', [WelcomeController::class, 'index'])->name('welcome');
        Route::get('wiz1', [WelcomeController::class, 'wizOne'])->name('wiz1');
        Route::get('wiz2', [WelcomeController::class, 'wizTwo'])->name('wiz2');
        Route::get('wiz3', [WelcomeController::class, 'wizThree'])->name('wiz3');
        Route::get('wiz4', [WelcomeController::class, 'wizFour'])->name('wiz4');
        Route::get('wiz-end', [WelcomeController::class, 'wizEnd'])->name('wiz.end');

    // Subscription Routes
        Route::get('subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
        Route::get('subscriptions/modules', [SubscriptionController::class, 'modules'])->name('subscriptions.modules');
        Route::get('subscriptions/plans', [SubscriptionController::class, 'plans'])->name('subscriptions.plans');
        Route::get('subscriptions/info', [SubscriptionController::class, 'info'])->name('subscriptions.info');

    // Department Routes
        Route::post('department/update/{department}', [DepartmentsController::class, 'update'])->name('department.update');
    });

    // Objectives
        Route::post('objective/store', [ObjectivesController::class, 'store'])->name('objective.store');
        Route::post('objective/destroy/{objective}', [ObjectivesController::class, 'destroy'])->name('objective.destroy');

    // Programs
    Route::post('program', [ProgramsController::class, 'store'])->name('program.store');
});

// Default Locale Redirect
Route::get('/', function () {
    $locale = App::getLocale(); // Get the default locale
    return redirect($locale);
});

