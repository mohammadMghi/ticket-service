<?php

namespace App\Services\Auth\Trait;

use App\Models\User;

trait TokenMakerTrait
{
    private function makeNewToken(User $user)
    {
        return $user->createToken('ticket-service')->plainTextToken;
    }
}