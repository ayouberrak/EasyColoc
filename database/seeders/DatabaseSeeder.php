<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'is_global_admin' => true,
        ]);

        \App\Models\Colocation::factory(5)->create([
            'user_id' => $admin->id,
        ]);

        User::factory(5)->create()->each(function ($user) {
            \App\Models\Colocation::factory(1)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
