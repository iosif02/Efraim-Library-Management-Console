<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Interfaces\IUserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private IUserService $userService;

    public function __construct(IUserService $userService){
        $this->userService = $userService;
    }

    public function GetUsers(): Response|Application|ResponseFactory
    {
        $result = $this->userService->GetUsers();
        if(!$result) {
            return response(false, 400);
        }

        return response($result, 200);
    }

    public function AddUser(AddUserRequest $request): Response|Application|ResponseFactory
    {
        $validated = $request->validated();
        $result = $this->userService->AddUser($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response(true, 200);
    }

    public function UpdateUser(AddUserRequest $request): Response|Application|ResponseFactory
    {
        $validated = $request->validated();
        $result = $this->userService->UpdateUser($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response(true, 200);
    }

    public function DeleteUser(int $userId): Response|Application|ResponseFactory
    {
        $result = $this->userService->DeleteUser($userId);
        if(!$result) {
            return response(false, 400);
        }

        return response(true, 200);
    }

}
