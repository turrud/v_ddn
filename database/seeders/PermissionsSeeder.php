<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions

        Permission::create(['name' => 'list allnews']);
        Permission::create(['name' => 'view allnews']);
        Permission::create(['name' => 'create allnews']);
        Permission::create(['name' => 'update allnews']);
        Permission::create(['name' => 'delete allnews']);

        Permission::create(['name' => 'list aboutawards']);
        Permission::create(['name' => 'view aboutawards']);
        Permission::create(['name' => 'create aboutawards']);
        Permission::create(['name' => 'update aboutawards']);
        Permission::create(['name' => 'delete aboutawards']);

        Permission::create(['name' => 'list aboutclients']);
        Permission::create(['name' => 'view aboutclients']);
        Permission::create(['name' => 'create aboutclients']);
        Permission::create(['name' => 'update aboutclients']);
        Permission::create(['name' => 'delete aboutclients']);

        Permission::create(['name' => 'list aboutevents']);
        Permission::create(['name' => 'view aboutevents']);
        Permission::create(['name' => 'create aboutevents']);
        Permission::create(['name' => 'update aboutevents']);
        Permission::create(['name' => 'delete aboutevents']);

        Permission::create(['name' => 'list allaboutpeople']);
        Permission::create(['name' => 'view allaboutpeople']);
        Permission::create(['name' => 'create allaboutpeople']);
        Permission::create(['name' => 'update allaboutpeople']);
        Permission::create(['name' => 'delete allaboutpeople']);

        Permission::create(['name' => 'list contactcourses']);
        Permission::create(['name' => 'view contactcourses']);
        Permission::create(['name' => 'create contactcourses']);
        Permission::create(['name' => 'update contactcourses']);
        Permission::create(['name' => 'delete contactcourses']);

        Permission::create(['name' => 'list contactdonations']);
        Permission::create(['name' => 'view contactdonations']);
        Permission::create(['name' => 'create contactdonations']);
        Permission::create(['name' => 'update contactdonations']);
        Permission::create(['name' => 'delete contactdonations']);

        Permission::create(['name' => 'list contactfreelances']);
        Permission::create(['name' => 'view contactfreelances']);
        Permission::create(['name' => 'create contactfreelances']);
        Permission::create(['name' => 'update contactfreelances']);
        Permission::create(['name' => 'delete contactfreelances']);

        Permission::create(['name' => 'list contactinvests']);
        Permission::create(['name' => 'view contactinvests']);
        Permission::create(['name' => 'create contactinvests']);
        Permission::create(['name' => 'update contactinvests']);
        Permission::create(['name' => 'delete contactinvests']);

        Permission::create(['name' => 'list contactpartners']);
        Permission::create(['name' => 'view contactpartners']);
        Permission::create(['name' => 'create contactpartners']);
        Permission::create(['name' => 'update contactpartners']);
        Permission::create(['name' => 'delete contactpartners']);

        Permission::create(['name' => 'list contactservices']);
        Permission::create(['name' => 'view contactservices']);
        Permission::create(['name' => 'create contactservices']);
        Permission::create(['name' => 'update contactservices']);
        Permission::create(['name' => 'delete contactservices']);

        Permission::create(['name' => 'list homes']);
        Permission::create(['name' => 'view homes']);
        Permission::create(['name' => 'create homes']);
        Permission::create(['name' => 'update homes']);
        Permission::create(['name' => 'delete homes']);

        Permission::create(['name' => 'list servicearchitectures']);
        Permission::create(['name' => 'view servicearchitectures']);
        Permission::create(['name' => 'create servicearchitectures']);
        Permission::create(['name' => 'update servicearchitectures']);
        Permission::create(['name' => 'delete servicearchitectures']);

        Permission::create(['name' => 'list serviceboothdesigns']);
        Permission::create(['name' => 'view serviceboothdesigns']);
        Permission::create(['name' => 'create serviceboothdesigns']);
        Permission::create(['name' => 'update serviceboothdesigns']);
        Permission::create(['name' => 'delete serviceboothdesigns']);

        Permission::create(['name' => 'list serviceinteriordesigns']);
        Permission::create(['name' => 'view serviceinteriordesigns']);
        Permission::create(['name' => 'create serviceinteriordesigns']);
        Permission::create(['name' => 'update serviceinteriordesigns']);
        Permission::create(['name' => 'delete serviceinteriordesigns']);

        Permission::create(['name' => 'list serviceinteriorpublics']);
        Permission::create(['name' => 'view serviceinteriorpublics']);
        Permission::create(['name' => 'create serviceinteriorpublics']);
        Permission::create(['name' => 'update serviceinteriorpublics']);
        Permission::create(['name' => 'delete serviceinteriorpublics']);

        Permission::create(['name' => 'list servicevirtualoffices']);
        Permission::create(['name' => 'view servicevirtualoffices']);
        Permission::create(['name' => 'create servicevirtualoffices']);
        Permission::create(['name' => 'update servicevirtualoffices']);
        Permission::create(['name' => 'delete servicevirtualoffices']);

        Permission::create(['name' => 'list serviceweddingdecorations']);
        Permission::create(['name' => 'view serviceweddingdecorations']);
        Permission::create(['name' => 'create serviceweddingdecorations']);
        Permission::create(['name' => 'update serviceweddingdecorations']);
        Permission::create(['name' => 'delete serviceweddingdecorations']);

        Permission::create(['name' => 'list store3darchitectures']);
        Permission::create(['name' => 'view store3darchitectures']);
        Permission::create(['name' => 'create store3darchitectures']);
        Permission::create(['name' => 'update store3darchitectures']);
        Permission::create(['name' => 'delete store3darchitectures']);

        Permission::create(['name' => 'list store3dbooths']);
        Permission::create(['name' => 'view store3dbooths']);
        Permission::create(['name' => 'create store3dbooths']);
        Permission::create(['name' => 'update store3dbooths']);
        Permission::create(['name' => 'delete store3dbooths']);

        Permission::create(['name' => 'list store3dfurnitures']);
        Permission::create(['name' => 'view store3dfurnitures']);
        Permission::create(['name' => 'create store3dfurnitures']);
        Permission::create(['name' => 'update store3dfurnitures']);
        Permission::create(['name' => 'delete store3dfurnitures']);

        Permission::create(['name' => 'list storedecorations']);
        Permission::create(['name' => 'view storedecorations']);
        Permission::create(['name' => 'create storedecorations']);
        Permission::create(['name' => 'update storedecorations']);
        Permission::create(['name' => 'delete storedecorations']);

        Permission::create(['name' => 'list storeflorists']);
        Permission::create(['name' => 'view storeflorists']);
        Permission::create(['name' => 'create storeflorists']);
        Permission::create(['name' => 'update storeflorists']);
        Permission::create(['name' => 'delete storeflorists']);

        Permission::create(['name' => 'list storefurnitures']);
        Permission::create(['name' => 'view storefurnitures']);
        Permission::create(['name' => 'create storefurnitures']);
        Permission::create(['name' => 'update storefurnitures']);
        Permission::create(['name' => 'delete storefurnitures']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}