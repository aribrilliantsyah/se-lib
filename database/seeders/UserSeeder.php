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
                'avatar' => url('storage/images/1/profile1.jfif'),
                'name'=>'Admin Tamvan',
                'email'=>'admin@selib.com',
                'role_id'=> 3,
                'password'=> bcrypt('rahasia'),
            ],
            [
                'username' => 'operator1',
                'avatar' => url('storage/images/1/profile4.jpg'),
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
