<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function users()
    {
        return $this->belongsToMany(User::class)
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
