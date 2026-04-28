<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manage User Roles
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3">#</th>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Roles</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-t">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-semibold">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    @forelse($user->roles as $role)
                                        <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded mr-1">
                                            {{ $role->name }}
                                        </span>
                                    @empty
                                        <span class="text-gray-400 text-sm">No roles</span>
                                    @endforelse
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('users.edit', $user) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">
                                        Edit Roles
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-400">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
