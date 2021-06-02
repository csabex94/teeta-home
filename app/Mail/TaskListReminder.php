<?php

namespace App\Mail;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskListReminder extends Mailable {

    use Queueable, SerializesModels;

    protected $tasks, $user, $following;

    public function __construct(User $user, $tasks, $following) {
        $this->tasks = $tasks;
        $this->user = $user;
        $this->following = $following;
    }

    public function build() {
        return $this->from('noreply@teeta.com')
            ->to($this->user->email)
            ->subject('Teeta Reminder - TaskList for ' . $this->getLastName($this->user->name) . Carbon::now()->toFormattedDateString())
            ->markdown('mails.upcoming-tasks')
            ->with([
                'name' => $this->getLastName($this->user->name),
                'tasks' => $this->tasks,
                'following' => $this->following
            ]);
    }

    private function getLastName($name) {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        return $last_name;
    }

}