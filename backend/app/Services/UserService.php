<?php

namespace App\Services;

use App\Interfaces\IUserService;
use App\Repositories\IUserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class UserService implements IUserService
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function GetUsers()
    {
        return $this->userRepository->GetUsers();
    }

    public function AddUser(array $fields): bool
    {
        try {
            $fields['birth_date'] = Carbon::parse($fields['birth_date']);
            $result = $this->userRepository->AddUser($fields);
        } catch (Exception $exception) {
            Log::error('Add user error: ' . $exception->getMessage());
            return false;
        }

        return $result;
    }

    public function UpdateUser(array $fields): bool
    {
        try {
            $fields['birth_date'] = Carbon::parse($fields['birth_date']);
            $result = $this->userRepository->UpdateUser($fields);
        } catch (Exception $exception) {
            Log::error('Update user error: ' . $exception->getMessage());
            return false;
        }

        return $result;
    }

    public function DeleteUser(int $userId): bool
    {
        try {
            if(!$userId)
                throw new Exception('userId is required!');

            $result = $this->userRepository->DeleteUser($userId);
        } catch (Exception $exception) {
            Log::error('Delete user error: ' . $exception->getMessage());
            return false;
        }

        return $result;
    }

}
