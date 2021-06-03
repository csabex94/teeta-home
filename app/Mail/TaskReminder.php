<?php

namespace App\Mail;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskReminder extends Mailable {

    use Queueable, SerializesModels;

    protected $task;

    public function __construct(Task $task) {
        $this->task = $task;
    }

    public function build() {
        return $this->from('noreply@teeta.com')
            ->to($this->task->user->email)
            ->subject('Teeta Reminder - ' . $this->task->title)
            ->markdown('mails.task')
            ->with([
                'name' => $this->getLastName($this->task->user->name),
                'task' => $this->task,
                'date' => Carbon::createFromFormat('Y-m-d H:i:s', $this->task->spec_date)->toFormattedDateString(),
                'time' => ($this->task->spec_time) ? Carbon::createFromFormat('H:i:s', $this->task->spec_time)->format('h:i') : 'Daily'
            ]);
    }

    private function getLastName($name) {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        return $last_name;
    }

}