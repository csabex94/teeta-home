<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskList extends Notification {

    use Queueable;

    protected $tasks, $user;
    
    public function __construct($tasks, User $user) {
        $this->tasks = $tasks;
        $this->user = $user;
    }

    public function via($notifiable) {
        return ['database', 'broadcast'];
    }

    public function toMail($notifiable) {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }
    
    public function toBroadcast($notifiable) {
        return [
            
        ];
    }
}
