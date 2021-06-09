<?php

namespace App\Mail;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FriendRequest extends Mailable
{
    use Queueable, SerializesModels;

    protected $receiver, $sender;

    public function __construct(User $receiver, User $sender) {
        $this->receiver = $receiver;
        $this->sender = $sender;
    }

    public function build() {
        return $this->from('noreply@teeta.com')
            ->to($this->sender->email)
            ->subject('Teeta Reminder - New friend request')
            ->markdown('mails.friend-request')
            ->with([
                'receiver' => $this->getLastName($this->receiver->name),
                'sender' => $this->sender->name,
                'senderEmail' => $this->sender->email,
                'date' => Carbon::now()->toFormattedDateString(),
            ]);
    }

    private function getLastName($name) {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        return $last_name;
    }
}
