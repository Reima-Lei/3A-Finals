<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\students;
use App\Models\subject;
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
        students::factory(10)->create();
        subject::factory(10)->create();

    }
}
