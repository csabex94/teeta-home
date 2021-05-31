<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class EventsController extends Controller {

    public function __construct() {

    }

    public function show(Request $request) {
        if (!$request->date) {
            $events = Event::where([
                ['user_id', auth()->user()->id],
                ['title', 'LIKE', "%$request->search%"],
            ])->limit(20)->get();
        } else {
            $next = Carbon::parse($request->date)->addDay(1);
            $events = Event::where([
                ['user_id', auth()->user()->id],
                ['title', 'LIKE', "%$request->search%"],
                ['date', '>=' ,$request->date],
                ['date', '<=' ,$next]
            ])->orderBy('created_at', 'desc')->get();
        }

        return Inertia::render('Events/Show', [
            'events' => $events
        ]);
    }

    public function create() {
        return Inertia::render('Events/Create');
    }

    public function store(Request $request) {
        $validData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'daily' => 'required|boolean',
            'push_email' => 'required|boolean',
            'important' => 'required|boolean'
        ]);
        $newEvent = new Event();

        if ($validData) {
            $newEvent->title = $validData['title'];
            $newEvent->description = $validData['description'];
            $newEvent->daily = $validData['daily'];
            $newEvent->push_email = $validData['push_email'];
            $newEvent->important = $validData['important'];
            $newEvent->user_id = auth()->user()->id;
        }

        if ($request->spec_date) {
            $newEvent->spec_date = $request->spec_date;
        } else {
            $newEvent->daily = 1;
        }

        if ($request->spec_time) {
            $newEvent->spec_time = $request->spec_time;
        }

        if ($request->remind_before_option && $request->remind_before_option != 'Remind me before') {
            $newEvent->remind_before_option = $request->remind_before_option;
        }

        if ($request->remind_before_value) {
            $newEvent->remind_before_value = $request->remind_before_value;
        }

        $newEvent->save();
        return redirect()->route('events.show')->with('success', 'Event created.');
    }

    public function edit(Event $event)
    {
        return Inertia::render('Events/Edit', [
            'event' => [
                'id' => $event->id,
                'title' => $event->title,
                'description' => $event->description,
                'date' => $event->date,
                'spec_time' => $event->spec_time
            ]
        ]);
    }

    public function update(Request $request) {
        $validData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'daily' => 'required|boolean',
            'push_email' => 'required|boolean',
            'important' => 'required|boolean'
        ]);
        $eventToUpdate = Event::where('id', $request->eventId)->first();

        $eventToUpdate->title = $validData['title'];
        $eventToUpdate->description = $validData['description'];
        $eventToUpdate->push_email = $validData['push_email'];
        $eventToUpdate->important = $validData['important'];

        if ($validData['daily'] == true || $validData['daily'] == 1) {
            $eventToUpdate->remind_before_option = NULL;
            $eventToUpdate->remind_before_value = NULL;
            $eventToUpdate->spec_date = NULL;
            $eventToUpdate->daily = 1;
        } else {
            $eventToUpdate->daily = 0;
            if ($request->remind_before_option && $request->remind_before_value) {
                $eventToUpdate->remind_before_option = $request->remind_before_option;
                $eventToUpdate->remind_before_value = $request->remind_before_value;
            } else {
                $eventToUpdate->remind_before_option = NULL;
                $eventToUpdate->remind_before_value = NULL;
            }
            if ($request->spec_date) {
                $eventToUpdate->spec_date = $request->spec_date;
            } else {
                $eventToUpdate->spec_date = NULL;
            }

            if ($request->spec_time) {
                $eventToUpdate->spec_time = $request->spec_time;
            } else {
                $eventToUpdate->spec_time = NULL;
            }
        }
        $eventToUpdate->save();

        return redirect()->back()->with('success', 'Event modified successfully.');
    }

    public function delete(Request $request) {
        Event::find($request->eventId)->delete();
        Session::put('record_deleted', true);
        
        return redirect()->back()->with('success', 'Event deleted successfully.');
    }
}
