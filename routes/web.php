<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rating Step 1: Input tanggal dan kebutuhan tepung
    Route::get('/rating/start', [RatingController::class, 'step1'])->name('rating.step1');
    Route::post('/rating/step1', [RatingController::class, 'submitStep1'])->name('rating.step1.submit');

    // Rating Step 2–4: Supplier alternatif 1–3
    Route::get('/rating/supplier/{step}', [RatingController::class, 'supplierStep'])->name('rating.supplier.step');
    Route::post('/rating/supplier/{step}', [RatingController::class, 'submitSupplierStep'])->name('rating.supplier.step.submit');

    // Rating Step 5: Input bobot prioritas
    Route::get('/rating/weight', [RatingController::class, 'priorityStep'])->name('rating.priority');
    Route::post('/rating/finish', [RatingController::class, 'finish'])->name('rating.finish');

    // Rating History
    Route::get('/history', [RatingController::class, 'history'])->name('history');

    // Rating result
    Route::get('/rating/analysis/{id}', [RatingController::class, 'showAnalysis'])->name('rating.analysis');
    Route::get('/rating/result/{id}', [RatingController::class, 'showResult'])->name('rating.result');
    Route::get('/rating/print-analysis/{id}', [RatingController::class, 'printAnalysis'])->name('rating.print.analysis');

    // User guide
    Route::get('/user-guide', fn() => view('user-guide'))->name('user.guide');
});
