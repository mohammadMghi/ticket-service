<?php

namespace App\Services\Auth\Exceptions;

use Exception;
use Illuminate\Http\Request;

class UserExistedException extends Exception
{
    public function render(Request $request)
    {
        return response()->json([
            'error' => [
                'message' => $this->message
            ]
        ] , 409);
    }
}