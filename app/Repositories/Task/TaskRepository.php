<?php

namespace App\Repositories\Task;

use App\Models\Task;
use Carbon\Carbon;

class TaskRepository implements TaskRepositoryInterface {
    
    protected $task;
    
    public function __construct(Task $task) {
        $this->task = $task;
    }

    public function getAllTasks() {
        return $this->task->get();
    }

    public function getTask($id) {
        return $this->task->where('id', $id)->first();
    }

    public function getDailyTasks() {
        return $this->task->where('daily', 1)->where('completed', 0)->get();
    }

    public function getTodaysTasks() {
        return $this->task->whereDate('spec_date', Carbon::today())->where('completed', 0)->get();
    }

    public function getCompletedTasks() {
        return $this->task->where('completed', 1)->get();
    }

    public function getFollowingDaysTasks($days, $email = false) {
        $tasks = $this->task->where('daily', 0)->where('completed', 0)->whereDate('spec_date', '>=', Carbon::now()->addDays($days));

        if($email) {
            $tasks->where('push_email', 1);
        }

        return $tasks->get();
    }

    public function getFollowingWeeksTasks($weeks, $email = false) {
        $tasks = $this->task->where('daily', 0)->where('completed', 0)->whereDate('spec_date', '>=', Carbon::now()->addWeeks($weeks));

        if($email) {
            $tasks->where('push_email', 1);
        }

        return $tasks->get();
    }

    public function deletePreviousTasks($toDate = false) {
        $tasks = $this->task->where('completed', 1)->where('daily', 0);

        if($toDate) { //delete tasks up to date
            $tasks->whereDate('spec_date', '<=', $toDate);
        } else {
            $tasks->whereDate('spec_date', '<=', Carbon::now()->subDays(3)); //don't remove last 3 days tasks yet
        }

        foreach($tasks->get() as $task) {
            $task->delete();
        }
    }
    
}