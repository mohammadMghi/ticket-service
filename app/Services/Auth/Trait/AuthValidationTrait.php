<?php

namespace App\Services\Auth\Trait;

use App\Services\Auth\Exceptions\InvalidAtuhException;
use App\Services\Auth\Exceptions\UserExistedException;
use Hash;

trait AuthValidationTrait
{
    private function ensurePasswordIsCorrect($password,$hashPassword)
    {
        if (!Hash::check($password ,$hashPassword)) {
            throw new InvalidAtuhException('Authentication failed');
        }
    }

    private function ensureUserNotExist($email)
    { 
        $user = $this->userRepo->exists($email);

        if ($user) {
            throw new UserExistedException('You registred before please login');
        }
    }
}