<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
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
                'username' => 'neni',
                'name'=>'Neni',
                'email'=>'neni@selib.com',
                'role_id'=> 1,
                'password'=> bcrypt('rahasia'),
                'member' => [
                    'id' => 1,
                    'code' => 'MB-001',
                    'full_name' => 'Neni',
                    'address' => 'Bojong Kukun',
                    'gender' => 'female',
                    'photo' => '',
                    'profession' => 'student',
                    'user_id' => ''
                ]
            ],
            [
                'username' => 'euis',
                'name'=>'Euis',
                'email'=>'euis@selib.com',
                'role_id'=> 1,
                'password'=> bcrypt('rahasia'),
                'member' => [
                    'id' => 2,
                    'code' => 'MB-002',
                    'full_name' => 'Euis',
                    'address' => 'Antapani',
                    'gender' => 'female',
                    'photo' => '',
                    'profession' => 'student',
                    'user_id' => ''
                ]
            ],
        ];

        foreach ($users as $user) {
            $member = $user['member'];
            unset($user['member']);

            $model = User::create($user);
            $user_id = $model->id;

            $member['user_id'] = $user_id;
            Member::create($member);
        } 
    }
}
