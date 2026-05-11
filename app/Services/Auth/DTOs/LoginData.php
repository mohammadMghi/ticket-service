<?php

namespace App\Services\Auth\DTOs;

use App\Services\Auth\ValueObjects\PasswordHash;
 
 

class LoginData
{
    public function __construct(
        public readonly string $email,
        public readonly PasswordHash $password,
    ){}
}