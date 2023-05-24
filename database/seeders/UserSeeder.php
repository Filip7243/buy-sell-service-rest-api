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
                'phone_number' => '+48712982462',
                'country' => 'Poland',
                'city' => 'Cracow',
                'postal_code' => '31-200',
                'street' => 'Kopisto',
                'flat_number' => 10,
                'house_number' => 11,
                'email' => 'john@mail.com',
                'password' => Hash::make('1234')
            ],
            [
                'first_name' => 'Mike',
                'last_name' => 'Doe',
                'phone_number' => '+48712982462',
                'country' => 'Poland',
                'city' => 'Poland',
                'postal_code' => 'Poland',
                'street' => 'Poland',
                'flat_number' => 'Poland',
                'house_number' => 'Poland',
                'email' => 'mike@mail.com',
                'password' => Hash::make('1234')
            ],
            [
                'first_name' => 'Harry',
                'last_name' => 'Doe',
                'phone_number' => '+48712982462',
                'country' => 'Poland',
                'city' => 'Poland',
                'postal_code' => 'Poland',
                'street' => 'Poland',
                'flat_number' => 'Poland',
                'house_number' => 'Poland',
                'email' => 'harry@mail.com',
                'password' => Hash::make('1234')
            ],
            [
                'first_name' => 'Marry',
                'last_name' => 'Doe',
                'phone_number' => '+48712982462',
                'country' => 'Poland',
                'city' => 'Poland',
                'postal_code' => 'Poland',
                'street' => 'Poland',
                'flat_number' => 'Poland',
                'house_number' => 'Poland',
                'email' => 'marry@mail.com',
                'password' => Hash::make('1234')
            ],
            [
                'first_name' => 'Greg',
                'last_name' => 'Doe',
                'phone_number' => '+48712982462',
                'country' => 'Poland',
                'city' => 'Poland',
                'postal_code' => 'Poland',
                'street' => 'Poland',
                'flat_number' => 'Poland',
                'house_number' => 'Poland',
                'email' => 'greg@mail.com',
                'password' => Hash::make('1234')
            ],
        ]);
    }
}
