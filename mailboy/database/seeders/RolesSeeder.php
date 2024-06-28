<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'admin', 'guard_name' => 'web']);
        Role::create(['name' => 'client', 'guard_name' => 'web']);
        Role::create(['name' => 'subscriber', 'guard_name' => 'web']);
    }
}
