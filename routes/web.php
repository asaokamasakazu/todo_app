<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'index'])->name('top');

Auth::routes();

Route::prefix('users')->name('user.')->group(function () {
    Route::get('{id}', [UserController::class, 'show'])->name('show');
    Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit');
    Route::patch('{id}', [UserController::class, 'update'])->name('update');
    Route::delete('{id}', [UserController::class, 'destroy'])->name('destroy');
});

Route::resource('tasks', TaskController::class, ['except' => 'index']);
