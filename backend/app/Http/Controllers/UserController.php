<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserSearchRequest;
use App\Interfaces\IUserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private IUserService $userService;

    public function __construct(IUserService $userService){
        $this->userService = $userService;
    }

    public function GetUser(int $userId): JsonResponse
    {
        $result = $this->userService->GetUserById($userId);
        if(!$result) {
            return response()->json(['message' => 'Failed to get the user. Please contact the administrator!'], 500);
        }

        return response()->json($result, 200);
    }

    public function SearchUsers(UserSearchRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->userService->SearchUsers($validated);
        if(!$result) {
            return response()->json(['message' => 'Failed to get the users. Please contact the administrator!'], 500);
        }

        return response()->json($result, 200);
    }

    public function AddUser(AddUserRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->userService->AddUser($validated);
        if(!$result) {
            return response()->json(['message' => 'Failed to add the user. Please contact the administrator!'], 500);
        }

        return response()->json(true, 200);
    }

    public function UpdateUser(UpdateUserRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->userService->UpdateUser($validated);
        if(!$result) {
            return response()->json(['message' => 'Failed to update the user. Please contact the administrator!'], 500);
        }

        return response()->json(true, 200);
    }

    public function DeleteUser(int $userId): JsonResponse
    {
        $result = $this->userService->DeleteUser($userId);
        if(!$result) {
            return response()->json(['message' => 'Failed to delete the user. Please contact the administrator!'], 500);
        }

        return response()->json(true, 200);
    }

}
