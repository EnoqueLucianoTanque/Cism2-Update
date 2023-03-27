<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\DB;

class ConsortiumMemberRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cmr_consortium_member_role')
        ->insert(
            // [
            //     'cmr_id' => 1,
            //     'cmr_description' => "Principal recipient",
            //     'created_at' => now(),
            //     'updated_at' => now()
            // ],
            [
                'cmr_id' => 2,
                'cmr_description' => "Sub recipient",
                'created_at' => now(),
                'updated_at' => now()
            ]
            );
    }
}
