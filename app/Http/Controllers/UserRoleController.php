<?php

namespace App\Http\Controllers;

#use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function index()
    {
        $users =  User::with('roles')->get();
        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $userRoles = $user->roles->pluck('name')->toArray();
        $userDirectPermissions = $user->getDirectPermissions()->pluck('name')->toArray();
        return view('users.edit', compact('user', 'roles', 'userRoles', 'permissions', 'userDirectPermissions'));
    }

    public function update(Request $request, User $user)
    {
        //sync roles
        $user->syncRoles($request->roles ?? []);

        //sync direct permissions
        $user->syncPermissions($request->permissions ?? []);
        return redirect()->route('users.index')->with('success', 'User role has been updated successfully.');
    }
}
