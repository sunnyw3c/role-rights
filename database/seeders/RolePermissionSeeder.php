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

        // Auto-generate CRUD permissions per model.
        // WHY: instead of writing Permission::create() 20+ times, we loop.
        // To add a new model, just add its name to the $models array.
        $models = ['posts', 'users'];
        $actions = ['view', 'create', 'edit', 'delete'];

        foreach ($models as $model) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => "$action $model"]);
            }
        }

        // Extra permission that doesn't fit the CRUD pattern
        Permission::firstOrCreate(['name' => 'manage users']);

        // Create roles and assign permissions  - A role is a group of permissions. viewer can only view, editor can view/create/edit, admin gets everything.
        $viewer = Role::create(['name' => 'viewer']);
        $viewer->givePermissionTo('view posts');

        $editor = Role::create(['name' => 'editor']);
        $editor->givePermissionTo(['view posts', 'create posts', 'edit posts']);

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        // Super Admin role — has NO permissions assigned.
        // WHY: Gate::before() bypasses ALL permission checks for this role,
        // so assigning permissions is unnecessary. It can do everything automatically.
        Role::create(['name' => 'super admin']);


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

        $superAdmin = User::create([
            'name'     => 'Super Admin User',
            'email'    => 'superadmin@example.com',
            'password' => bcrypt('password'),
        ]);
        $superAdmin->assignRole('super admin');
    }
}
