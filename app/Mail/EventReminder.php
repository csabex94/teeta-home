<?php

namespace App\Mail;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventReminder extends Mailable {

    use Queueable, SerializesModels;

    protected $event;

    public function __construct(Event $event) {
        $this->event = $event;
    }

    public function build() {
        return $this->from('noreply@teeta.com')
            ->to($this->event->user->email)
            ->subject('Teeta Reminder - ' . $this->event->title)
            ->markdown('mails.event')
            ->with([
                'name' => $this->getLastName($this->event->user->name),
                'event' => $this->event,
                'date' => Carbon::createFromFormat('Y-m-d H:i:s', $this->event->spec_date)->toFormattedDateString(),
                'time' => Carbon::createFromFormat('H:i:s', $this->event->spec_time)->format('h:i')
            ]);
    }

    private function getLastName($name) {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        return $last_name;
    }
    
}