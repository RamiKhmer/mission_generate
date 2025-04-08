<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('tasks', TaskController::class);

Route::get('/tasks/{task}/print', [TaskController::class, 'print'])->name('tasks.print');
