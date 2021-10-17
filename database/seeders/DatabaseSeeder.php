<?php

namespace Database\Seeders;

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
        $this->call(CountrySeeder::class);
        $this->call(JobStatusSeeder::class);
        $this->call(UserStatusSeeder::class);
        $this->call(SuperAdminSeeder::class);
        $this->call(AdminSeeder::class);
    }
}
