<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'role' => 1,
            'phone' => '0796431803',
            'email' => 'admin@gmail.com',
            'index_no' => '00000000',
            'password' => Hash::make('admin1234')
        ]);
    }
}
