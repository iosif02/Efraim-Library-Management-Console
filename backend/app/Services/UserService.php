<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Interfaces\IUserService;
use App\Models\User;
use App\Repositories\IUserRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class UserService implements IUserService
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function GetRoles(): Collection
    {
        return $this->userRepository->GetRoles();
    }

    public function GetUserById(int $userId): ?User
    {
        return $this->userRepository->GetUserById($userId);
    }

    public function SearchUsers(array $filters): ?LengthAwarePaginator
    {
        return $this->userRepository->SearchUsers($filters);
    }

    public function AddUser(array $fields): bool
    {
        return $this->userRepository->AddUser($fields);
    }

    public function UpdateUser(array $fields): bool
    {
        return $this->userRepository->UpdateUser($fields);
    }

    public function DeleteUser(int $userId): bool
    {
        return $this->userRepository->DeleteUser($userId);
    }

}
