<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class EventsController extends Controller {

    protected $event, $task;

    public function __construct(EventRepositoryInterface $event, TaskRepositoryInterface $task) {
        $this->event = $event;
        $this->task = $task;
    }

    public function show(Request $request) {
        if (!$request->date) {
            $events = Event::where([
                ['user_id', auth()->user()->id],
                ['title', 'LIKE', "%$request->search%"],
            ])->get(); //needs pagination
        } else {
            $events = Event::where([
                ['user_id', auth()->user()->id],
                ['title', 'LIKE', "%$request->search%"],
                ['spec_date', '=' ,$request->date],
            ])->orderBy('spec_date', 'asc')->get();
        }
        return Inertia::render('Events/Show', [
            'events' => $events
        ]);
    }

    public function create() {
        return Inertia::render('Events/Create');
    }

    public function store(Request $request) {
        $this->event->store($request);

        return redirect()->route('events.show')->with('success', 'Event created.');
    }

    public function edit(Event $event) {
        return Inertia::render('Events/Edit', $event);
    }

    public function update(Request $request) {
        $this->event->update($request);

        return redirect()->back()->with('success', 'Event modified successfully.');
    }

    public function delete(Request $request) {
        $this->event->deleteEvent($request->eventId);

        return redirect()->back()->with('success', 'Event deleted successfully.');
    }

    public function completeEvent(Request $request) {
        $this->event->completeEvent($request->eventId);
        $allTasks = $this->task->getAllTasks(auth()->user()->id);
        $dailyTasks = $this->task->getDailyTasks(auth()->user()->id);
        $todaysTasks = $this->task->getTodaysTasks(auth()->user()->id);

        $allEvents = $this->event->getAllEvents(auth()->user()->id);
        $events = $this->event->getDailyEvents(auth()->user()->id);
        $todaysEvents = $this->event->getTodaysEvents(auth()->user()->id);

        return Inertia::render('DashboardLight', [
            'tasks' => array_merge($dailyTasks->toArray(), $todaysTasks->toArray()),
            'upcomingTasks' => [],
            'allTasks' => $allTasks,
            'allEvents' => $allEvents,
            'events' => array_merge($events->toArray(), $todaysEvents->toArray()),
            'completedTasks' => $this->task->getCompletedTasks(auth()->user()->id),
            'completedEvents' => $this->event->getCompletedEvents(auth()->user()->id)
        ]);
    }
}
