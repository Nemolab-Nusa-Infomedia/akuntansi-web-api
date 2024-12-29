<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasUuids;


    /*
    |--------------------------------------------------------------------------
    | Variables
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        // UNIQUE
        'email',

        // REQUIRED
        'status_account',
        'password',
        'phone',
        'name',
    ];

    protected $hidden = [
        'status_account',
        'password',
    ];


    /*
    |--------------------------------------------------------------------------
    | Functions
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }
}
