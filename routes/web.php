<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'index'])->name('top');

Auth::routes();

Route::get('/users/{id}', [UserController::class, 'show'])->name('user.show');

Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::patch('/users/{id}', [UserController::class, 'update'])->name('user.update');

Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');

Route::resource('tasks', TaskController::class, ['except' => 'index']);
