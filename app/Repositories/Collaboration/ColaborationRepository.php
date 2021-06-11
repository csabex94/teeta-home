<?php

namespace App\Repositories\Collaboration;

use Carbon\Carbon;
use App\Models\Collaboration;
use Illuminate\Support\Facades\Session;

class CollaborationRepository implements CollaborationRepositoryInterface {
    
    protected $collaboration, $user;
    
    public function __construct(Collaboration $collaboration) {
        $this->collaboration = $collaboration;
        $this->user = auth()->user();
    }

    public function getPastCollaborations() {
        return $this->collaboration->where('deleted', 1)->get();
    }

    public function getTaskCollaborations($taskId) {
        return $this->collaboration->where('is_task', 1)->where('action_id', $taskId)->where('deleted', 0)->get();
    }

    public function getEventCollaborations($eventId) {
        return $this->collaboration->where('is_event', 1)->where('action_id', $eventId)->where('deleted', 0)->get();
    }

}