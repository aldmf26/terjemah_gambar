<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'superadmin',
            'admin',
        ];

        foreach ($roles as $role) {
            $user = User::factory()->create([
                'name' => $role,
                'email' => "$role@gmail.com",
                'password' => bcrypt('password')
            ]);
            $user->assignRole($role);
        }
    }
}
