<?php

namespace Database\Seeders;

use App\Models\Role;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();

        $role_user = Role::where('name', 'user')->first();

        $admin = new User();
        $admin->name = 'Christian Butler';
        $admin->email = 'cbutler@stmc.ie';
        $admin->password = Hash::make('password');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $user= new User();
        $user->name = "John Smith";
        $user->email = 'jsmith@gmail.com';
        $user->password = Hash::make('password');
        $user->save();
    }
}
