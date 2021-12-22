<?php

namespace Database\Seeders;

use App\Models\Animal;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $animals = [
            [
                'title' => 'dog'
            ],
            [
                'title' => 'cat'
            ],
            [
                'title' => 'racoon'
            ],
            [
                'title' => 'penguin'
            ]
        ];

        foreach ($animals as $animal) {
            Animal::create($animal);
        }
    }
}
