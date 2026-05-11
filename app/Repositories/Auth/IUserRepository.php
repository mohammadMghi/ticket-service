<?php

namespace App\Repositories\Auth;
 
use App\Models\User;
use App\Services\Auth\DTOs\RegisterData;

interface IUserRepository
{
    public function getByEmail(string $email) : User; 

    public function create(RegisterData $data);

    public function exists(string $email) : bool;
}