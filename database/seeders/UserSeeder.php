<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::all();

        $data = [
            [
                'status_account' => 'active',
                'email' => 'akun1@hugo.com',
                'password' => 'akun1#hugo',
                'phone' => '0831xxxxxxxx',
                'name' => 'Akun 1',
            ]
        ];

        foreach ($data as $item) {
            User::create([
                ...$item,
                'role_id' => $roles->random()->id ?? '',
            ]);
        }
    }
}
