<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TaskList implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public function broadcastOn() {
        return ['my-channel'];
    }

    public function broadcastAs() {
        return 'my-event';
    }
    
}