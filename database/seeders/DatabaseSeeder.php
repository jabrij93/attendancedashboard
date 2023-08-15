<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ItemType;
use App\Models\Item;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        ItemType::truncate();
        Item::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // User
        $user_janedoe = User::factory(1)->janeDoe()->create(); // Create one user with janeDoe state
        // dd('JANE DOE', $user_janedoe);
        $user = User::factory(9)->create();

        // Item type
        $item_types = ItemType::factory(3)->create();

        // Item
        $item = Item::factory(20)->create();

        // $this->call([
        //     DashboardTableSeeder::class,
        // ]);
    }
}
