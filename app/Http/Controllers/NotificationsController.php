<?php

namespace App\Http\Controllers;

use App\Repositories\Colaboration\ColaborationRepositoryInterface;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Personal\PersonalRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;
use Illuminate\Http\Request;

class NotificationsController extends Controller {
    
    protected $notification, $task, $event, $personal, $colaboration;

    public function __construct(TaskRepositoryInterface $task, EventRepositoryInterface $event, PersonalRepositoryInterface $personal, ColaborationRepositoryInterface $colaboration) {
        $this->task = $task;
        $this->event = $event;
        $this->personal = $personal;
        $this->colaboration = $colaboration;
    }

    public function notifyTaskList() {
        return $this->task->getFollowingDaysTasks(7, false);
    }

    public function nofityEventList() {
        return $this->event->getFollowingDaysEvents(7, false);
    }
}