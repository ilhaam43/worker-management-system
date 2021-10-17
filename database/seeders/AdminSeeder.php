<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name'          => 'Admin',
            'created_at'    =>  Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

        DB::table('users')->insert([
            'status_id' => 1,
            'userable_id' => 1,
            'userable_type' => ('App\Models\Admin'),
            'name' => "Admin",
            'email' => "admintest@yopmail.com",
            'password' => Hash::make('admintest'),
            'country_id' => 10,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
