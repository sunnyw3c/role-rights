<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create New Role
            </h2>
            <a href="{{ route('roles.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Back to Roles
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                {{-- Validation errors --}}
                @if($errors->any())
                    <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                        <ul class="list-disc pl-4">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf

                    {{-- Role Name --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Role Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"
                            placeholder="e.g. manager">
                    </div>

                    {{-- Permissions --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Assign Permissions</label>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach($permissions as $permission)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                        {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}>
                                    <span class="text-sm text-gray-700">{{ $permission->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                        Create Role
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
