<?php

use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\logicModelComponentsController;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\SubProgramsController;
use App\Http\Controllers\TeamMembersController;

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
        ->withoutMiddleware(['auth', 'verified']);

    Route::prefix('free-signup')->group(function () {
        Route::get('/', [RegisterController::class, 'create'])
            ->name('free-signup.create')
            ->middleware('guest');
        Route::post('/', [RegisterController::class, 'store'])
            ->name('free-signup.store');
    });

    // Team Members Routes
      Route::prefix('team-member')->group(function () {
        Route::post('/', [TeamMembersController::class, 'store'])
        ->name('team-member.store');
        Route::get('/{user}/edit', [TeamMembersController::class, 'edit'])
            ->name('team-member.edit');
        Route::put('/{user}/update', [TeamMembersController::class, 'update'])
            ->name('team-member.update');
        Route::post('/destroy/{user}', [TeamMembersController::class, 'destroy'])
            ->name('team-member.destroy');
      });


    // Location Routes
        Route::get('/locations/states/{countryId}', [LocationsController::class, 'getStates']);
        Route::get('/locations/cities/{stateId}', [LocationsController::class, 'getCities']);

    // Authenticated User Routes
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('welcome', [WelcomeController::class, 'index'])->name('welcome');
        Route::get('wiz1', [WelcomeController::class, 'wizOne'])->name('wiz1');
        Route::get('wiz2', [WelcomeController::class, 'wizTwo'])->name('wiz2');
        Route::get('wiz3', [WelcomeController::class, 'wizThree'])->name('wiz3');
        Route::get('wiz4', [WelcomeController::class, 'wizFour'])->name('wiz4');
        Route::get('wiz-end', [WelcomeController::class, 'wizEnd'])->name('wiz.end');

    // Department Routes
        Route::post('department/update/{department}', [DepartmentsController::class, 'update'])->name('department.update');

         // Objectives
         Route::post('objective/store', [logicModelComponentsController::class, 'store'])->name('objective.store');
         Route::get('objective/edit/{logicModelComponent}', [logicModelComponentsController::class, 'edit'])->name('objective.edit');
         Route::post('objective/update/{logicModelComponent}', [logicModelComponentsController::class, 'update'])->name('objective.update');
         Route::post('objective/destroy/{logicModelComponent}', [logicModelComponentsController::class, 'destroy'])->name('objective.destroy');

     // Programs
         Route::post('program', [ProgramsController::class, 'store'])->name('program.store');
         Route::post('program/update/{program}', [ProgramsController::class, 'update'])->name('program.update');
         Route::post('program/destroy/{program}', [ProgramsController::class, 'destroy'])->name('program.destroy');

     // Sub Programs
     Route::post('subprogram', [SubProgramsController::class, 'store'])->name('subprogram.store');
     Route::post('subprogram/update/{subprogram}', [SubProgramsController::class, 'update'])->name('subprogram.update');
     Route::post('subprogram/destroy/{subprogram}', [SubProgramsController::class, 'destroy'])->name('subprogram.destroy');

     // Dashboard
     Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

    // Subscription Routes
 Route::prefix('subscription')->group(function () {
    Route::get('/modules', [SubscriptionController::class, 'modules'])->name('subscription.modules');
    Route::get('/plans', [SubscriptionController::class, 'plans'])->name('subscription.plans');
    Route::post('selected-modules', [SubscriptionController::class, 'selectedModules'])->name('subscription.selected-plans');
    Route::get('/info', [SubscriptionController::class, 'info'])->name('subscription.info');

 });

//  Stripe Checkout
Route::get('checkout/{priceId}', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

});
// Default Locale Redirect
Route::get('/', function () {
    $locale = App::getLocale(); // Get the default locale
    return redirect($locale);
});

