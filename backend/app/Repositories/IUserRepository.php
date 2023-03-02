<?php

namespace App\Repositories;

interface IUserRepository
{
    public function CreateUser($fields);
    public function GetUserByEmail($email);
    public function GetUsers();
    public function AddUser(array $fields): bool;
    public function UpdateUser(array $fields): bool;
    public function DeleteUser(int $userId): bool;
}
