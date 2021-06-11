<?php

namespace App\Notifications;

use App\Mail\FriendRequest;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendFriendRequest extends Notification {
    use Queueable;

    public $friendRequest, $user;
   
    public function __construct(User $user) {
        $this->user = $user;
    }

    public function via($notifiable) {
        return ['mail', 'database', 'broadcast'];
    }

    public function toMail($notifiable) {
        return (new FriendRequest($this->user, auth()->user()->id));
    }

    public function toBroadcast($notifiable) {
        return [
            'name' => $notifiable->name,
            'message' => 'Has send you a friend request',
        ];
    }

    public function toArray($notifiable) {
        return [
            //
        ];
    }

    public function toDataBase($notifiable) {
        return [
            'name' => $this->user->name,
            'message' => 'Has send you a friend request',
        ];
    }
}
