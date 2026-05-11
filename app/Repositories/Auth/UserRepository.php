<?php

namespace App\Repositories\Auth;

use App\Models\User;
use App\Services\Auth\DTOs\RegisterData;

class UserRepository implements IUserRepository
{
    public function getByEmail(string $email) : User
    { 
        return User::where('email' , $email)->firstOrFail();
    }

    public function exists(string $email) : bool
    {
        return User::where('email' , $email)->exists();
    }

    public function create(RegisterData $data) : User
    {
        return User::create($data->toArray());
    }
}