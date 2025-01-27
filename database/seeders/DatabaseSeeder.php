<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        \App\Models\User::factory(20)->create();
        \App\Models\Transaction::factory(20)->create();
        // \App\Models\Logging::factory(20)->create();
        \App\Models\Notification::factory(20)->create();
        \App\Models\Operator::factory(20)->create();
        \App\Models\TypeUser::factory(20)->create();
    }
}
