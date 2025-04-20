@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-6">
    <!-- User Management Section -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-700">User Management</h2>
            <div class="flex items-center">
                <div class="relative mr-4">
                    <input type="text" placeholder="Search users" class="w-full py-2 pl-10 pr-3 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <th class="px-4 py-3">User</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Role</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Joined</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                @foreach($users as $user)
                <tr>
                    <td class="px-4 py-3">
                        <div class="flex items-center">
                            <div class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300 overflow-hidden mr-3">
                                <img src="{{ $user->profile_photo_path ?? '/api/placeholder/40/40' }}" alt="User" class="h-full w-full object-cover"/>
                            </div>
                            <div>
                                <p class="font-medium text-sm">{{ $user->name ?? 'Unknown User' }}</p>
                                <p class="text-xs text-gray-500">@{{ $user->username ?? 'No username' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm">{{ $user->email ?? 'No email' }}</td>
                    <td class="px-4 py-3 text-sm">{{ $user->role_id === 1 ? 'Admin' : 'User' }}</td>
                    <td class="px-4 py-3">
                        @if($user->trashed())
                            <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Banned</span>
                        @elseif($user->suspended_until && $user->suspended_until > now())
                            <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Suspended</span>
                        @else
                            <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Active</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-sm">{{ $user->created_at->format('M d, Y') }}</td>
                    <td class="px-4 py-3 text-sm">
                        <div class="flex space-x-2">
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-edit"></i>
                            </button>
                            @if($user->trashed())
                                <button onclick="unbanUser({{ $user->id }})" class="text-green-500 hover:text-green-700">
                                    <i class="fas fa-user-check"></i>
                                </button>
                            @else
                                <button onclick="banUser({{ $user->id }})" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-ban"></i>
                                </button>
                            @endif
                            @if($user->suspended_until && $user->suspended_until > now())
                                <button onclick="unsuspendUser({{ $user->id }})" class="text-green-500 hover:text-green-700">
                                    <i class="fas fa-user-check"></i>
                                </button>
                            @else
                                <button onclick="suspendUser({{ $user->id }})" class="text-yellow-500 hover:text-yellow-700">
                                    <i class="fas fa-user-slash"></i>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function banUser(userId) {
    if (confirm('Are you sure you want to ban this user?')) {
        fetch(`/admin/users/${userId}/ban`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to ban user: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to ban user: ' + error.message);
        });
    }
}

function unbanUser(userId) {
    if (confirm('Are you sure you want to unban this user?')) {
        fetch(`/admin/users/${userId}/unban`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to unban user');
            }
        });
    }
}

function suspendUser(userId) {
    const days = prompt('Enter number of days to suspend (default: 7):', '7');
    if (days !== null) {
        fetch(`/admin/users/${userId}/suspend`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ days: parseInt(days) || 7 })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to suspend user');
            }
        });
    }
}

function unsuspendUser(userId) {
    if (confirm('Are you sure you want to unsuspend this user?')) {
        fetch(`/admin/users/${userId}/unsuspend`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to unsuspend user');
            }
        });
    }
}
</script>
@endpush
@endsection 