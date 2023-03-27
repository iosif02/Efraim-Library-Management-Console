<?php

namespace App\Services;

use App\Interfaces\IAuthService;
use App\Repositories\IUserRepository;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthService implements IAuthService
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function Register(array $fields): bool
    {
        try {
            $result = $this->userRepository->CreateUser($fields);
        } catch(Exception $exception) {
            Log::error('Register error: ' . $exception->getMessage());
            return false;
        }

        return $result;
    }

    public function Login(array $fields): ?array
    {
        try {
            $user = $this->userRepository->GetUserByEmail($fields['email']);
            if(!$user || !Hash::check($fields['password'], $user->password)) {
                return ['error' => 'Email or password is incorrect!'];
            }
            if($user->is_admin == 0)
                return ['error' => 'You are not authorized to perform this action!'];

            $token = $user->createToken('myapptoken')->plainTextToken;
        } catch(Exception $exception) {
            Log::error('Login error: ' . $exception->getMessage());
            return null;
        }

        return [
            'user' => $user,
            'token' => $token
        ];
    }
}
