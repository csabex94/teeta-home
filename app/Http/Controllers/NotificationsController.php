<?php

namespace App\Http\Controllers;

use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Personal\PersonalRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;
use Illuminate\Http\Request;

class NotificationsController extends Controller {
    
    protected $notification, $task, $event, $personal;

    public function __construct(TaskRepositoryInterface $task, EventRepositoryInterface $event, PersonalRepositoryInterface $personal) {
        $this->task = $task;
        $this->event = $event;
        $this->personal = $personal;
    }

    public function notifyTaskList() {
        $taskList = $this->task->getFollowingDaysTasks(7, false);
        
        return $taskList;
    }
}