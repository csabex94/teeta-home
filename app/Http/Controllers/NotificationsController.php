<?php

namespace App\Http\Controllers;

use App\Repositories\Collaboration\CollaborationRepositoryInterface;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Personal\PersonalRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;
use Illuminate\Http\Request;

class NotificationsController extends Controller {
    
    protected $notification, $task, $event, $personal, $collaboration;

    public function __construct(TaskRepositoryInterface $task, EventRepositoryInterface $event, PersonalRepositoryInterface $personal, CollaborationRepositoryInterface $collaboration) {
        $this->task = $task;
        $this->event = $event;
        $this->personal = $personal;
        $this->collaboration = $collaboration;
    }

    public function registerNotification() {
        
    }

    public function notifyTaskList() {
        return $this->task->getFollowingDaysTasks(7, false, auth()->user()->id);
    }

    public function nofityEventList() {
        return $this->event->getFollowingDaysEvents(7, false, auth()->user()->id);
    }

}