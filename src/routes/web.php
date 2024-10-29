<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\Auth\CustomRegisterController;

Route::middleware(['web'])->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('home');
    Route::get('/login', [CustomLoginController::class, 'showLoginForm'])->name('login.get');
    Route::post('/login', [CustomLoginController::class, 'login'])->name('login');
    Route::get('/register', [CustomRegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [CustomRegisterController::class, 'register']);
    Route::post('/logout', [CustomLoginController::class, 'logout'])->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');
});