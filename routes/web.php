<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return view("layouts.application");
});

Auth::routes();

Route::get('/users/{id}', [UserController::class, 'show'])->name('user.show');

Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::patch('/users/{id}', [UserController::class, 'update'])->name('user.update');

Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');
