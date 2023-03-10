<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\UserSearchRequest;
use App\Interfaces\IUserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private IUserService $userService;

    public function __construct(IUserService $userService){
        $this->userService = $userService;
    }

    public function GetUsers(UserSearchRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->userService->GetUsers($validated);
        if(!$result) {
            return response()->json(['message' => 'test'], 500);
        }

        return response()->json($result, 200);
    }

    public function AddUser(AddUserRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->userService->AddUser($validated);
        if(!$result) {
            return response()->json(['message' => 'test'], 500);
        }

        return response()->json(true, 200);
    }

    public function UpdateUser(AddUserRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->userService->UpdateUser($validated);
        if(!$result) {
            return response()->json(['message' => 'test'], 500);
        }

        return response()->json(true, 200);
    }

    public function DeleteUser(int $userId): JsonResponse
    {
        $result = $this->userService->DeleteUser($userId);
        if(!$result) {
            return response()->json(['message' => 'test'], 500);
        }

        return response()->json(true, 200);
    }

}
