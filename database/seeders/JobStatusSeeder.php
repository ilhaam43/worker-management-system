<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JobStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobs_status')->insert([
            'status' => 'Approved',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('jobs_status')->insert([
            'status' => 'Disapproved',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('jobs_status')->insert([
            'status' => 'Pending',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
