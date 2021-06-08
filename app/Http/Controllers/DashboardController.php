<?php

namespace App\Http\Controllers;

use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller {

    protected $event, $task;

    public function __construct(EventRepositoryInterface $event, TaskRepositoryInterface $task) {
        $this->event = $event;
        $this->task = $task;
    }

    public function index() {
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
           'events' => array_merge($events->toArray(), $todaysEvents->toArray())
        ]);
    }

    public function create(Request $request)
    {
        $show = NULL;
        if ($request->show) {
            $show = $request->show;
        }
        return Inertia::render('Create', [
           'show' => $show
        ]);
    }
}
