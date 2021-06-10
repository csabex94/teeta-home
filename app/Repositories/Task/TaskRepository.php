<?php

namespace App\Repositories\Task;

use App\Models\Task;
use Carbon\Carbon;

class TaskRepository implements TaskRepositoryInterface {

    protected $task, $user;

    public function __construct(Task $task) {
        $this->task = $task;
        $this->user = auth()->user();
    }

    public function getAllTasks($id) {
        return $this->task->where('user_id', $id)->get();
    }

    public function getTask($id) {
        return $this->task->where('id', $id)->first();
    }

    public function getDailyTasks($id) {
        return $this->task->where('daily', 1)->where('user_id', $id)->where('completed', 0)->get();
    }

    public function getTodaysTasks($id) {
        return $this->task->whereDate('spec_date', Carbon::today())->where('user_id', $id)->where('completed', 0)->get();
    }

    public function getCompletedTasks($id) {
        return $this->task->where('completed', 1)->where('user_id', $id)->get();
    }

    public function getUncompletedTasksForToday($id) {
        return $this->task->whereDate('spec_date', Carbon::now())->where('user_id', $id)->where('completed', 0)->get();
    }

    public function getFollowingDaysTasks($days, $email = false, $userId) {
        $tasks = $this->task->where('daily', 0)->where('completed', 0)->where('user_id', $userId)->whereDate('spec_date', '>=', Carbon::now()->addDays($days));

        if($email) {
            $tasks->where('push_email', 1);
        }

        return $tasks->get();
    }

    public function getFollowingWeeksTasks($weeks, $email = false, $userId) {
        $tasks = $this->task->where('daily', 0)->where('completed', 0)->where('user_id', $userId)->whereDate('spec_date', '>=', Carbon::now()->addWeeks($weeks));

        if($email) {
            $tasks->where('push_email', 1);
        }

        return $tasks->get();
    }

    public function deletePreviousTasks($toDate = false) {
        $tasks = $this->task->where('daily', 0)->where('keep_in_list', 0);

        if($toDate) { //delete tasks up to date
            $tasks->whereDate('spec_date', '<=', $toDate);
        } else {
            $tasks->whereDate('spec_date', '<=', Carbon::now()->subDays(1)); //don't remove previous day tasks yet
        }

        foreach($tasks->get() as $task) {
            $task->delete();
        }
    }

    public function completeTask($id) {
        $task = $this->task->find($id);
        $task->completed = 1;
        $task->completed_at = Carbon::now();
        $task->save();
    }

    public function store($request) {
        $validData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'daily' => 'required|boolean',
            'push_email' => 'required|boolean'
        ]);

        if ($validData) {
             $this->task->title = $validData['title'];
             $this->task->description = $validData['description'];
             $this->task->daily = $validData['daily'];
             $this->task->push_email = $validData['push_email'];
             $this->task->user_id = auth()->user()->id;
        }

        if ($request->spec_date) {
             $this->task->spec_date = $request->spec_date;
        }

        if ($request->spec_time) {
             $this->task->spec_time = $request->spec_time;
        }

        if ($request->remind_before_option && $request->remind_before_option != 'Remind me before') {
             $this->task->remind_before_option = $request->remind_before_option;
        }

        if ($request->remind_before_value) {
             $this->task->remind_before_value = $request->remind_before_value;
        }

        $this->task->save();
    }

    public function update($request) {
        $validData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'daily' => 'required|boolean',
            'push_email' => 'required|boolean',
            'important' => 'required|boolean',
        ]);
        $task = $this->task->where('id', $request->taskId)->first();

        $task->title = $validData['title'];
        $task->description = $validData['description'];
        $task->push_email = $validData['push_email'];
        $task->important = $validData['important'];
        $task->spec_time = $request->spec_time;

        if ($validData['daily'] == true || $validData['daily'] == 1) {
            $task->remind_before_option = NULL;
            $task->remind_before_value = NULL;
            $task->spec_date = NULL;
            $task->daily = 1;
        } else {
            $task->daily = 0;
            if ($request->remind_before_option && $request->remind_before_value) {
                $task->remind_before_option = $request->remind_before_option;
                $task->remind_before_value = $request->remind_before_value;
            } else {
                $task->remind_before_option = NULL;
                $task->remind_before_value = NULL;
            }
            if ($request->spec_date) {
                $task->spec_date = $request->spec_date;
            } else {
                $task->spec_date = NULL;
                $task->daily = 1;
            }
        }

        $task->save();
    }

    public function deleteTask($id) {
        $task = $this->task->find($id);
        $task->delete();
    }

}
