<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Profile\Controller;
use App\Http\Controllers\Profile\SessionController;

Route::get('/', Controller::class)->name('view');

Route::group(['as' => 'sessions.', 'prefix' => 'sessions'], function () {
    Route::get('/', [SessionController::class, 'readAny'])->name('read.any');
    Route::delete('delete/{token}', [SessionController::class, 'delete'])->name('delete');
    Route::delete('delete-all', [SessionController::class, 'deleteAll'])->name('delete.all');
});
