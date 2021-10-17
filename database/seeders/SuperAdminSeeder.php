<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('superadmins')->insert([
            'name'          => 'Superadmin',
            'created_at'    =>  Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

        DB::table('users')->insert([
            'status_id' => 1,
            'userable_id'       => 1,
            'userable_type'     => ('App\Models\SuperAdmin'),
            'name' => "Superadmin",
            'email' => "superadmintest@yopmail.com",
            'password' => Hash::make('superadmintest'),
            'country_id' => 10,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
