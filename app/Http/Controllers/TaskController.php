<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller {
    public function index(Request $request) {
        if (!$request->date) {
            $tasks = Task::where([
                ['user_id', auth()->user()->id],
                ['title', 'LIKE', "%$request->search%"],
                ['completed', 0]
            ])->orderBy('spec_date', 'asc')->get();
        } else {
            $next = Carbon::parse($request->date)->addDay(1);
            $tasks = Task::where([
                ['user_id', auth()->user()->id],
                ['title', 'LIKE', "%$request->search%"],
                ['spec_date', '>=' ,$request->date],
                ['spec_date', '<=' ,$next],
                ['completed', 0]
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

        return redirect()->back()->with(['tasks' => Task::where('user_id', auth()->user()->id)->get()]);
    }

    public function completeTask(Request $request) {
        return $this->task->completeTask($request->taskId);
    }

}
