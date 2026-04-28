<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Roles
            </h2>
            <a href="{{ route('roles.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Create New Role
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success message --}}
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
                            <th class="px-6 py-3">Role Name</th>
                            <th class="px-6 py-3">Permissions</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $role)
                            <tr class="border-t">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-semibold capitalize">{{ $role->name }}</td>
                                <td class="px-6 py-4">
                                    @forelse($role->permissions as $permission)
                                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1">
                                            {{ $permission->name }}
                                        </span>
                                    @empty
                                        <span class="text-gray-400 text-sm">No permissions</span>
                                    @endforelse
                                </td>
                                <td class="px-6 py-4 space-x-2">
                                    <a href="{{ route('roles.edit', $role) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">
                                        Edit
                                    </a>
                                    <form action="{{ route('roles.destroy', $role) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Delete this role?')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-400">No roles found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
