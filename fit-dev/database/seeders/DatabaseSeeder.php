<?php

namespace Database\Seeders;

use App\Models\SportObject;
use App\Models\User;
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
        SportObject::factory()->count(30)->create();
        User::factory()
            ->hasFitCards(3)
            ->count(100)
            ->create();
    }
}
