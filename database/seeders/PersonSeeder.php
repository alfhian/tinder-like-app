<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Person;
use Faker\Factory as Faker;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // List of US cities for location
        $cities = [
            'New York, USA', 'Los Angeles, USA', 'Chicago, USA', 'Houston, USA',
            'Miami, USA', 'San Francisco, USA', 'Seattle, USA', 'Boston, USA',
            'Dallas, USA', 'Denver, USA', 'Atlanta, USA', 'Phoenix, USA',
            'Philadelphia, USA', 'San Diego, USA', 'Las Vegas, USA'
        ];

        for ($i = 0; $i < 100; $i++) {
            Person::create([
                'name' => $faker->name,
                'age' => $faker->numberBetween(20, 40),
                'pictures' => json_encode([
                    "https://example.com/images/person{$i}_1.jpg",
                    "https://example.com/images/person{$i}_2.jpg"
                ]),
                'location' => $faker->randomElement($cities),
            ]);
        }
    }
}
