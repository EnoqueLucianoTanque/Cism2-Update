<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'u_id' => 1,
            's_id' => 1,
            'r_id' => 9,
            'ui_id' => 1,
            'state' => 1,
            'username' => 'Admin',
            'email' => 'joao.novele@manhica.net',
            'created_at' => now(),
            'updated_at' => now(),
            'email_verified_at' => now(),
            'password' => Hash::make('escopilresearch00'),
        ]);
    }
}
