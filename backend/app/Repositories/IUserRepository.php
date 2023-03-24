<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface IUserRepository
{
    public function CreateUser(array $fields): bool;
    public function GetUserByEmail(string $email): ?User;
    public function GetUserById(int $userId): ?User;
    public function SearchUsers(array  $filters): ?LengthAwarePaginator;
    public function AddUser(array $fields): bool;
    public function UpdateUser(array $fields): bool;
    public function DeleteUser(int $userId): bool;
}
