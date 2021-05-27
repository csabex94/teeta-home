<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->date) {
            $tasks = Task::where([
                ['user_id', auth()->user()->id],
                ['title', 'LIKE', "%$request->search%"],
            ])->get();
        } else {
            $next = Carbon::parse($request->date)->addDay(1);
            $tasks = Task::where([
                ['user_id', auth()->user()->id],
                ['title', 'LIKE', "%$request->search%"],
                ['spec_date', '>=' ,$request->date],
                ['spec_date', '<=' ,$next]
            ])->get();
        }

        return Inertia::render('Tasks', [
            'tasks' => $tasks
        ]);
    }

    public function store(Request $request)
    {

        $validData = $request->validate([
           'title' => 'required|string',
           'description' => 'required|string',
           'daily' => 'required|boolean',
           'push_email' => 'required|boolean'
        ]);
        $newTask = new Task();

        if ($validData) {
            $newTask->title = $validData['title'];
            $newTask->description = $validData['description'];
            $newTask->daily = $validData['daily'];
            $newTask->push_email = $validData['push_email'];
            $newTask->user_id = auth()->user()->id;
        }

        if ($request->spec_date) {
            $newTask->spec_date = $request->spec_date;
        }

        if ($request->spec_time) {
            $newTask->spec_time = $request->spec_time;
        }

        if ($request->remind_before_option && $request->remind_before_option != 'Remind me before') {
            $newTask->remind_before_option = $request->remind_before_option;
        }

        if ($request->remind_before_value) {
            $newTask->remind_before_value = $request->remind_before_value;
        }

        $newTask->save();
        return Inertia::render('CreateTask');
    }

    public function deleteTask(Request $request)
    {
        Task::where('id', $request->taskId)->first()->delete();
        return redirect()->back()->with(['tasks' => Task::where('user_id', auth()->user()->id)->get()]);
    }

    public function updateTask(Request $request)
    {
        $validData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'daily' => 'required|boolean',
            'push_email' => 'required|boolean'
        ]);
        $taskToUpdate = Task::where('id', $request->taskId)->first();

        $taskToUpdate->title = $validData['title'];
        $taskToUpdate->description = $validData['description'];
        $taskToUpdate->push_email = $validData['push_email'];

        if ($validData['daily'] == true || $validData['daily'] == 1) {
            $taskToUpdate->remind_before_option = NULL;
            $taskToUpdate->remind_before_value = NULL;
            $taskToUpdate->spec_date = NULL;
            $taskToUpdate->daily = 1;
        } else {
            $taskToUpdate->daily = 0;
            if ($request->remind_before_option && $request->remind_before_value) {
                $taskToUpdate->remind_before_option = $request->remind_before_option;
                $taskToUpdate->remind_before_value = $request->remind_before_value;
            } else {
                $taskToUpdate->remind_before_option = NULL;
                $taskToUpdate->remind_before_value = NULL;
            }
            if ($request->spec_date) {
                $taskToUpdate->spec_date = $request->spec_date;
            } else {
                $taskToUpdate->spec_date = NULL;
            }

            if ($request->spec_time) {
                $taskToUpdate->spec_time = $request->spec_time;
            } else {
                $taskToUpdate->spec_time = NULL;
            }
        }
        $taskToUpdate->save();

        return redirect()->back()->with(['tasks' => Task::where('user_id', auth()->user()->id)->get()]);
    }
}
