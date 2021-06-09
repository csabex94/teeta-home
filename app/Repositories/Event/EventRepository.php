<?php

namespace App\Repositories\Event;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Support\Facades\Session;

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

    public function getCompletedEvents() {
        return $this->event->where([['completed', 1], ['user_id', auth()->user()->id]])->get();
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
        $events = $this->event->where('daily', 0)->where('keep_in_list', 0);

        if($toDate) { //delete events up to date
            $events->whereDate('spec_date', '<=', $toDate);
        } else {
            $events->whereDate('spec_date', '<=', Carbon::now()->subDays(1)); //don't remove previous day events yet
        }

        foreach($events->get() as $event) {
            $event->delete();
        }
    }

    public function deleteEvent($id) {
        $this->event->find($id)->delete();
        Session::put('record_deleted', true);
    }

    public function store($request) {
        $validData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'daily' => 'required|boolean',
            'push_email' => 'required|boolean',
            'important' => 'required|boolean'
        ]);

        if ($validData) {
            $this->event->title = $validData['title'];
            $this->event->description = $validData['description'];
            $this->event->daily = $validData['daily'];
            $this->event->push_email = $validData['push_email'];
            $this->event->important = $validData['important'];
            $this->event->user_id = auth()->user()->id;
        }

        if ($request->spec_date) {
            $this->event->spec_date = $request->spec_date;
        } else {
            $this->event->daily = 1;
        }

        if ($request->spec_time) {
            $this->event->spec_time = $request->spec_time;
        }

        if ($request->remind_before_option && $request->remind_before_option != 'Remind me before') {
            $this->event->remind_before_option = $request->remind_before_option;
        }

        if ($request->remind_before_value) {
            $this->event->remind_before_value = $request->remind_before_value;
        }

        $this->event->save();
    }

    public function update($request) {
        $validData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'daily' => 'required|boolean',
            'push_email' => 'required|boolean',
            'important' => 'required|boolean'
        ]);
        $event = $this->event->where('id', $request->eventId)->first();

        $event->title = $validData['title'];
        $event->description = $validData['description'];
        $event->push_email = $validData['push_email'];
        $event->important = $validData['important'];

        if ($validData['daily'] == true || $validData['daily'] == 1) {
            $event->remind_before_option = NULL;
            $event->remind_before_value = NULL;
            $event->spec_date = NULL;
            $event->daily = 1;
        } else {
            $event->daily = 0;
            if ($request->remind_before_option && $request->remind_before_value) {
                $event->remind_before_option = $request->remind_before_option;
                $event->remind_before_value = $request->remind_before_value;
            } else {
                $event->remind_before_option = NULL;
                $event->remind_before_value = NULL;
            }
            if ($request->spec_date) {
                $event->spec_date = $request->spec_date;
            } else {
                $event->spec_date = NULL;
            }

            if ($request->spec_time) {
                $event->spec_time = $request->spec_time;
            } else {
                $event->spec_time = NULL;
            }
        }

        $event->save();
    }

    public function completeEvent($id) {
        $event = $this->event->find($id);
        $event->completed = 1;
        $event->save();
    }
}
