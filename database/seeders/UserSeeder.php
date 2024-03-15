<?php

namespace Database\Seeders;

use App\Models\DmRole;
use App\Models\DmUserStatus;
use App\Models\Patient;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id' => 1,
                'name' => 'Administrator',
                'description' => ''
            ],[
                'id' => 2,
                'name' => 'Doctor',
                'description' => ''
            ],[
                'id' => 3,
                'name' => 'Nurse',
                'description' => ''
            ]
        ];

        DmUserStatus::create([
            'status' => "Aktif",
            'description' => ''
        ]);

        DmUserStatus::create([
            'status' => "Nonaktif",
            'description' => ''
        ]);

        foreach($roles as $role){
            DmRole::create($role);
        }

        $users = [
            [
                'id' => 1,
                'nip' => '1',
                'name' => 'Ahmad Fauzi',
                'phone_number' => '1',
                'email' => 'admin@gmail.com',
                'password' => bcrypt("123"),
                'dm_user_status_id' => 1,
            ],[
                'id' => 2,
                'nip' => '1',
                'name' => 'dr. Ikhsan',
                'phone_number' => '1',
                'email' => 'dokter1@gmail.com',
                'password' => bcrypt("123"),
                'dm_user_status_id' => 1,
            ],[
                'id' => 3,
                'nip' => '1',
                'name' => 'dr. Fatmawati',
                'phone_number' => '1',
                'email' => 'dokter2@gmail.com',
                'password' => bcrypt("123"),
                'dm_user_status_id' => 1,
            ],[
                'id' => 4,
                'nip' => '1',
                'name' => 'Winda Widyanti',
                'phone_number' => '1',
                'email' => 'perawat@gmail.com',
                'password' => bcrypt("123"),
                'dm_user_status_id' => 1,
            ],
        ];

        foreach($users as $user){
            User::create($user);
        }

        $user_roles = [
            [
                'user_id' => 1,
                'dm_role_id' => 1
            ],[
                'user_id' => 2,
                'dm_role_id' => 1
            ],[
                'user_id' => 2,
                'dm_role_id' => 2
            ],[
                'user_id' => 3,
                'dm_role_id' => 2
            ],[
                'user_id' => 4,
                'dm_role_id' => 3
            ],
        ];

        foreach($user_roles as $userRole){
            UserRole::create($userRole);
        }
    }
}
