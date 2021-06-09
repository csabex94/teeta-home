<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Repositories\Task\TaskRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckTasks extends Command {
   
    protected $task;
    
    protected $signature = 'command:check-tasks';
    protected $description = 'Command description';

    public function __construct(TaskRepositoryInterface $task, User $user) {
        parent::__construct();
        $this->task = $task;
        $this->user = $user;
    }

    public function handle() {
        $users = $this->user->get();

        foreach ($users as $user) {
            $tasklist = $this->task->getUncompletedTasksForToday($user->id);
            Mail::to($user->email)->send(new \App\Mail\TaskListReminder(auth()->user(), $tasklist, 'day'));
        }
    }
}
