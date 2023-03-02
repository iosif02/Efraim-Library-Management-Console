<?php

namespace App\Interfaces;

interface IUserService
{
    public function GetUsers();
    public function AddUser(array $fields): bool;
    public function UpdateUser(array $fields): bool;
    public function DeleteUser(int $userId): bool;
}
