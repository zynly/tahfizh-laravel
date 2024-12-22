<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerRole = Role::create(['name'=> 'owner']);

        $ustadRole = Role::create(['name'=> 'ustad']);

        $siswaRole = Role::create(['name'=> 'siswa']);

        $userOwner =  User::create([
            'name'  => 'Abdullah',
            'avatar'  => 'images/default-avatar.png',
            'email'  => 'admin@admin.com',
            'password'  => bcrypt('123123123'),
        ]);

        $userOwner->assignRole($ownerRole);
        
    }
}
