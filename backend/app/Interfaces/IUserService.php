<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface IUserService
{
    public function GetRoles();
    public function SearchUsers(array $filters): ?LengthAwarePaginator;
    public function GetUserById(int $userId): ?User;
    public function AddUser(array $fields): bool;
    public function UpdateUser(array $fields): bool;
    public function DeleteUser(int $userId): bool;
}
