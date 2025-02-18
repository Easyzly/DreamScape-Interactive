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

    Route::get('/items', [\App\Http\Controllers\User\ItemController::class, 'index'])->name('user.items.index');
    Route::get('/items/{item}', [\App\Http\Controllers\User\ItemController::class, 'show'])->name('user.items.show');
    Route::delete('/items/{item}', [\App\Http\Controllers\User\ItemController::class, 'destroy'])->name('user.items.destroy');

    Route::group(['middleware' => ['can:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
        //Admin routes (moeten nog toegevoegd worden)
    });
});

require __DIR__.'/auth.php';
