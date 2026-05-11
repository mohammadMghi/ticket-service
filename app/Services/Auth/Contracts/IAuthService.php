<?php

namespace App\Services\Auth\Contracts;
 
use App\Services\Auth\DTOs\LoginData;
use App\Services\Auth\DTOs\RegisterData; 

interface IAuthService
{
    public function login(LoginData $data);

    public function register(RegisterData $data);
}