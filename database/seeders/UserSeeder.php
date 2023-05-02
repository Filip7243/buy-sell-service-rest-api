<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@mail.com',
                'password' => Hash::make('1234')
            ],
            [
                'first_name' => 'Mike',
                'last_name' => 'Scott',
                'email' => 'mike@mail.com',
                'password' => Hash::make('1234')
            ],
        ]);
    }
}
