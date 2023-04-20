<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Interfaces\IAuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    private IAuthService $authService;

    public function __construct(IAuthService $authService)
    {
        $this->authService = $authService;
    }

    public function Register(RegisterRequest $request): JsonResponse
    {
        $fields = $request->validated();
        $result = $this->authService->Register($fields);

        return response()->json($result);
    }

    public function Login(LoginRequest $request): JsonResponse
    {
        $fields = $request->validated();
        $result = $this->authService->Login($fields);

        return response()->json($result);
    }

    public function Logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json(true, 201);
    }
}
