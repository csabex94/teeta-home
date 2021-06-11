<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Mail\TaskListReminder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendEventsForToday extends Notification {

    use Queueable;

    protected String $message;
    
    public function __construct($message) {
        $this->message = $message;
    }

    public function via($notifiable) {
        return ['database', 'broadcast'];
    }

    public function toMail($notifiable) {
        //$tasks = Task::with('user')->where('user_id', $this->user->id)->whereDate('spec_date', '>=', Carbon::now())->whereDate('spec_date', '<=', Carbon::now()->addWeeks(1))->get();

        // return (new TaskListReminder($this->user, $tasks, 'week'));
    }
    
    public function toBroadcast($notifiable) {
        return [
            
        ];
    }

    public function toDatabase($notifiable) {
        return [
            'message' => $this->message
        ];
    }
}
