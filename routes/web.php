<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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
    // Dashboard New Page
    Route::get('/dashboard-new', [DashboardController::class, 'dashboardNew'])->name('dashboard.new');

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

    //Mails

        //Test Routes
        Route::get('/mail/single-event', function () { //reminder for an event on specified date
            $event = App\Models\Event::with('user')->first();

            return (new App\Mail\EventReminder($event))->render(); //params (Event)
        });

        Route::get('/mail/event-list', function () { //event list to complete in the following * week
            $events = App\Models\Event::with('user')->whereDate('spec_date', '>=', Carbon\Carbon::now()->addWeeks(1))->get();

            return (new App\Mail\EventListReminder(auth()->user(), $events, 'week'))->render(); //params(User, event list, in the following '$string')
        });

        Route::get('/mail/single-task', function () { //reminder for a task to complete
            $task = App\Models\Task::with('user')->first();

            return (new App\Mail\TaskReminder($task))->render(); //params (Task)
        });

        Route::get('/mail/task-list', function () { //task list to complete in the following * 2 weeks
            $tasks = App\Models\Task::with('user')->whereDate('spec_date', '>=', Carbon\Carbon::now()->addWeeks(2))->get();

            return (new App\Mail\TaskListReminder(auth()->user(), $tasks, '2 weeks'))->render(); //params(User, task list, in the following '$string')
        });

    /*
    Route::get('/email/verify', function () {
        return view('mails.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/');
    })->middleware(['auth', 'signed'])->name('verification.verify');

   */
});
