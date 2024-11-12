<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Insérer les rôles dans la table "roles"
        DB::table('roles')->insert([
            ['name' => 'supeur admin'],
            ['name' => 'admin'],
            ['name' => 'user'],
            ['name' => 'subscriber'],
        ]);
    }
}
