<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Interfaces\IAuthService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JetBrains\PhpStorm\ArrayShape;

class AuthController extends Controller
{
    private IAuthService $authService;

    public function __construct(IAuthService $authService)
    {
        $this->authService = $authService;
    }

    public function Register(RegisterRequest $request): Response|Application|ResponseFactory
    {
        $fields = $request->validated();
        $result = $this->authService->Register($fields);
        if(!$result) {
            return response(false, 400);
        }

        return response(true, 201);
    }

    public function Login(LoginRequest $request): Response|Application|ResponseFactory
    {
        $fields = $request->validated();
        $result = $this->authService->Login($fields);
        if(!$result) {
            return response(false, 401);
        }

        return response($result, 200);
    }

    #[ArrayShape(['message' => "string"])]
    public function Logout(Request $request): Response|Application|ResponseFactory
    {
        auth()->user()->tokens()->delete();

        return response(true, 201);
    }
}
