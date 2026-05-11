<?php

namespace App\Services\Auth;
 
use App\Models\User;
use App\Repositories\Auth\IUserRepository; 
use App\Services\Auth\Contracts\IAuthService; 
use App\Services\Auth\DTOs\LoginData;
use App\Services\Auth\DTOs\RegisterData;
use App\Services\Auth\Exceptions\UserExistedException;
use App\Services\Auth\Trait\AuthValidationTrait;
use App\Services\Auth\Trait\TokenMakerTrait; 

class AuthService implements IAuthService
{
    use AuthValidationTrait,TokenMakerTrait;

    public function __construct(
        protected IUserRepository $userRepo
    ){}

    public function login(LoginData $data) : string
    {
        $user = $this->userRepo->getByEmail($data->email);

        $this->ensurePasswordIsCorrect($data->password->value(),$user->password);
    
        return $this->makeNewToken($user);
    }

    public function register(RegisterData $data)
    {
        $this->ensureUserNotExist($data->email);
       
        $user = $this->userRepo->create($data);

        return $this->makeNewToken($user);
    }
}