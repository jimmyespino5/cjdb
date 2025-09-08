<?php

namespace Database\Seeders;

use App\Models\Team;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(15)->create();
        Team::factory(15)->create();


        // User::factory()->create([
        //     'name' => 'Jimmy Espino',
        //     'email' => 'jimmyespino416@gmail.com',
        // ]);
    }
}
