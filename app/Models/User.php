<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function animals()
    {
        return $this->belongsToMany(Animal::class)
            ->withPivot([
                'id',
                'sleep',
                'hunger',
                'care',
                'alive',
                'sleep_increment_at',
                'hunger_increment_at',
                'care_increment_at',
                'sleep_decrement_at',
                'hunger_decrement_at',
                'care_decrement_at'
            ]);
    }
}
