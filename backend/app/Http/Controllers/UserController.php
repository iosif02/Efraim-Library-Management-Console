<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Interfaces\IUserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private IUserService $userService;

    public function __construct(IUserService $userService){
        $this->userService = $userService;
    }

    public function GetUsers()
    {
        $result = $this->userService->GetUsers();
        if(!$result) {
            return response(false, 400);
        }

        return response($result, 200);
    }

    public function AddUser(AddUserRequest $request)
    {
        $validated = $request->validated();
        $result = $this->userService->AddUser($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response(true, 200);
    }

    public function UpdateUser(AddUserRequest $request)
    {
        $validated = $request->validated();
        $result = $this->userService->UpdateUser($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response(true, 200);
    }

    public function DeleteUser($userId)
    {
        $result = $this->userService->DeleteUser($userId);
        if(!$result) {
            return response(false, 400);
        }

        return response(true, 200);
    }

}
