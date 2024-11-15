<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\Auth\CustomRegisterController;
use App\Http\Livewire\PurchaseComponent;

Route::group(['middleware' => ['web']], function () {
    Route::get('/', [ItemController::class, 'index'])->name('home');
    Route::get('/login', [CustomLoginController::class, 'showLoginForm'])->name('login.get');
    Route::post('/login', [CustomLoginController::class, 'login'])->name('login');
    Route::get('/register', [CustomRegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [CustomRegisterController::class, 'register']);
    Route::post('/logout', [CustomLoginController::class, 'logout'])->name('logout');
    Route::get('/item/{item_id}', [ItemController::class, 'detail'])->name('item.detail');
});

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/mypage', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/purchase/confirm/{item_id}', [PurchaseController::class, 'confirmPurchase'])->name('purchase.confirm');
    Route::post('/item/{item_id}/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/purchase/{item}', PurchaseComponent::class)->name('purchase.component');
    Route::get('/purchase/details/{item_id}', [PurchaseController::class, 'purchase'])->name('purchase.details');
    Route::get('/purchase/address/{item_id}', [AddressController::class, 'edit'])->name('purchase.address');
    Route::post('/purchase/address/{item_id}', [AddressController::class, 'update'])->name('purchase.address.update');
    Route::get('/sell', [SellController::class, 'create'])->name('sell.create');
    Route::post('/sell', [SellController::class, 'store'])->name('sell.store');
});