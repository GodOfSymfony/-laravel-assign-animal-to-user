<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [App\Http\Controllers\Api\AuthController::class, 'register'])->name('register');
Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login'])->name('login');

Route::group([
    'middleware' =>['auth:sanctum']
], function () {
    Route::post('user', [App\Http\Controllers\Api\AuthController::class, 'user']);
    Route::post('logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);

    Route::get('get-free-animals', [App\Http\Controllers\Api\AnimalController::class, 'getFreeAnimals']);
    Route::post('current-user-data', [App\Http\Controllers\Api\AnimalController::class, 'currentUserData']);
    Route::post('assign-animal', [App\Http\Controllers\Api\AnimalController::class, 'assignNewAnimal']);
    Route::post('increase-property', [App\Http\Controllers\Api\AnimalController::class, 'increaseProperty']);
    Route::post('check-increment', [App\Http\Controllers\Api\AnimalController::class, 'checkIncrement']);
});
