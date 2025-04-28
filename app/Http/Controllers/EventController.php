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
        $user = Auth::user();
        $events = Event::latest()->paginate(10);  // Paginating and ordering by latest
        return view('events.index', compact('events', 'user'));
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
        $validation = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after:start_time', // Ensure end_time is nullable
            'location' => 'required|string|max:255',
        ]);

        // Create event
        $event = Event::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
        ]);

        // Send notification if the event is created
        if ($event) {
            // Assuming EventCreatedNotification is correctly set up in the Event model
            $event->user->notify(new EventCreatedNotification($event));  // Notification to the event creator
        }

        // Check if it's an AJAX request
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Event created successfully!',
                'event' => $event,
                'redirect' => route('events.index')  // Ensure this route is correct
            ]);
        }

        // Redirect if not an AJAX request
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
