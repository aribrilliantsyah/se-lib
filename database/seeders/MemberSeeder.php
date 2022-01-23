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
                'avatar' => url('storage/images/1/profile2.jpeg'),
                'member' => [
                    'id' => 1,
                    'code' => 'MBR-0001',
                    'full_name' => 'Neni',
                    'address' => 'Bojong Kukun',
                    'gender' => 'Female',
                    'photo' => url('storage/images/1/profile2.jpeg'),
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
                'avatar' => url('storage/images/1/profile6.jpg'),
                'member' => [
                    'id' => 2,
                    'code' => 'MBR-0002',
                    'full_name' => 'Euis',
                    'address' => 'Antapani',
                    'gender' => 'Female',
                    'photo' => url('storage/images/1/profile6.jpg'),
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
