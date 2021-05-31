<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class EventsController extends Controller {

    public function __construct() {
        
    }

    public function show(Request $request) {
        if (!$request->date) {
            $events = Event::where([
                ['user_id', auth()->user()->id],
                ['title', 'LIKE', "%$request->search%"],
            ])->limit(5)->get();
        } else {
            $next = Carbon::parse($request->date)->addDay(1);
            $events = Event::where([
                ['user_id', auth()->user()->id],
                ['title', 'LIKE', "%$request->search%"],
                ['date', '>=' ,$request->date],
                ['date', '<=' ,$next]
            ])->get();
        }

        return Inertia::render('Events/Show', [
            'events' => $events,
            'success' => 'Test'
        ]);
    }

    public function create() {
        return Inertia::render('Events/Create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => ['required', 'max:50'],
            'description' => ['required'],
            'date' => ['required'],
            'spec_time' => ['required']
        ]);

        if($validated) {
            Event::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'date' => $request->input('date'),
                'spec_time' => $request->input('spec_time'),
                'user_id' => Auth::id()
            ]);
        }

        return Redirect::route('events.show')->with('success', 'Event created.');
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
        $validate = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'required',
            'spec_time' => 'required'
        ]);

        $eventToUpdate = Event::find($request->eventId);
        $eventToUpdate->title = $validate['title']; 
        $eventToUpdate->description = $validate['description'];
        $eventToUpdate->date = $validate['date'];
        $eventToUpdate->spec_time = $validate['spec_time'];

        $eventToUpdate->save();

        return Redirect::back()->with(['events' => Event::where('user_id', auth()->user()->id)->get()]);
    }

    public function delete(Request $request) {
        Event::find($request->eventId)->delete();

        return redirect()->back()->with(['events' => Event::where('user_id', auth()->user()->id)->get()]);
    }
}
