<?php

namespace Tests\Feature;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class AnimalControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_free_animals_unathorized()
    {
        $response = $this->get('api/get-free-animals');

        $response->assertStatus(302);
    }

    public function test_get_free_animals_authorized()
    {
        $this->withoutMiddleware();

        $user = User::create([
            'name' => 'a',
            'email' => 'a@test.com',
            'password' => 'a'
        ]);
        $response = $this->actingAs($user, 'api')->get('api/get-free-animals');

        $response->assertStatus(200);
    }

    public function test_current_user_data()
    {
        $this->withoutMiddleware();
        $user = User::create([
            'name' => 'a',
            'email' => 'a@test.com',
            'password' => 'a'
        ]);
        $response = $this->actingAs($user, 'api')->post('api/current-user-data');

        $response->assertStatus(200);
    }

    public function test_assign_new_animal()
    {
        $this->withoutMiddleware();
        $user = User::create([
            'name' => 'a',
            'email' => 'a@test.com',
            'password' => 'a'
        ]);
        $animal = Animal::create([
            'title' => 'dog'
        ]);
        $response = $this->actingAs($user, 'api')->postJson('api/assign-animal', [
            'animal_id' => $animal->id
        ]);

        $response->assertStatus(202);
    }

    public function test_increase_property()
    {
        $this->withoutMiddleware();
        $user = User::create([
            'name' => 'a',
            'email' => 'a@test.com',
            'password' => 'a'
        ]);
        $animal = Animal::create([
            'title' => 'dog'
        ]);
        $user->animals()->attach($animal->id);
        $response = $this->actingAs($user, 'api')->postJson('api/increase-property', [
            'animal_id' => $animal->id,
            'user_id'   => $user->id,
            'property'  => 'sleep'
        ]);

        $response->assertStatus(202);
    }
}
