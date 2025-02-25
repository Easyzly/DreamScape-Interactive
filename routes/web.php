<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/items', [\App\Http\Controllers\ItemController::class, 'index'])->name('items.index');
    Route::get('/items/{item}', [\App\Http\Controllers\ItemController::class, 'show'])->name('items.show');
    Route::delete('/items/{item}', [\App\Http\Controllers\ItemController::class, 'destroy'])->name('items.destroy');

    Route::get('/trades', [\App\Http\Controllers\TradeController::class, 'index'])->name('trades.index');
    Route::get('/trades/{trade}', [\App\Http\Controllers\TradeController::class, 'show'])->name('trades.show');
    Route::get('/trades/create/{item}/{user}', [\App\Http\Controllers\TradeController::class, 'create'])->name('trades.create');
    Route::post('/trades', [\App\Http\Controllers\TradeController::class, 'store'])->name('trades.store');
    Route::delete('/trades/{trade}', [\App\Http\Controllers\TradeController::class, 'destroy'])->name('trades.destroy');
    Route::patch('/trades/{trade}/accept', [\App\Http\Controllers\TradeController::class, 'accept'])->name('trades.accept');
    Route::patch('/trades/{trade}/deny', [\App\Http\Controllers\TradeController::class, 'deny'])->name('trades.deny');

    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/items', [\App\Http\Controllers\User\ItemController::class, 'index'])->name('items.index');
        Route::get('/items/{item}', [\App\Http\Controllers\User\ItemController::class, 'show'])->name('items.show');
        Route::delete('/items/{item}', [\App\Http\Controllers\User\ItemController::class, 'destroy'])->name('items.destroy');
    });

    Route::group(['middleware' => ['can:admin'], 'prefix' => 'admin', 'as' => 'admins.'], function () {
        Route::resource('/users', \App\Http\Controllers\Admin\UserController::class);
    });
});

require __DIR__.'/auth.php';
