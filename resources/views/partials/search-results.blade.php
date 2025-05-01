@if($users->isEmpty())
    <div class="py-4 text-center text-gray-500">
        No users found
    </div>
@else
    @foreach($users as $user)
        <a href="{{ route('users.show', $user->id) }}" >
        <div class="flex items-center p-3 border-b border-gray-100 hover:bg-gray-50">
            <div class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300 overflow-hidden mr-3">
                @if($user->profile_photo_path)
                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="h-full w-full object-cover"/>
                @else
                    <div class="h-full w-full flex items-center justify-center bg-gray-200 text-gray-500">
                        <i class="fas fa-user"></i>
                    </div>
                @endif
            </div>
            <div class="flex-grow">
                <p class="font-medium text-sm">{{ $user->name }}</p>
                <p class="text-xs text-gray-500">{{ $user->email }}</p>
            </div>

        </div>
        </a>
    @endforeach
@endif
