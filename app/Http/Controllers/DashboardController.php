<?php

namespace App\Http\Controllers;

use App\Models\Task;
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

        return Inertia::render('Dashboard', [
           'tasks' => array_merge($dailyTasks->toArray(), $specDateTasks->toArray()),
           'upcomingTasks' => [],
           'allTasks' => $allTasks
        ]);
    }
}
