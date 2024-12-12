<?php

namespace Database\Seeders;

use App\Models\roles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // Créer des rôles
        $adminRole = roles::create(['name' => 'admin']);
        $agentRole = Roles::create(['name' => 'agent']);

        // Créer des permissions
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'view reports']);

        // Associer des permissions aux rôles
        $adminRole->givePermissionTo(['manage users', 'view reports']);
        $agentRole->givePermissionTo('view reports');
    }
    }
