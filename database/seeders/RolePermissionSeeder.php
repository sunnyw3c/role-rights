<?php

namespace Database\Seeders;

#use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //Create permissions - Permissions are the individual actions a user can perform. We define them first, then assign them to roles.
        Permission::create(['name' => 'view posts']);
        Permission::create(['name' => 'create posts']);
        Permission::create(['name' => 'edit posts']);
        Permission::create(['name' => 'delete posts']);
        Permission::create(['name' => 'manage users']);

        // Create roles and assign permissions  - A role is a group of permissions. viewer can only view, editor can view/create/edit, admin gets everything.
        $viewer = Role::create(['name' => 'viewer']);
        $viewer->givePermissionTo('view posts');

        $editor = Role::create(['name' => 'editor']);
        $editor->givePermissionTo(['view posts', 'create posts', 'edit posts']);

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());


        //Create roles and assign role 

        $adminUser = User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $adminUser->assignRole('admin');

        $editorUser = User::create([
            'name'     => 'Editor User',
            'email'    => 'editor@example.com',
            'password' => bcrypt('password'),
        ]);
        $editorUser->assignRole('editor');

        $viewerUser = User::create([
            'name'     => 'Viewer User',
            'email'    => 'viewer@example.com',
            'password' => bcrypt('password'),
        ]);
        $viewerUser->assignRole('viewer');
    }
}
