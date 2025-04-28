@extends('layouts.layout')

@section('content')
    <div x-data="{ showModal: false, formErrors: {} }" class="max-w-5xl mx-auto p-4 sm:p-6 lg:p-8">
        {{-- Header Section --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Upcoming Events</h1>
                <p class="text-gray-600 mt-1">Manage and view all your scheduled events</p>
            </div>
            <button
                @click="showModal = true"
                class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg shadow transition-colors duration-200 flex items-center gap-2"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Create Event
            </button>
        </div>

        <!-- Rest of your events list code remains the same -->

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
                    action="{{ route('events.store') }}"
                    method="POST"
                    class="space-y-5"
                    @submit.prevent="
                        const formData = new FormData();
                        formData.append('title', $refs.title.value);
                        formData.append('description', $refs.description.value);
                        formData.append('start_time', $refs.start_time.value);
                        formData.append('end_time', $refs.end_time.value);
                        formData.append('location', $refs.location.value);
                        formData.append('_token', document.querySelector('meta[name=csrf-token]').content);

                        fetch('{{ route('events.store') }}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            formErrors = {};
                            if (data.errors) {
                                formErrors = data.errors;
                            } else {
                                showModal = false;
                                window.location.href = data.redirect || '{{ route('events') }}';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        })
                    "
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

@section('scripts')
    {{-- Include Alpine.js if you don't already have it --}}
    <script src="//unpkg.com/alpinejs" defer></script>
@endsection
