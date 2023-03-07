<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface IUserRepository
{
    public function CreateUser(array $fields): bool;
    public function GetUserByEmail(string $email): ?User;
    public function GetUsers(array  $filters): ?LengthAwarePaginator;
    public function AddUser(array $fields): bool;
    public function UpdateUser(array $fields): bool;
    public function DeleteUser(int $userId): bool;
}
