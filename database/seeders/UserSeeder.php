<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = [
            [
                'username' => 'admin',
                'name'=>'Admin Tamvan',
                'email'=>'admin@selib.com',
                'role_id'=> 3,
                'password'=> bcrypt('rahasia'),
            ],
            [
                'username' => 'member1',
                'name'=>'Member 1',
                'email'=>'member1@selib.com',
                'role_id'=> 1,
                'password'=> bcrypt('rahasia'),
            ],
            [
                'username' => 'operator1',
                'name'=>'Operator 1',
                'email'=>'operator1@selib.com',
                'role_id'=> 2,
                'password'=> bcrypt('rahasia'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
