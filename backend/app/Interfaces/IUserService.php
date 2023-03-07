<?php

namespace App\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface IUserService
{
    public function GetUsers(array $filters): ?LengthAwarePaginator;
    public function AddUser(array $fields): bool;
    public function UpdateUser(array $fields): bool;
    public function DeleteUser(int $userId): bool;
}
