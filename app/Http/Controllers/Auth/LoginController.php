<?php

namespace App\Http\Controllers\Auth;
 
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;
use App\Services\Auth\DTOs\LoginData;  
use App\Services\Auth\ValueObjects\PasswordHash; 

class LoginController extends Controller
{
    public function __construct(
        public AuthService $authService
    ){}

    public function __invoke(LoginRequest $request)
    {
        $token = $this->authService->login(new LoginData(
            $request->email,
            new PasswordHash($request->password)
        ));

        return response()->json([
            'token' => $token
        ]);
    }
}
