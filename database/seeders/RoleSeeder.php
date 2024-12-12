<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */ // // Créer des permissions
        // $permissions = [
        //     'manage users',        
        //     'view reports',        
        //     'manage payments'      // Gérer les paiements
        // ];
     public function run(): void
            {
                // Vérifiez et créez les permissions
                $permissions = [
                    'manage users',  // Gérer les utilisateurs
                    'view reports',   // Voir les rapports
                    'assign contracts',    // Assigner des contrats
                    'manage spaces',       // Gérer les emplacements
                    'manage payments',     // Gérer les paiements
                    'manage merchants',
                ];
        
                foreach ($permissions as $permissionName) {
                    if (!Permission::where('name', $permissionName)->exists()) {
                        Permission::create(['name' => $permissionName, 'guard_name' => 'web']);
                    }
                }
        
                // Créez les rôles et assignez des permissions
                $roles = [
                    'admin' => ['manage users', 'view reports', 'manage merchants'],
                    'agent' => ['view reports'],
                    'manager' => ['manage merchants', 'view reports'],
                ];
        
                foreach ($roles as $roleName => $rolePermissions) {
                    $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        
                    foreach ($rolePermissions as $permission) {
                        $permissionModel = Permission::where('name', $permission)->first();
                        $role->givePermissionTo($permissionModel);
                    }
                }
            }
        
        
}
