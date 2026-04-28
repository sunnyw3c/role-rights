<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            {{-- @role('admin') - only admin sees this --}}
           @role('admin')
    <div class="bg-red-100 p-6 rounded-lg shadow">
        <h3 class="font-bold text-red-800 text-lg">Admin Panel</h3>
        <p class="text-red-700 mb-4">You can manage users, roles and everything.</p>
        <div class="flex space-x-3">
            <a href="{{ route('roles.index') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Manage Roles
            </a>
            <a href="{{ route('users.index') }}" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                Manage Users
            </a>
        </div>
    </div>
@endrole


            {{-- @role('editor') - only editor sees this --}}
            @role('editor')
                <div class="bg-yellow-100 p-6 rounded-lg shadow">
                    <h3 class="font-bold text-yellow-800 text-lg">Editor Panel</h3>
                    <p class="text-yellow-700">You can create and edit posts.</p>
                </div>
            @endrole

            {{-- @role('viewer') - only viewer sees this --}}
            @role('viewer')
                <div class="bg-green-100 p-6 rounded-lg shadow">
                    <h3 class="font-bold text-green-800 text-lg">Viewer Panel</h3>
                    <p class="text-green-700">You can view posts.</p>
                </div>
            @endrole

            {{-- @can - checks permission instead of role --}}
            @can('manage users')
                <div class="bg-purple-100 p-6 rounded-lg shadow">
                    <h3 class="font-bold text-purple-800 text-lg">User Management</h3>
                    <p class="text-purple-700">You have the "manage users" permission.</p>
                </div>
            @endcan

            @can('edit posts')
                <div class="bg-blue-100 p-6 rounded-lg shadow">
                    <h3 class="font-bold text-blue-800 text-lg">Post Editor</h3>
                    <p class="text-blue-700">You have the "edit posts" permission.</p>
                </div>
            @endcan

            {{-- @unlessrole - shows only when user does NOT have this role --}}
            @unlessrole('admin')
                <div class="bg-gray-100 p-6 rounded-lg shadow">
                    <h3 class="font-bold text-gray-800 text-lg">Upgrade Notice</h3>
                    <p class="text-gray-700">You are not an admin. Contact admin for more access.</p>
                </div>
            @endunlessrole

        </div>
    </div>
</x-app-layout>
