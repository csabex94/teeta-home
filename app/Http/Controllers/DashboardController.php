<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Events\TaskList;
use App\Notifications\TaskList as TL;

class DashboardController extends Controller {

    protected $event, $task;

    public function __construct(EventRepositoryInterface $event, TaskRepositoryInterface $task) {
        $this->event = $event;
        $this->task = $task;
    }

    public function index() {

        //event(new TaskList(auth()->user()));
        //$user = auth()->user();
        //$user->notify(new TL(auth()->user()));
        $allTasks = $this->task->getAllTasks();
        $dailyTasks = $this->task->getDailyTasks();
        $todaysTasks = $this->task->getTodaysTasks();

        $allEvents = $this->event->getAllEvents();
        $events = $this->event->getDailyEvents();
        $todaysEvents = $this->event->getTodaysEvents();

        return Inertia::render('DashboardLight', [
           'tasks' => array_merge($dailyTasks->toArray(), $todaysTasks->toArray()),
           'upcomingTasks' => [],
           'allTasks' => $allTasks,
           'allEvents' => $allEvents,
           'events' => array_merge($events->toArray(), $todaysEvents->toArray()),
            'completedTasks' => $this->task->getCompletedTasks()
        ]);
    }

    public function create(Request $request)
    {
        $show = NULL;
        $date = NULL;
        if ($request->show) {
            $show = $request->show;
        }
        if ($request->date) {
            $date = $request->date;
        }
        return Inertia::render('Create', [
           'show' => $show,
           'date' => $date
        ]);
    }
}
