<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Farmer;
use Faker\Factory as Faker;

class FarmerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            Farmer::create([
                'name' => $faker->name,
                'farm_name' => $faker->company . ' Farm',
                'region' => 'Gelderland', 
                'lat' => $faker->latitude(51.5, 52.5), 
                'lng' => $faker->longitude(5.5, 6.5),
            ]);
        }
    }
}
