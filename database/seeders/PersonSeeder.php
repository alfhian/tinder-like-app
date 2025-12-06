<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Person;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'John Smith',
                'age' => 30,
                'pictures' => json_encode([
                    'https://example.com/images/john1.jpg',
                    'https://example.com/images/john2.jpg'
                ]),
                'location' => 'New York, USA'
            ],
            [
                'name' => 'Emily Johnson',
                'age' => 28,
                'pictures' => json_encode([
                    'https://example.com/images/emily1.jpg'
                ]),
                'location' => 'Los Angeles, USA'
            ],
            [
                'name' => 'Michael Brown',
                'age' => 26,
                'pictures' => json_encode([
                    'https://example.com/images/michael1.jpg',
                    'https://example.com/images/michael2.jpg'
                ]),
                'location' => 'Chicago, USA'
            ],
            [
                'name' => 'Sarah Davis',
                'age' => 32,
                'pictures' => json_encode([
                    'https://example.com/images/sarah1.jpg'
                ]),
                'location' => 'Houston, USA'
            ],
            [
                'name' => 'David Wilson',
                'age' => 29,
                'pictures' => json_encode([
                    'https://example.com/images/david1.jpg',
                    'https://example.com/images/david2.jpg'
                ]),
                'location' => 'Miami, USA'
            ],
        ];

        foreach ($data as $person) {
            Person::create($person);
        }
    }
}
