<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller {

    protected $task;
    protected $event;

    public function __construct(EventRepositoryInterface $event, TaskRepositoryInterface $task) {
        $this->event = $event;
        $this->task = $task;
    }
    public function index(Request $request) {
        if (!$request->date) {
            $tasks = Task::where([
                ['user_id', auth()->user()->id],
                ['title', 'LIKE', "%$request->search%"],
            ])->orderBy('spec_date', 'asc')->get();
        } else {
            $tasks = Task::where([
                ['user_id', auth()->user()->id],
                ['title', 'LIKE', "%$request->search%"],
                ['spec_date', $request->date],
            ])->orderBy('spec_date', 'asc')->get();
        }

        return Inertia::render('Tasks', [
            'tasks' => $tasks
        ]);
    }

    public function create() {
        return Inertia::render('CreateTask');
    }

    public function store(Request $request) {
        $this->task->store($request);

        return redirect()->route('tasks')->with('success', 'Task created successfully!');
    }

    public function deleteTask(Request $request) {
        $this->task->deleteTask($request->taskId);

        return redirect()->back()->with('success', 'Task deleted successfully!');
    }

    public function updateTask(Request $request) {
        $this->task->update($request);

        return redirect()->back()->with('success', 'Task modified successfully.');
    }

    public function completeTask(Request $request) {
        $this->task->completeTask($request->taskId);
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
            'completedTasks' => $this->task->getCompletedTasks(),
            'completedEvents' => $this->event->getCompletedEvents()
        ]);
    }

}
