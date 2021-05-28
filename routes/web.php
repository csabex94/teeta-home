<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->group(function() {

    // Dashboard Page
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Create Task Page
    Route::get('/create-task', function() {
       return Inertia::render('CreateTask');
    })->name('create.task');

    // Create Task
    Route::post('/create-task', [TaskController::class, 'store'])->name('create.task.post');
    // Delete Task
    Route::delete('/delete-task', [TaskController::class, 'deleteTask'])->name('delete.task');
    // Update Task
    Route::put('/update-task', [TaskController::class, 'updateTask'])->name('update.task');

    // Tasks Page
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');

    //Events
    Route::get('/events', [EventsController::class, 'show'])->name('events.show');
    Route::get('/events/create', [EventsController::class, 'create'])->name('events.create');
    Route::post('/events/store', [EventsController::class, 'store'])->name('events.store');
    Route::put('/events/update', [EventsController::class, 'update'])->name('events.update');
    Route::delete('/events/delete', [EventsController::class, 'delete'])->name('events.delete');
});

