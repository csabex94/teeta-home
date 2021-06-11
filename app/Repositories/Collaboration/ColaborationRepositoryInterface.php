<?php

namespace App\Repositories\Collaboration;

interface CollaborationRepositoryInterface {

    public function getPastCollaborations();
    public function getTaskCollaborations($taskId);
    public function getEventCollaborations($eventId);
    
}