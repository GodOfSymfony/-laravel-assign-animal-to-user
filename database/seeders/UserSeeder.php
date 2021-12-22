<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'     => 'Test User',
            'email'    => 'test@test.com',
            'password' => Hash::make('12345678')
        ])->animals()->sync([Animal::find(1)->id]);

        User::factory(9)->create();
    }
}
