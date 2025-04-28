@foreach($events as $event)
    <div>
        <h2>{{ $event->title }}</h2>
        <p>{{ $event->description }}</p>
        <p>Start: {{ $event->start_time }}</p>
        <p>End: {{ $event->end_time }}</p>
        <p>Location: {{ $event->location }}</p>
        <a href="{{ route('events.show', $event) }}">View Event</a>
    </div>
@endforeach
