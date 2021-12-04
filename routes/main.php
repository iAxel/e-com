<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Main\UserController;
use App\Http\Controllers\Main\ClientController;

Route::group(['as' => 'users.', 'prefix' => 'users'], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('{user}', [UserController::class, 'show'])->name('show');
});

Route::group(['as' => 'clients.', 'prefix' => 'clients'], function () {
    Route::get('/', [ClientController::class, 'index'])->name('index');
    Route::get('{client}', [ClientController::class, 'show'])->name('show');
    Route::get('{client}/orders', [ClientController::class, 'orders'])->name('orders');
    Route::get('{client}/transactions', [ClientController::class, 'transactions'])->name('transactions');
});
