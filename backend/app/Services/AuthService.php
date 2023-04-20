<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Interfaces\IAuthService;
use App\Models\User;
use App\Repositories\IUserRepository;
use Illuminate\Support\Facades\Hash;

class AuthService implements IAuthService
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function Register(array $fields): User
    {
        return $this->userRepository->CreateUser($fields);
    }

    /**
     * @throws CustomException
     */
    public function Login(array $fields): array
    {
        $user = $this->userRepository->GetUserByEmail($fields['email']);
        if(!$user || !Hash::check($fields['password'], $user->password))
            throw new CustomException('Email or password is incorrect!');

        $token = $user->createToken('myapptoken')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }
}
