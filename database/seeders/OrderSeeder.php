<?php

namespace Database\Seeders;

use App\Enums\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'price' => 2000.43,
                'quantity' => 300,
                'order_status' => OrderStatus::NOT_PAID,
                'product_id' => 1,
                'user_id' => 2
            ],
            [
                'price' => 1000.18,
                'quantity' => 300,
                'order_status' => OrderStatus::NOT_PAID,
                'product_id' => 5,
                'user_id' => 2
            ],
            [
                'price' => 658.20,
                'quantity' => 300,
                'order_status' => OrderStatus::PAID,
                'product_id' => 7,
                'user_id' => 1
            ],
            [
                'price' => 83217.10,
                'quantity' => 300,
                'order_status' => OrderStatus::CANCELED,
                'product_id' => 8,
                'user_id' => 1
            ],
            [
                'price' => 7321.29,
                'quantity' => 300,
                'order_status' => OrderStatus::RESERVED,
                'product_id' => 11,
                'user_id' => 2
            ]
        ]);
    }
}
