<form action="{{ route('events.store') }}" method="POST">
    @csrf
    <div>
        <label for="title">Event Title</label>
        <input type="text" id="title" name="title" required>
    </div>
    <div>
        <label for="description">Description</label>
        <textarea id="description" name="description" required></textarea>
    </div>
    <div>
        <label for="start_time">Start Time</label>
        <input type="datetime-local" id="start_time" name="start_time" required>
    </div>
    <div>
        <label for="end_time">End Time</label>
        <input type="datetime-local" id="end_time" name="end_time" required>
    </div>
    <div>
        <label for="location">Location</label>
        <input type="text" id="location" name="location" required>
    </div>
    <button type="submit">Create Event</button>
</form>
