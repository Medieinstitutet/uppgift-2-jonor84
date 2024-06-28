<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserRolesSeeder extends Seeder
{
    public function run()
    {
        $user = User::find(1);
        $user->assignRole('admin');

        $user = User::find(2);
        $user->assignRole('client');

        $user = User::find(3);
        $user->assignRole('subscriber');
    }
}
