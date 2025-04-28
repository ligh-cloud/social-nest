@extends('layouts.layout')

@section('content')
    <div class="max-w-5xl mx-auto p-4 sm:p-6 lg:p-8">
        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('events') }}" class="inline-flex items-center text-emerald-600 hover:text-emerald-700 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Events
            </a>
        </div>

        {{-- Event Header --}}
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
            <div class="h-64 bg-emerald-100 relative">
                @if($event->image)
                    <img src="{{ $event->image }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-r from-emerald-500 to-teal-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-white opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif

                {{-- Event Status Badge --}}
                <div class="absolute top-4 right-4">
                    @if($event->start_time > now())
                        <span class="px-3 py-1 bg-emerald-100 text-emerald-800 text-sm font-medium rounded-full shadow-sm border border-emerald-200">
                            Upcoming
                        </span>
                    @elseif($event->end_time && $event->end_time < now())
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 text-sm font-medium rounded-full shadow-sm border border-gray-200">
                            Past
                        </span>
                    @else
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full shadow-sm border border-blue-200">
                            In Progress
                        </span>
                    @endif
                </div>
            </div>

            <div class="p-6 md:p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $event->title }}</h1>

                <div class="flex flex-wrap gap-6 mb-8">
                    <div class="flex items-start gap-3">
                        <div class="bg-emerald-100 rounded-full p-2 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Date & Time</h3>
                            <p class="text-gray-900">{{ \Carbon\Carbon::parse($event->start_time)->format('F j, Y') }}</p>
                            <p class="text-gray-700">{{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} - {{\Carbon\Carbon::parse($event->end_time)  }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="bg-emerald-100 rounded-full p-2 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Location</h3>
                            <p class="text-gray-900">{{ $event->location }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="bg-emerald-100 rounded-full p-2 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Duration</h3>
                            <p class="text-gray-900">
                                @if($event->end_time)
                                    {{ \Carbon\Carbon::parse($event->start_time)->diffForHumans($event->end_time, ['parts' => 2, 'short' => true]) }}
                                @else
                                    Not specified
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Event Actions --}}
                <div class="flex flex-wrap gap-3 mb-8">
                    <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Add to Calendar
                    </button>

                    <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-emerald-700 bg-emerald-100 hover:bg-emerald-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                        Share Event
                    </button>

                    @if(auth()->check() && (auth()->user()->id === $event->user_id || auth()->user()->can('edit events')))
                        <a href="{{ route('events.edit', $event) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Event
                        </a>

                        <form action="{{ route('events.destroy', $event) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this event?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        {{-- Event Description --}}
        <div class="bg-white rounded-xl shadow-sm p-6 md:p-8 mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">About This Event</h2>
            <div class="prose max-w-none">
                <p class="whitespace-pre-line">{{ $event->description }}</p>
            </div>
        </div>

        {{-- Event Organizer --}}
        @if(isset($event->user))
            <div class="bg-white rounded-xl shadow-sm p-6 md:p-8 mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Event Organizer</h2>
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-full bg-emerald-100 flex items-center justify-center">
                        @if($event->user->avatar)
                            <img src="{{ $event->user->avatar }}" alt="{{ $event->user->name }}" class="h-12 w-12 rounded-full object-cover">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        @endif
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-900">{{ $event->user->name }}</h3>
                        <p class="text-gray-500 text-sm">Event Organizer</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Map --}}
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
            <h2 class="text-xl font-bold text-gray-900 p-6 md:p-8 pb-4 md:pb-4">Location</h2>
            <div class="h-64 bg-gray-200">
                {{-- Replace with actual map integration --}}
                <div class="w-full h-full flex items-center justify-center bg-gray-100">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <p class="text-gray-500">{{ $event->location }}</p>
                        <a href="https://maps.google.com/?q={{ urlencode($event->location) }}" target="_blank" class="text-emerald-600 hover:text-emerald-700 text-sm mt-2 inline-block">
                            Open in Google Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related Events --}}
        @if(isset($relatedEvents) && $relatedEvents->count() > 0)
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Similar Events</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedEvents as $relatedEvent)
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden border border-gray-100 flex flex-col">
                            <div class="h-40 bg-emerald-100 relative">
                                @if($relatedEvent->image)
                                    <img src="{{ $relatedEvent->image }}" alt="{{ $relatedEvent->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-r from-emerald-500 to-teal-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1 bg-white text-emerald-800 text-xs font-medium rounded-full shadow-sm">
                                        {{ $relatedEvent->start_time->format('M j') }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-5 flex-grow">
                                <h3 class="text-lg font-semibold text-gray-800 line-clamp-1">{{ $relatedEvent->title }}</h3>
                                <p class="text-gray-600 mt-2 mb-4 line-clamp-2">{{ Str::limit($relatedEvent->description, 100) }}</p>
                            </div>

                            <div class="px-5 py-3 bg-gray-50 border-t border-gray-100">
                                <a
                                    href="{{ route('events.show', $relatedEvent) }}"
                                    class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-emerald-700 bg-emerald-100 hover:bg-emerald-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500"
                                >
                                    View Details
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection

@section('styles')
    <style>
        .prose {
            max-width: 65ch;
            color: #374151;
        }

        .prose p {
            margin-top: 1.25em;
            margin-bottom: 1.25em;
        }

        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
