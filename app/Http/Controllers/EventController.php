<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\EventCreatedNotification;

class EventController extends Controller
{
    /**
     * Show all events to the user.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $events = Event::all();  // You can modify this to show events based on user or category.
        return view('events.index', compact('events'));
    }

    /**
     * Show a form to create a new event.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created event.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'location' => 'required|string|max:255',
        ]);

        $event = Event::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
        ]);

        // Notify the user who created the event
        $event->triggerEventNotification(Auth::user());

        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }

    /**
     * Show the details of a single event.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\View\View
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }
}
