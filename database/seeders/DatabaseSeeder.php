<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'user_id' => 'variant3a',
            'name' => 'Yuma Nishimura',
            'email' => 'sulfur.monoxide168@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
