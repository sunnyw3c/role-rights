<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Roles: {{ $user->name }}
            </h2>
            <a href="{{ route('users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Back to Users
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <div class="mb-4">
                    <p class="text-gray-600">Email: <strong>{{ $user->email }}</strong></p>
                </div>

                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Assign Roles</label>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach($roles as $role)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                        {{ in_array($role->name, $userRoles) ? 'checked' : '' }}>
                                    <span class="text-sm text-gray-700 capitalize">{{ $role->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                        Update Roles
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
