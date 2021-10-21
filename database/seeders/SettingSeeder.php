<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'setting_name'  => 'How To Work',
            'setting_description' => 'How To Work',
            'created_at'    =>  Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

        DB::table('settings')->insert([
            'setting_name'  => 'Template Message',
            'setting_description' => 'Template Message',
            'created_at'    =>  Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

        DB::table('settings')->insert([
            'setting_name'  => 'Notice',
            'setting_description' => 'Notice',
            'created_at'    =>  Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
    }
}
