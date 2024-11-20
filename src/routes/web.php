<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\Auth\CustomRegisterController;
use App\Http\Livewire\PurchaseComponent;
use App\Http\Livewire\SearchResults;

Route::group(['middleware' => ['web']], function () {
    Route::get('/', [ItemController::class, 'index'])->name('home');
    Route::get('/login', [CustomLoginController::class, 'showLoginForm'])->name('login.get');
    Route::post('/login', [CustomLoginController::class, 'login'])->name('login');
    Route::get('/register', [CustomRegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [CustomRegisterController::class, 'register']);
    Route::post('/logout', [CustomLoginController::class, 'logout'])->name('logout');
    Route::get('/item/{item_id}', [ItemController::class, 'detail'])->name('item.detail');
    Route::get('/items', SearchResults::class)->name('items.index');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::group(['middleware' => ['web', 'auth', 'verified']], function () {
    Route::get('/mypage', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/mypage/sell', [ProfileController::class, 'showSellItems'])->name('mypage.sell');
    Route::get('/mypage/purchase', [ProfileController::class, 'showPurchasedItems'])->name('mypage.purchase');
    Route::post('/purchase/confirm/{item_id}', [PurchaseController::class, 'confirmPurchase'])->name('purchase.confirm');
    Route::post('/item/{item_id}/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/purchase/{item}', PurchaseComponent::class)->name('purchase.component');
    Route::get('/purchase/details/{item_id}', [PurchaseController::class, 'purchase'])->name('purchase.details');
    Route::get('/purchase/address/{item_id}', [AddressController::class, 'edit'])->name('purchase.address');
    Route::post('/purchase/address/{item_id}', [AddressController::class, 'update'])->name('purchase.address.update');
    Route::post('/purchase/stripe/session', [StripeController::class, 'createSession'])->name('purchase.stripe.session');
    Route::get('/purchase/success/{item_id}', [StripeController::class, 'success'])->name('purchase.stripe.success');
    Route::get('/sell', [SellController::class, 'create'])->name('sell.create');
    Route::post('/sell', [SellController::class, 'store'])->name('sell.store');
});