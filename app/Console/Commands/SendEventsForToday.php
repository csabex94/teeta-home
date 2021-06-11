<?php

namespace App\Console\Commands;

use App\Events\SendEventsForToday as SEE;
use App\Notifications\SendEventsForToday as SEN;
use App\Mail\EventListReminder;
use App\Models\User;
use App\Repositories\Event\EventRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEventsForToday extends Command {

    protected $event, $user;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:events-for-today';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily emails with all the future events notice.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(EventRepositoryInterface $event, User $user) {
        parent::__construct();
        $this->event = $event;
        $this->user = $user;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $users = $this->user->get();
        foreach ($users as $user) {
            $eventList = $this->event->getTodaysEvents($user->id);
            if(count($eventList)) {
                $message = "You have ".count($eventList). (count($eventList) == 1) ? " event" : " events" . " today! Check on our website";
                $user->notify(new SEN($message));
                event(new SEE($message));
                Mail::to($user->email)->send(new EventListReminder($user, $eventList, 'day'));
            }
        }
        
    }

}