<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'Motorization'],
            ['name' => 'Home and Garden'],
            ['name' => 'Electronics'],
            ['name' => 'Fashion'],
            ['name' => 'Animals'],
            ['name' => 'Kids'],
            ['name' => 'Sport'],
        ]);
    }
}
