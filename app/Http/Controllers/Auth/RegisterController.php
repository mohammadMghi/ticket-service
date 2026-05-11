<?php

namespace App\Http\Controllers\Auth;

 
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
use App\Services\Auth\DTOs\RegisterData; 
 

class RegisterController extends Controller
{
    public function __construct(
        public AuthService $authService
    ){}
    
    public function __invoke(RegisterRequest $request)
    { 
        $token = $this->authService->register(
            new RegisterData(
                $request->name,
                $request->email,
                $request->password
            )
        );  
        
        return response()->json([
            'token' => $token
        ]);
    }
}
