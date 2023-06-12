<?php

namespace Database\Seeders;

use App\Enums\ProductCondition;
use App\Enums\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'BMW M3 Competition',
                'description' => 'BMW M3 Competition 300MPH 2018 NEW FOR SALE!!!',
                'image' => '/storage/default.jpg',
                'price' => 350000.20,
                'quantity' => 1,
                'condition' => ProductCondition::NEW,
                'type' => ProductType::FOR_SALE,
                'is_promoted' => false,
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Opel Corsa',
                'description' => 'I want buy Opel Corsa 1.2 2007.',
                'image' => 'placeholder',
                'price' => 8000.00,
                'quantity' => 1,
                'condition' => ProductCondition::USED,
                'type' => ProductType::TO_BUY,
                'is_promoted' => false,
                'category_id' => 1,
                'user_id' => 2
            ],

            [
                'name' => 'Wardrobe',
                'description' => 'Big new wardrobe',
                'image' => 'placeholder',
                'price' => 3500.00,
                'quantity' => 5,
                'condition' => ProductCondition::NEW,
                'type' => ProductType::FOR_SALE,
                'is_promoted' => false,
                'category_id' => 2,
                'user_id' => 2
            ],
            [
                'name' => 'Chair',
                'description' => 'I want buy chair',
                'image' => 'placeholder',
                'price' => 200.50,
                'quantity' => 1,
                'condition' => ProductCondition::USED,
                'type' => ProductType::TO_BUY,
                'is_promoted' => false,
                'category_id' => 2,
                'user_id' => 2
            ],

            [
                'name' => 'IPhone X',
                'description' => 'USED IPhone X, working well.',
                'image' => 'placeholder',
                'price' => 1000.50,
                'quantity' => 3,
                'condition' => ProductCondition::USED,
                'type' => ProductType::FOR_SALE,
                'is_promoted' => false,
                'category_id' => 3,
                'user_id' => 2
            ],
            [
                'name' => 'Arduino',
                'description' => 'Want buy arduino',
                'image' => 'placeholder',
                'price' => 333.50,
                'quantity' => 3,
                'condition' => ProductCondition::USED,
                'type' => ProductType::TO_BUY,
                'is_promoted' => false,
                'category_id' => 3,
                'user_id' => 1
            ],

            [
                'name' => 'Dress',
                'description' => 'Ideal dress for new year eve',
                'image' => 'placeholder',
                'price' => 250.50,
                'quantity' => 1,
                'condition' => ProductCondition::NEW,
                'type' => ProductType::FOR_SALE,
                'is_promoted' => false,
                'category_id' => 4,
                'user_id' => 1
            ],
            [
                'name' => 'NIKE Dunk',
                'description' => 'WTB NIKE Dunk',
                'image' => 'placeholder',
                'price' => 1000.50,
                'quantity' => 1,
                'condition' => ProductCondition::NEW,
                'type' => ProductType::TO_BUY,
                'is_promoted' => false,
                'category_id' => 4,
                'user_id' => 2
            ],

            [
                'name' => 'DOG rottweiler',
                'description' => 'Want buy dog rottweiler',
                'image' => 'placeholder',
                'price' => 500.82,
                'quantity' => 1,
                'condition' => ProductCondition::NEW,
                'type' => ProductType::TO_BUY,
                'is_promoted' => false,
                'category_id' => 5,
                'user_id' => 1
            ],
            [
                'name' => 'Cats food',
                'description' => '2kg food for cats',
                'image' => 'placeholder',
                'price' => 49.99,
                'quantity' => 10,
                'condition' => ProductCondition::NEW,
                'type' => ProductType::FOR_SALE,
                'is_promoted' => false,
                'category_id' => 5,
                'user_id' => 1
            ],

            [
                'name' => 'Toys',
                'description' => 'Old toys ideal for your kids!',
                'image' => 'placeholder',
                'price' => 100.99,
                'quantity' => 5,
                'condition' => ProductCondition::USED,
                'type' => ProductType::FOR_SALE,
                'is_promoted' => false,
                'category_id' => 6,
                'user_id' => 1
            ],
            [
                'name' => 'Toys',
                'description' => 'I want buy toys',
                'image' => 'placeholder',
                'price' => 50.99,
                'quantity' => 5,
                'condition' => ProductCondition::NEW,
                'type' => ProductType::TO_BUY,
                'is_promoted' => false,
                'category_id' => 6,
                'user_id' => 2
            ],

            [
                'name' => 'Ball',
                'description' => 'Adidas Ball from WordCup Final 2022',
                'image' => 'placeholder',
                'price' => 5000.99,
                'quantity' => 1,
                'condition' => ProductCondition::NEW,
                'type' => ProductType::FOR_SALE,
                'is_promoted' => false,
                'category_id' => 7,
                'user_id' => 2
            ],
            [
                'name' => 'Lewandowski Barcelona jersey',
                'description' => 'After match jersey',
                'image' => 'placeholder',
                'price' => 1500.00,
                'quantity' => 1,
                'condition' => ProductCondition::NEW,
                'type' => ProductType::TO_BUY,
                'is_promoted' => false,
                'category_id' => 7,
                'user_id' => 1
            ],
        ]);
    }
}
