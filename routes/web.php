<?php

use App\Http\Controllers\AddController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RankRestriction;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/orders', [OrderController::class, 'index'])->middleware(['auth', 'verified'])->name('orders');

Route::post('/orders/store', [OrderController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('orders.store');

Route::get('/add', [AddController::class, 'index'])
    ->middleware(['auth', 'verified', RankRestriction::class.':Manager:Raktárvezető'])
    ->name('add');

Route::get('/users', [UserController::class, 'index'])
    ->middleware(['auth', 'verified', RankRestriction::class.':Manager:Raktárvezető'])
    ->name('users');

Route::delete('/orders/{id}', [OrderController::class, 'destroy'])
    ->middleware(['auth', 'verified', RankRestriction::class.':Manager:Raktárvezető'])
    ->name('orders.destroy');
Route::put('/orders/{id}', [OrderController::class, 'update'])
    ->middleware(['auth', 'verified', RankRestriction::class.':Manager:Raktárvezető'])
    ->name('orders.update');

Route::put('/users/{id}', [UserController::class, 'update'])
    ->middleware(['auth', 'verified', RankRestriction::class.':Manager:Raktárvezető'])
    ->name('users.update');

Route::delete('/users/{id}', [UserController::class, 'destroy'])
    ->middleware(['auth', 'verified', RankRestriction::class.':Manager:Raktárvezető'])
    ->name('users.destroy');

Route::post('/users/store', [UserController::class, 'store'])
    ->middleware(['auth', 'verified', RankRestriction::class.':Manager:Raktárvezető'])
    ->name('users.store');

Route::get('/users/search', [UserController::class, 'search'])
    ->middleware(['auth', 'verified', RankRestriction::class.':Manager:Raktárvezető'])
    ->name('users.search');

require __DIR__.'/auth.php';
