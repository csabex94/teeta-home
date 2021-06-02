<?php

namespace App\Http\Controllers;

use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;
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

        return Inertia::render('Dashboard', [
           'tasks' => array_merge($dailyTasks->toArray(), $todaysTasks->toArray()),
           'upcomingTasks' => [],
           'allTasks' => $allTasks,
           'allEvents' => $allEvents,
           'events' => array_merge($events->toArray(), $todaysEvents->toArray())
        ]);
    }
}