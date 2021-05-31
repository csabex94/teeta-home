<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $dailyTasks = Task::where('daily',1)->get();
        $specDateTasks = Task::whereDate('spec_date', Carbon::today())->get();
        $allTasks = Task::all();
        $allEvents = Event::all();
        $events = Event::where('daily', 1)->get();
        $specDateEvents = Event::whereDate('spec_date', Carbon::today())->get();

        return Inertia::render('Dashboard', [
           'tasks' => array_merge($dailyTasks->toArray(), $specDateTasks->toArray()),
           'upcomingTasks' => [],
           'allTasks' => $allTasks,
           'allEvents' => $allEvents,
           'events' => array_merge($events->toArray(), $specDateEvents->toArray())
        ]);
    }
}
