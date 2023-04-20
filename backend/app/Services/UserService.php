<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Interfaces\IUserService;
use App\Models\User;
use App\Repositories\IUserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


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

    /**
     * @throws CustomException
     */
    public function GetUserDetailsById(int $userId): User
    {
        $result = $this->userRepository->GetUserDetailsById($userId);
        if(!$result)
            throw new CustomException('User not found. Please contact the administrator');
        return $result;
    }

    public function SearchUsers(array $filters): ?LengthAwarePaginator
    {
        return $this->userRepository->SearchUsers($filters);
    }

    public function AddUser(array $fields): bool
    {
        return $this->userRepository->AddUser($fields);
    }

    /**
     * @throws CustomException
     */
    public function UpdateUser(array $fields): bool
    {
        $user = $this->userRepository->GetUserById($fields['userId']);
        if(!$user)
            throw new CustomException('User not found!');
        return $this->userRepository->UpdateUser($fields);
    }

    /**
     * @throws CustomException
     */
    public function DeleteUser(int $userId): bool
    {
        $user = $this->userRepository->GetUserById($userId);
        if(!$user)
            throw new CustomException('User not found!');
        return $this->userRepository->DeleteUser($userId);
    }

}
