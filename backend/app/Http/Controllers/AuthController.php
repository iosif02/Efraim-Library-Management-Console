<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Interfaces\IAuthService;
use Illuminate\Http\JsonResponse;
use JetBrains\PhpStorm\ArrayShape;

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
        if(!$result) {
            return response()->json(['message' => 'Failed to create the account. Please contact the administrator!'], 500);
        }

        return response()->json(true, 200);
    }

    public function Login(LoginRequest $request): JsonResponse
    {
        $fields = $request->validated();
        $result = $this->authService->Login($fields);
        if(!$result || isset($result['error'])) {
            return response()->json(['message' => $result['error'] ?? 'Failed to login. Please contact the administrator!'], 500);
        }

        return response()->json($result, 200);
    }

    #[ArrayShape(['message' => "string"])]
    public function Logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json(true, 201);
    }
}
