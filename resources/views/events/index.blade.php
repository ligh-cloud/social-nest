@extends('layouts.layout')

@section('content')
    <div x-data="{ showModal: false, formErrors: {}, activeTab: 'upcoming', showFilters: false }" class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        {{-- Header Section with Background --}}
        <div class="relative mb-10 bg-gradient-to-r from-emerald-600 to-teal-500 rounded-2xl p-8 text-white shadow-lg overflow-hidden">
            <div class="absolute inset-0 bg-pattern opacity-10"></div>
            <div class="relative z-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
                <div>
                    <h1 class="text-4xl font-bold">Events Dashboard</h1>
                    <p class="mt-2 text-emerald-100 max-w-xl">Discover, create and manage all your events in one place. Stay organized and never miss an important occasion.</p>
                </div>
                <button
                    @click="showModal = true"
                    class="bg-white text-emerald-700 hover:bg-emerald-50 px-5 py-3 rounded-lg shadow-md transition-colors duration-200 flex items-center gap-2 font-medium"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Create Event
                </button>
            </div>
        </div>

        {{-- Tabs and Filters --}}
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                {{-- Tabs --}}
                <div class="flex space-x-1 bg-gray-100 p-1 rounded-lg">
                    <button
                        @click="activeTab = 'upcoming'"
                        :class="activeTab === 'upcoming' ? 'bg-white text-emerald-700 shadow' : 'text-gray-600 hover:text-gray-800'"
                        class="px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200"
                    >
                        Upcoming
                    </button>
                    <button
                        @click="activeTab = 'past'"
                        :class="activeTab === 'past' ? 'bg-white text-emerald-700 shadow' : 'text-gray-600 hover:text-gray-800'"
                        class="px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200"
                    >
                        Past Events
                    </button>
                    <button
                        @click="activeTab = 'all'"
                        :class="activeTab === 'all' ? 'bg-white text-emerald-700 shadow' : 'text-gray-600 hover:text-gray-800'"
                        class="px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200"
                    >
                        All Events
                    </button>
                </div>

                {{-- Search and Filter --}}
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <div class="relative flex-grow">
                        <input
                            type="text"
                            placeholder="Search events..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <button
                        @click="showFilters = !showFilters"
                        class="p-2 border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        :class="showFilters ? 'bg-emerald-50 border-emerald-200 text-emerald-700' : ''"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Filter Panel --}}
            <div x-show="showFilters" x-transition class="bg-gray-50 p-4 rounded-lg mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="date-filter" class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
                        <select id="date-filter" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            <option value="all">All Dates</option>
                            <option value="today">Today</option>
                            <option value="this-week">This Week</option>
                            <option value="this-month">This Month</option>
                            <option value="custom">Custom Range</option>
                        </select>
                    </div>
                    <div>
                        <label for="location-filter" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                        <select id="location-filter" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            <option value="all">All Locations</option>
                            <option value="online">Online</option>
                            <option value="in-person">In-Person</option>
                        </select>
                    </div>
                    <div>
                        <label for="sort-by" class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                        <select id="sort-by" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            <option value="date-asc">Date (Earliest First)</option>
                            <option value="date-desc">Date (Latest First)</option>
                            <option value="title-asc">Title (A-Z)</option>
                            <option value="title-desc">Title (Z-A)</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors duration-200">
                        Apply Filters
                    </button>
                </div>
            </div>
        </div>

        {{-- Events List --}}
        <div x-show="activeTab === 'upcoming' || activeTab === 'all'">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Upcoming Events</h2>

            @if($events->isEmpty())
                <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="text-gray-500 mt-4 text-lg">No upcoming events available.</p>
                    <button
                        @click="showModal = true"
                        class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-emerald-700 bg-emerald-100 hover:bg-emerald-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500"
                    >
                        Schedule your first event
                    </button>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-6">
                    @foreach($events->where('start_time', '>=', now()) as $event)
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden border border-gray-100 flex flex-col">
                            <div class="h-40 bg-emerald-100 relative">
                                @if($event->image)
                                    <img src="{{ $event->image }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-r from-emerald-500 to-teal-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1 bg-white text-emerald-800 text-xs font-medium rounded-full shadow-sm">
                                        {{ \Carbon\Carbon::parse($event->start_time)->format('M j, Y') }}

                                    </span>
                                </div>
                            </div>

                            <div class="p-5 flex-grow">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-lg font-semibold text-gray-800 line-clamp-1">{{ $event->title }}</h3>
                                </div>

                                <p class="text-gray-600 mb-4 line-clamp-2">{{ Str::limit($event->description, 120) }}</p>

                                <div class="space-y-2 text-sm text-gray-600">
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>{{ $event->start_time->format('g:i A') }} - {{ $event->end_time ? $event->end_time->format('g:i A') : 'TBD' }}</span>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="line-clamp-1">{{ $event->location }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="px-5 py-3 bg-gray-50 border-t border-gray-100">
                                <a
                                    href="{{ route('events.show', $event) }}"
                                    class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-emerald-700 bg-emerald-100 hover:bg-emerald-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500"
                                >
                                    View Details
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Past Events --}}
        <div x-show="activeTab === 'past' || activeTab === 'all'" x-cloak>
            <h2 class="text-2xl font-bold text-gray-900 mb-6 mt-10">Past Events</h2>

            @if($events->where('start_time', '<', now())->isEmpty())
                <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-gray-500 mt-4 text-lg">No past events available.</p>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-6">
                    @foreach($events->where('start_time', '<', now()) as $event)
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden border border-gray-100 flex flex-col opacity-80">
                            <div class="h-40 bg-gray-100 relative">
                                @if($event->image)
                                    <img src="{{ $event->image }}" alt="{{ $event->title }}" class="w-full h-full object-cover filter grayscale">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-r from-gray-400 to-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1 bg-white text-gray-800 text-xs font-medium rounded-full shadow-sm">
                                        {{ \Carbon\Carbon::parse($event->start_time)->format('M j, Y') }}

                                    </span>
                                </div>
                            </div>

                            <div class="p-5 flex-grow">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-lg font-semibold text-gray-800 line-clamp-1">{{ $event->title }}</h3>
                                </div>

                                <p class="text-gray-600 mb-4 line-clamp-2">{{ Str::limit($event->description, 120) }}</p>

                                <div class="space-y-2 text-sm text-gray-600">
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($event->start_time)->format('M j, Y') }}</span>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="line-clamp-1">{{ $event->location }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="px-5 py-3 bg-gray-50 border-t border-gray-100">
                                <a
                                    href="{{ route('events.show', $event) }}"
                                    class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                                >
                                    View Details
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $events->links() }}
        </div>

        {{-- Modal Background --}}
        <div
            x-show="showModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
            style="display: none;"
        >
            {{-- Modal Panel --}}
            <div
                x-show="showModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                @click.away="showModal = false"
                class="bg-white rounded-xl shadow-xl max-w-md w-full p-6 relative overflow-y-auto max-h-[90vh]"
                style="display: none;"
            >
                {{-- Close Button --}}
                <button
                    type="button"
                    @click="showModal = false"
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 rounded-full p-1"
                    aria-label="Close modal"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <h2 class="text-2xl font-bold mb-6 text-gray-900">Create New Event</h2>

                <form
                    id="createEventForm"
                    action="{{ route('events.store') }}"
                    method="POST"
                    class="space-y-5"
                >
                    @csrf

                    <div>
                        <label for="title" class="block font-medium text-gray-700">Event Title</label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            x-ref="title"
                            required
                            class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200"
                            :class="{'border-red-500': formErrors.title}"
                        >
                        <template x-if="formErrors.title">
                            <p x-text="formErrors.title[0]" class="mt-1 text-sm text-red-600"></p>
                        </template>
                        @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block font-medium text-gray-700">Description</label>
                        <textarea
                            id="description"
                            name="description"
                            x-ref="description"
                            required
                            class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200"
                            :class="{'border-red-500': formErrors.description}"
                            rows="3"
                        ></textarea>
                        <template x-if="formErrors.description">
                            <p x-text="formErrors.description[0]" class="mt-1 text-sm text-red-600"></p>
                        </template>
                        @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="start_time" class="block font-medium text-gray-700">Start Time</label>
                            <input
                                type="datetime-local"
                                id="start_time"
                                name="start_time"
                                x-ref="start_time"
                                required
                                class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200"
                                :class="{'border-red-500': formErrors.start_time}"
                            >
                            <template x-if="formErrors.start_time">
                                <p x-text="formErrors.start_time[0]" class="mt-1 text-sm text-red-600"></p>
                            </template>
                            @error('start_time')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="end_time" class="block font-medium text-gray-700">End Time</label>
                            <input
                                type="datetime-local"
                                id="end_time"
                                name="end_time"
                                x-ref="end_time"
                                class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200"
                                :class="{'border-red-500': formErrors.end_time}"
                            >
                            <template x-if="formErrors.end_time">
                                <p x-text="formErrors.end_time[0]" class="mt-1 text-sm text-red-600"></p>
                            </template>
                            @error('end_time')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="location" class="block font-medium text-gray-700">Location</label>
                        <input
                            type="text"
                            id="location"
                            name="location"
                            x-ref="location"
                            required
                            class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200"
                            :class="{'border-red-500': formErrors.location}"
                        >
                        <template x-if="formErrors.location">
                            <p x-text="formErrors.location[0]" class="mt-1 text-sm text-red-600"></p>
                        </template>
                        @error('location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="image" class="block font-medium text-gray-700">Event Image (Optional)</label>
                        <input
                            type="file"
                            id="image"
                            name="image"
                            accept="image/*"
                            class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200"
                        >
                        <template x-if="formErrors.image">
                            <p x-text="formErrors.image[0]" class="mt-1 text-sm text-red-600"></p>
                        </template>
                        @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3 pt-2">
                        <button
                            type="button"
                            @click="showModal = false"
                            class="px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors duration-200"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="px-4 py-2 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors duration-200"
                        >
                            Create Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.2'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        [x-cloak] {
            display: none !important;
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

@section('scripts')
    {{-- Include Alpine.js if you don't already have it --}}
    <script src="//unpkg.com/alpinejs" defer></script>

    <script>
        document.addEventListener('alpine:init', () => {
            // Make sure Alpine.js is fully initialized
            document.addEventListener('DOMContentLoaded', () => {
                // Add event listener to the form
                const form = document.getElementById('createEventForm');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        // The form will submit normally
                        // This ensures the standard Laravel form processing works
                    });
                }
            });
        });
    </script>
@endsection
