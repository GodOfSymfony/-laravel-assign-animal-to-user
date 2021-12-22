<?php

namespace App\Http\Controllers\Api;

use AnimalParameters;
use App\Http\Requests\AnimalUserRequest;
use App\Http\Requests\AssignAnimalRequest;
use App\Http\Resources\AnimalResource;
use App\Http\Resources\CurrentUserResource;
use App\Models\Animal;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AnimalController extends \App\Http\Controllers\Controller
{
    public function getFreeAnimals(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
    {
        return response(AnimalResource::collection(Animal::whereDoesntHave('users', function ($q) {
            $q->where('users.id', auth()->user()->id);
        })->get()),
            Response::HTTP_OK);
    }

    public function currentUserData(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
    {
        return response(
            new CurrentUserResource(User::where('id',auth()->user()->id)?->with('animals')->first()),
            Response::HTTP_OK
        );
    }

    public function assignNewAnimal(AssignAnimalRequest $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
    {
        auth()->user()?->animals()->attach($request->animal_id);

        return response('Successfully attached', Response::HTTP_ACCEPTED);
    }

    public function increaseProperty(AnimalUserRequest $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
    {
        $responseContent = 'Nothing to increment';
        if (AnimalParameters::canIncrementProperty($request->animal_id, $request->property)) {
            AnimalParameters::incrementProperty($request->animal_id, $request->property);
            $responseContent = 'Icremented';
        }

        return response($responseContent, Response::HTTP_ACCEPTED);
    }

    public function checkIncrement(Request $request)
    {
        #dd($request->inc);
        $properties = [];
        foreach ($request->inc as $animal_id) {
            $properties[] = [
                'can_inc_sleep'  => AnimalParameters::canIncrementProperty($animal_id, 'sleep'),
                'can_inc_hunger' => AnimalParameters::canIncrementProperty($animal_id, 'hunger'),
                'can_inc_care'   => AnimalParameters::canIncrementProperty($animal_id, 'care')
            ];
        }

        return response($properties, Response::HTTP_OK);
    }
}
