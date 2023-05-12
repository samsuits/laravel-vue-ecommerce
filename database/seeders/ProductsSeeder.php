<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker)
    {
        $users= collect(User::all()->modelKeys());
        $data = [];

        for ($i = 0; $i < 1000; $i++) {
            $data[] = [
                'title' => $faker->text,
                'slug' => $faker->slug,
                'image' => $faker->imageUrl(),
                'description' => $faker->text(200),
                'price' => $faker->numberBetween(100,999),
                'created_by' => $users->random(),
                'published' => true,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }

        $chunks = array_chunk($data, 100);

        foreach ($chunks as $chunk) {
            Product::insert($chunk);
        }
    }
}
