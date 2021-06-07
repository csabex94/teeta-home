<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Repositories\Event\EventRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class EventsController extends Controller {

    protected $event;

    public function __construct(EventRepositoryInterface $event) {
        $this->event = $event;
    }

    public function show(Request $request) {
        if (!$request->date) {
            $events = Event::where([
                ['user_id', auth()->user()->id],
                ['title', 'LIKE', "%$request->search%"],
            ])->get(); //needs pagination
        } else {
            $events = Event::where([
                ['user_id', auth()->user()->id],
                ['title', 'LIKE', "%$request->search%"],
                ['spec_date', '=' ,$request->date],
            ])->orderBy('spec_date', 'asc')->get();
        }
        return Inertia::render('Events/Show', [
            'events' => $events
        ]);
    }

    public function create() {
        return Inertia::render('Events/Create');
    }

    public function store(Request $request) {
        $this->event->store($request);

        return redirect()->route('events.show')->with('success', 'Event created.');
    }

    public function edit(Event $event) {
        return Inertia::render('Events/Edit', $event);
    }

    public function update(Request $request) {
        $this->event->update($request);

        return redirect()->back()->with('success', 'Event modified successfully.');
    }

    public function delete(Request $request) {
        $this->event->deleteEvent($request->eventId);

        return redirect()->back()->with('success', 'Event deleted successfully.');
    }

}
