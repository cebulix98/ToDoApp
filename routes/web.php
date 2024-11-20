<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/tasks', [TaskController::class, 'list'])->name('tasks');
    Route::get('/task/new', [TaskController::class, 'create'])->name('task.new');
    Route::get('/task/shared/{token}', [TaskController::class, 'shared'])->name('task.shared');
    Route::get('/task/share/{token}', [TaskController::class, 'share'])->name('task.share');
    Route::get('/task/{id}', [TaskController::class, 'edit'])->name('task.edit');
    Route::post('/task/new', [TaskController::class, 'store'])->name('task.store');
    Route::patch('/task/{id}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/task/{id}', [TaskController::class, 'delete'])->name('task.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
