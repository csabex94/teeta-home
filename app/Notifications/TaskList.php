<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Task;
use App\Mail\TaskListReminder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskList extends Notification {

    use Queueable;

    protected $tasks, $user;
    
    public function __construct(User $user) {
        $this->user = $user;
    }

    public function via($notifiable) {
        return ['mail', 'database', 'broadcast'];
    }

    public function toMail($notifiable) {
        $tasks = Task::with('user')->where('user_id', $this->user->id)->whereDate('spec_date', '>=', Carbon::now())->whereDate('spec_date', '<=', Carbon::now()->addWeeks(1))->get();

        return (new TaskListReminder($this->user, $tasks, 'week'));
    }
    
    public function toBroadcast($notifiable) {
        return [
            
        ];
    }

    public function toDatabase($notifiable) {
        return [
            
        ];
    }
}
