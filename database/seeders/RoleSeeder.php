<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = [
            [
                'id' => 1,
                'role' => 'member',
                'description'=>'Akun sebagai member',
            ],
            [
                'id' => 2,
                'role' => 'operator',
                'description'=>'Akun sebagai operator',
            ],
            [
                'id' => 3,
                'role' => 'admin',
                'description'=>'Akun sebagai admin',
            ],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert($role);
        }
    }
}
