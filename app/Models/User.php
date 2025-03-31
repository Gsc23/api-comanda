<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\DTO\UserDTO;
use App\ValueObjects\Username;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'users';
    protected $primaryKey = '_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'cpf',
        'role',
        'birthdate',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function factory()
    {
        return app()->make(self::class);
    }

    public function populate(UserDTO $userData): self
    {
        $this->fill([
            'name' => $userData->name,
            'username' => Username::factory($userData->name),
            'cpf' => $userData->cpf,
            'role' => $userData->role,
            'birthdate' => $userData->birthdate,
            'email' => $userData->email,
            'password' => $userData->password,
        ]);
        return $this;
    }
}
