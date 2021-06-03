<?php

namespace App\Repositories\Event;

use Carbon\Carbon;
use App\Models\Event;

class EventRepository implements EventRepositoryInterface {
    
    protected $event;
    
    public function __construct(Event $event) {
        $this->event = $event;
    }

    public function getAllEvents() {
        return $this->event->get();
    }

    public function getEvent($id) {
        return $this->event->where('id', $id)->first();
    }

    public function getDailyEvents() {
        return $this->event->where('daily', 1)->get();
    }

    public function getTodaysEvents() {
        return $this->event->whereDate('spec_date', Carbon::today())->get();
    }
    
    public function getImportantEvents() {
        return $this->event->where('important', 1)->get();
    }

    public function getFollowingDaysEvents($days, $email = false) {
        $events = $this->event->where('daily', 0)->whereDate('spec_date', '>=', Carbon::now()->addDays($days));

        if($email) {
            $events->where('push_email', 1);
        }

        return $events->get();
    }

    public function getFollowingWeeksEvents($weeks, $email = false) {
        $events = $this->event->where('daily', 0)->whereDate('spec_date', '>=', Carbon::now()->addWeeks($weeks));

        if($email) {
            $events->where('push_email', 1);
        }

        return $events->get();
    }

    public function deletePreviousEvents($toDate = false) {
        $events = $this->event->where('daily', 0);

        if($toDate) { //delete tasks up to date
            $events->whereDate('spec_date', '<=', $toDate);
        } else {
            $events->whereDate('spec_date', '<=', Carbon::now()->subDays(3)); //don't remove last 3 days tasks yet
        }

        foreach($events->get() as $event) {
            $event->delete();
        }
    }
    
}