<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('s_staff')->insert([
            's_id' => 1,
            's_name' => 'Administrator',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
