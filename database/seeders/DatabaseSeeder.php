<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Gender;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Gender::factory(2)->create();
        \App\Models\User::factory(1)->janeDoe()->create(); // Create one user with janeDoe state
        \App\Models\User::factory(10)->create();
    }
}
