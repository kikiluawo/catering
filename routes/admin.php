<?php

use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'isAdmin'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('index');
        Route::get('/form', [\App\Http\Controllers\Admin\DashboardController::class, 'form'])->name('form');
        Route::get('/card', function () { return view('admin.dashboard.card');});
        Route::get('/button', function () { return view('admin.dashboard.button');});
        Route::get('/modals', function () { return view('admin.dashboard.modals');});
        Route::get('/tables', function () { return view('admin.dashboard.tables');});
    });
});