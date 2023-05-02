<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Db;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin
        $user=new User();

        $user->name='Admin';
        $user->surname='ADMIN';
        $user->username='admin';
        $user->email='admin@localhost';
        $user->password=Hash::make('321');
        $user->created_at=now();
        $user->updated_at=now();
        $user->save();
        $user->syncRoles('Admin');

        //User
        DB::table('users')->insert([
            'name' => 'John',
            'surname' => 'Doe',
            'username' => 'john',
            'email' => 'john3652@yopmail.com',
            'password' => Hash::make('123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
